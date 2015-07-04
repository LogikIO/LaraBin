@extends('layout.master')

@section('title')
    @parent
    :: {{ $bin->title }}
@stop

@section('customcssfiles')
    {!! HTML::style('vendors/highlightjs/github-gist.css') !!}
    {!! HTML::style('css/markdown-github.css') !!}
@stop

@section('customcss')
    .panel-body{padding:0}
    .markrender{padding:15px}
    .plaintext > pre{padding: 0.5em}
    .details span{margin-right:4px}
@stop

@section('customjsfiles')
    {!! HTML::script('vendors/highlightjs/highlight.pack.js') !!}
    {!! HTML::script('vendors/highlightjs/highlightjs-line-numbers.js') !!}
    {!! HTML::script('js/marked.min.js') !!}
    {!! HTML::script('js/bins/show.js') !!}
@stop

@section('customjs')

@stop

@section('content')
<div class="row">
    <div class="col-xs-10 col-xs-offset-1">

        @if(auth()->check() && auth()->user()->getAuthIdentifier() == $bin->user_id)

            <div>
                <p style="text-align:right;">
                    <span>
                        <a class="btn btn-info btn-xs" href="{{ route('bin.edit', $bin->getRouteKey()) }}">Edit</a>
                        <a class="btn btn-danger btn-xs" href="{{ route('bin.delete', $bin->getRouteKey()) }}">Delete</a>
                    </span>
                </p>
            </div>

        @endif

        <div class="bin-details panel panel-default">
            <div class="panel-heading">
                <small>{!! $bin->label() !!}{!! $bin->versions_label() !!}</small>
                <a href="{{ $bin->user->url() }}">{{ $bin->user->username }}</a>&nbsp;&nbsp;/&nbsp;&nbsp;{{ $bin->title }}
            </div>
            @if($bin->description)
                <div class="panel-body" style="padding:15px;">
                    {{ $bin->description }}
                </div>
            @endif
            <div class="panel-footer">
                <span class="details">
                    <small>
                        <span title="Created"><i class="fa fa-clock-o"></i> {{ $bin->created_at->diffForHumans() }}</span>
                        @if($bin->modified())
                            <span title="Updated"><i class="fa fa-pencil"></i> {{ $bin->updated_at->diffForHumans() }}</span>
                        @endif
                    </small>
                </span>
            </div>
        </div>

        @foreach($bin->snippets as $snippet)
        <div id="{{ hashid()->encode($snippet->id) }}" class="panel panel-default">
            <div class="panel-heading"><small>{!! $snippet->label() !!}&nbsp;&nbsp;&nbsp;<a href="#{{ hashid()->encode($snippet->id) }}">{{ $snippet->name }}</a></small> <span style="float:right"><a href="{{ $snippet->url() }}" class="btn btn-xs btn-primary">Raw</a></span></div>
            <div class="panel-body">
                @if($snippet->type->css_class == 'markdown')
                    <div class="markrender">{!! commonmark()->convertToHtml($snippet->code) !!}</div>
                @elseif($snippet->type->css_class == 'nohighlight')
                    <div class="plaintext">
                        <pre><code class="{{ $snippet->type->css_class }}">{{ $snippet->code }}</code></pre>
                    </div>
                @else
                    <div class="highlightable">
                        <pre><code class="{{ $snippet->type->css_class }}">{{ $snippet->code }}</code></pre>
                    </div>
                @endif
            </div>
        </div>
        @endforeach

    </div>
</div>
@stop