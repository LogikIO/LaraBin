<?php

namespace App\Http\Controllers\Bins;

use App\LaraBin\Models\Bins\Version;
use App\LaraBin\Models\Bins\Bin;
use App\LaraBin\Models\Bins\Snippets\Snippet;
use App\LaraBin\Models\Bins\Snippets\Type;
use Illuminate\Http\Request;
use Twitter;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BinController extends Controller
{
    public function create()
    {
        $types = Type::all()->lists('display', 'css_class')->all();
        $versions = Version::all()->lists('name', 'id')->all();

        return view('bin.create', compact('types', 'versions'));
    }

    public function createPost(Requests\Bins\CreateBin $request)
    {
        $description = ($request->has('description') && trim($request->input('description')) != '') ? $request->input('description') : null;

        $bin = Bin::create([
            'user_id' => auth()->user()->getAuthIdentifier(),
            'title' => $request->input('title'),
            'description' => $description,
            'visibility' => $request->input('visibility')
        ]);

        if ($bin->isPublic()) {
            $status = 'Bin: #laravel ' . $bin->url() . ' ' . $bin->title;
            Twitter::postTweet(['status' => str_limit($status, 135), 'format' => 'json']);
        }

        $bin->versions()->sync($request->input('versions'));

        $files = [];

        foreach($request->input('name') as $key => $value)
        {
            $files[$key]['name'] = $value;
        }

        foreach($request->input('language') as $key => $value)
        {
            $files[$key]['language'] = $value;
        }

        foreach($request->input('code') as $key => $value)
        {
            $files[$key]['code'] = $value;
        }

        foreach($files as $item) {
            $type = Type::where('css_class', $item['language'])->first();
            $bin->snippets()->create([
                'type_id' => $type->id,
                'name' => $item['name'],
                'code' => $item['code']
            ]);
        }
        session()->flash('success', 'Bin created successfully!');

        return redirect()->route('bin', $bin->getRouteKey());
    }

    public function show(Bin $bin)
    {
        return view('bin.show', compact('bin'));
    }

    public function showSnippet(Bin $bin, $snippet)
    {
        $snippetId = hashid()->decode($snippet);

        if (empty($snippetId)) {
            session()->flash('error', 'No file with that ID can be found!');

            return redirect()->route('bin', $bin->getRouteKey());
        }

        $snippet = $bin->snippets()->where('id', $snippetId)->first();

        if (!$snippet) {
            session()->flash('error', 'No file with that ID can be found!');

            return redirect()->route('bin', $bin);
        }

        return view('bin.show-snippet', compact('snippet'));
    }

    public function edit(Bin $bin)
    {
        $types = Type::all()->lists('display', 'css_class')->all();
        $versions = Version::all()->lists('name', 'id')->all();

        return view('bin.edit', compact('bin', 'types', 'versions'));
    }

    public function editPost(Bin $bin, Requests\Bins\CreateBin $request)
    {
        $description = ($request->has('description') && trim($request->input('description')) != '') ? $request->input('description') : null;
        // Update the bin itself
        $bin->title = $request->input('title');
        $bin->description = $description;
        $bin->visibility = $request->input('visibility');
        $bin->save();

        $bin->versions()->sync($request->input('versions'));

        // Files that currently exist with the bin object
        $existingFiles = [];
        foreach($bin->snippets as $file) {
            $existingFiles[] = $file->getRouteKey();
        }

        /**
         * Now we need to check that the existing files are still
         * present in the post, if they are then they are updated
         * if they are not, then they are deleted.
         */
        $updatedExisting = [];

        $files = [];

        if ($request->has('file')) {
            foreach ($request->input('file') as $key => $value) {
                $files[$key]['file'] = $value;
                $updatedExisting[] = $value;
            }
        }

        foreach($request->input('name') as $key => $value)
        {
            $files[$key]['name'] = $value;
        }

        foreach($request->input('language') as $key => $value)
        {
            $files[$key]['language'] = $value;
        }

        foreach($request->input('code') as $key => $value)
        {
            $files[$key]['code'] = $value;
        }

        $filesToDelete = [];
        foreach($existingFiles as $key => $value) {
            if (!in_array($value, $updatedExisting)) {
                /**
                 * This previously existing file was not
                 * found in the update. User wants to delete it.
                 */
                $filesToDelete[] = hashid()->decode($value)[0];
            }
        }
        Snippet::where('bin_id', $bin->id)->whereIn('id', $filesToDelete)->delete();


        foreach($files as $item) {
            $type = Type::where('css_class', $item['language'])->first();
            if(array_key_exists('file', $item)) {
                // update existing snippet
                $snippet = Snippet::where(['bin_id' => $bin->id, 'id' => hashid()->decode($item['file'])])->first();
                $snippet->type_id = $type->id;
                $snippet->name = $item['name'];
                $snippet->code = $item['code'];
                $snippet->save();
            } else {
                // create new snippet
                $bin->snippets()->create([
                    'type_id' => $type->id,
                    'name' => $item['name'],
                    'code' => $item['code']
                ]);
            }
        }

        session()->flash('success', 'Bin updated successfully!');

        return redirect()->route('bin', $bin->getRouteKey());
    }

    public function all($recent = null)
    {
        if ($recent && $recent == 'recent') {
            $active = 'recent';
            $bins = Bin::publicOnly()->with(['snippets','user'])->orderBy('updated_at', 'DESC')->paginate(10);
        } else {
            $active = 'latest';
            $bins = Bin::publicOnly()->with(['snippets','user'])->latest()->paginate(10);
        }

        return view('bin.all', compact('bins', 'active'));
    }

    public function my()
    {
        $bins = Bin::where('user_id', auth()->user()->getAuthIdentifier())->with('snippets')->orderBy('updated_at', 'DESC')->paginate(8);

        return view('bin.my', compact('bins'));
    }

    public function ajax(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');
        $record = Bin::where(['id' => hashid()->decode($id), 'user_id' => auth()->user()->getAuthIdentifier()])->first();
        if (!$record) {
            return response()->json(['msg' => 'There was an issue with your request!'], 422);
        }

        if ($type == 'visibility') {
            $visibility = $request->input('visibility');
            $record->visibility = $visibility;
            $record->save();

            return response()->json(['msg' => 'Bin updated successfully!'], 200);
        }

    }

    public function delete(Bin $bin)
    {
        return view('bin.delete', compact('bin'));
    }

    public function deletePost(Bin $bin, Requests\Bins\DeleteBin $request)
    {
        $bin->delete();
        session()->flash('success', 'Your bin has been deleted!');

        return redirect()->route('bins.my');
    }
}
