@extends('layout.master')

@section('title')
    @parent
    :: Editing Bin
@stop

@section('customcssfiles')
    {!! HTML::style('css/bins/create.css') !!}
    {!! HTML::style('vendors/bootstrap-select/css/bootstrap-select.min.css') !!}
@stop

@section('customcss')

@stop

@section('customjsfiles')
    {!! HTML::script('vendors/ace/src-min-noconflict/ace.js') !!}
    {!! HTML::script('vendors/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('js/bins/edit.js') !!}
@stop

@section('customjs')

@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                {!! Form::open(['route' => ['bin.edit', $bin->getRouteKey()]]) !!}
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label">Bin Title</label>
                                {!! Form::text('title', $bin->title, ['class' => 'form-control input-sm', 'placeholder' => 'Bin Title', 'required' => '', 'maxlength' => '150']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Visibility</label>
                                    {!! Form::select('visibility', binVisibility(), $bin->visibility, ['class' => 'form-control input-sm']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-10">
                            <div class="form-group">
                                <label class="control-label">Bin Description <small>(not required)</small></label>
                                {!! Form::text('description', $bin->description, ['class' => 'form-control input-sm', 'placeholder' => 'Bin Description', 'maxlength' => '255']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-10">
                            <div class="form-group">
                                <label class="control-label">Laravel Version(s)</label>
                                <br>
                                {!! Form::select('versions[]', $versions, $bin->versions->lists('id')->all(), ['class' => 'selectpicker', 'multiple' => '']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div id="editor-container">
                    @foreach($bin->snippets as $snippet)
                        <div class="col-xs-12 editor-instance">
                            {!! Form::hidden('file', $snippet->getRouteKey()) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">File name:</label>
                                                {!! Form::text('name', $snippet->name, ['class' => 'form-control input-sm', 'required' => '', 'placeholder' => 'Name this file...', 'maxlength' => '150']) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Select language:</label>
                                                {!! Form::select('language', $types, $snippet->type->css_class, ['class' => 'language form-control input-sm']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    {!! Form::textarea('code', $snippet->code, ['class' => 'real-code', 'style' => 'display:none']) !!}
                                    <div class="editor-area"></div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-md-4">
                                            <button class="delete-file btn btn-sm btn-danger">Delete File</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top:20px;" class="col-xs-12">
                    <div id="errors"></div>
                </div>

                <div style="margin-top:20px;" class="col-xs-12">
                    <div class="form-group">
                        <a id="add-file" class="btn btn-sm btn-info">Add File +</a>
                        <button type="submit" class="btn btn-sm btn-success">Save Bin</button>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>

    @include('bin.new-snippet')
@stop