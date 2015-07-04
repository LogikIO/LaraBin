<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnippetTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snippet_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('display'); // PHP, JS, CSS, HTML ...
            $table->string('css_class');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('snippet_types')->insert([

            [
                'display' => 'None / Text',
                'css_class' => 'nohighlight'
            ],
            [
                'display' => 'PHP',
                'css_class' => 'php'
            ],
            [
                'display' => 'HTML',
                'css_class' => 'html'
            ],
            [
                'display' => 'JavaScript',
                'css_class' => 'javascript'
            ],
            [
                'display' => 'CoffeeScript',
                'css_class' => 'coffeescript'
            ],
            [
                'display' => 'CSS',
                'css_class' => 'css'
            ],
            [
                'display' => 'SCSS',
                'css_class' => 'scss'
            ],
            [
                'display' => 'Less',
                'css_class' => 'less'
            ],
            [
                'display' => 'Markdown',
                'css_class' => 'markdown'
            ],
            [
                'display' => 'JSON',
                'css_class' => 'json'
            ],
            [
                'display' => 'INI',
                'css_class' => 'ini'
            ],
            [
                'display' => 'Bash',
                'css_class' => 'bash'
            ]

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('snippet_types');
    }
}
