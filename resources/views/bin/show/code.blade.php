@extends('layout.master')

@section('title')
    @parent
    :: {{ $bin->title }}
@stop

@section('customcssfiles')
    {!! HTML::style('vendors/highlightjs/github-gist.css') !!}
    {!! HTML::style('css/markdown-github.css') !!}
    {!! HTML::style('css/bins/show.css') !!}
    @if(Menu::isActiveRouteCheck('bin.comments'))
        {!! HTML::style('css/bins/comments.css') !!}
    @endif
@stop

@section('customcss')

@stop

@section('customjsfiles')
    @if(Menu::isActiveRouteCheck('bin.comments'))
        {!! HTML::script('vendors/ace/src-min-noconflict/ace.js') !!}
        {!! HTML::script('js/bins/comments.js') !!}
    @endif
    {!! HTML::script('vendors/highlightjs/highlight.pack.js') !!}
    {!! HTML::script('vendors/highlightjs/highlightjs-line-numbers.js') !!}
    {!! HTML::script('js/bins/show.js') !!}
@stop

@section('customjs')

@stop

@section('content')
<div class="row">
    <div class="col-xs-12 col-md-10">

        @include('bin.show.partials.details')

        @if(Menu::isActiveRouteCheck('bin.code'))
            @include('bin.show.partials.code')
        @endif

        @if(Menu::isActiveRouteCheck('bin.comments'))
            @include('bin.show.partials.comments')
        @endif

    </div>

    <div class="col-xs-12 col-md-2">
        <div class="bin-panel list-group">
            <a href="{{ $bin->url() }}" class="list-group-item {{ Menu::isActiveRoute('bin.code') }}"><i class="fa fa-code"></i>Code</a>
            <a href="{{ $bin->commentsUrl() }}" class="list-group-item {{ Menu::isActiveRoute('bin.comments') }}"><i class="fa fa-comments"></i>Comments<span class="badge">{{ $bin->comments->count() }}</span></a>
            {{--<a href="#" class="list-group-item"><i class="fa fa-star-o"></i>Star<span class="badge">13</span></a>--}}
        </div>
    </div>
</div>
@stop