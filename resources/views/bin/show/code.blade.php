@extends('layout.master')

@section('title')
    @parent
    :: {{ $bin->title }}
@stop

@section('customcssfiles')
    {!! HTML::style('vendors/highlightjs/github-gist.css') !!}
    {!! HTML::style('css/markdown-github.css') !!}
    {!! HTML::style('css/bins/show.css') !!}
    @if(Menu::areActiveRoutesCheck(['bin.comments', 'bin.comments.edit']))
        {!! HTML::style('css/bins/comments.css') !!}
    @endif
@stop

@section('customcss')

@stop

@section('customjsfiles')
    @if(Menu::areActiveRoutesCheck(['bin.comments', 'bin.comments.edit']))
        {!! HTML::script('vendors/taboverride/taboverride.min.js') !!}
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

        @if(Menu::isActiveRouteCheck('bin.comments.edit'))
            @include('bin.show.partials.edit-comment')
        @endif

        @if(Menu::isActiveRouteCheck('bin.comments.delete'))
            @include('bin.show.partials.delete-comment')
        @endif

    </div>

    <div class="col-xs-12 col-md-2">
        <div class="bin-panel list-group">
            <a href="{{ $bin->url() }}" class="list-group-item {{ Menu::isActiveRoute('bin.code') }}"><i class="fa fa-code"></i>Code</a>
            <a href="{{ $bin->commentsUrl() }}" class="list-group-item {{ Menu::isActiveRoute('bin.comments') }}"><i class="fa fa-comments"></i>Comments<span class="badge">{{ $bin->comments->count() }}</span></a>
            {{--<a href="#" class="list-group-item"><i class="fa fa-star-o"></i>Star<span class="badge">13</span></a>--}}
        </div>
    </div>

    @if(auth()->check() && auth()->user()->admin())
        <div class="col-xs-12 col-md-2">
            <h5>Admin</h5>
            <div class="bin-panel list-group">
                {!! Form::open(['route' => ['admin.twitter.tweet', $bin->getRouteKey()]]) !!}
                    <button type="submit" class="btn btn-block btn-info btn-xs"><i class="fa fa-twitter"></i> Tweet Bin</button>
                {!! Form::close() !!}
            </div>
        </div>
    @endif
</div>
@stop