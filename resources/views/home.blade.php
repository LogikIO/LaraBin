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

        <h1>Laravel code bin repository.</h1>

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
        <p>LaraBin is a code bin repository specifically dedicated to <a href="http://laravel.com">Laravel</a> code.</p>
        <p>Create an account and paste away! :)</p>
        <p><a class="btn btn-sm btn-social btn-twitter" href="https://twitter.com/larabincom"><i class="fa fa-twitter"></i>Follow us on Twitter!</a></p>
    </div>
</div>
@stop