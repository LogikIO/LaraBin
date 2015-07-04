@extends('layout.master')

@section('title')
    @parent
    :: Laravel code snippet repository.
@stop

@section('customcssfiles')
    {!! HTML::style('css/home.css') !!}
    {!! HTML::style('vendors/highlightjs/github-gist.css') !!}
    {!! HTML::style('css/bootstrap-social.css') !!}
@stop

@section('customcss')

@stop

@section('customjsfiles')
    {!! HTML::script('vendors/highlightjs/highlight.pack.js') !!}
    {!! HTML::script('vendors/highlightjs/highlightjs-line-numbers.js') !!}
    {!! HTML::script('js/home.js') !!}
@stop

@section('customjs')

@stop

@section('content')
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 browser-container">

        <h1>Laravel code snippet repository.</h1>

        <div class="browser-window">
            <div class="top-bar">
                <div class="circles">
                    <div class="circle circle-red"></div>
                    <div class="circle circle-yellow"></div>
                    <div class="circle circle-green"></div>
                </div>
            </div>
            <div class="window-content highlightable">
            <pre><code>{{ $sample }}</code></pre>
            </div>
        </div>

    </div>
    <div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3" style="text-align: center;">
        <h3>Welcome to LaraBin!</h3>
        <p>LaraBin is a code snippet repository specifically dedicated to <a href="http://laravel.com">Laravel</a> code.</p>
        <p>Create an account and paste away! :)</p>
        <p><a class="btn btn-sm btn-social btn-twitter" href="https://twitter.com/larabincom"><i class="fa fa-twitter"></i>Follow us on Twitter!</a></p>
    </div>

    <div class="col-xs-8 col-xs-offset-2" style="margin-top:20px;">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">

                <div class="panel status panel-danger">
                    <div class="panel-heading">
                        <h1 class="panel-title text-center">{{ $artisans }}</h1>
                    </div>
                    <div class="panel-body text-center">
                        <strong>Artisans</strong>
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">

                <div class="panel status panel-warning">
                    <div class="panel-heading">
                        <h1 class="panel-title text-center">{{ $bins }}</h1>
                    </div>
                    <div class="panel-body text-center">
                        <strong>Bins</strong>
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">

                <div class="panel status panel-success">
                    <div class="panel-heading">
                        <h1 class="panel-title text-center">{{ $files }}</h1>
                    </div>
                    <div class="panel-body text-center">
                        <strong>Files</strong>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>
@stop