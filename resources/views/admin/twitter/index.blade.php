@extends('layout.master')

@section('title')
    @parent
    :: Twitter Feed
@stop

@section('customcssfiles')
    {!! HTML::style('css/admin/twitter.css') !!}
@stop

@section('customcss')

@stop

@section('customjsfiles')

@stop

@section('customjs')

@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <a href="{{ route('admin.twitter.new') }}" class="btn btn-sm btn-success">New Tweet +</a>
        <h4><a href="https://twitter.com/LaraBinCom">@LaraBinCom</a> Tweets</h4>
        @foreach($tweets as $tweet)
            <div class="comment-details panel-default m-b-20">
                <div class="panel-heading"><a href="https://twitter.com/LaraBinCom/status/{{ $tweet->id }}">Link</a><span style="float:right">ID: {{ $tweet->id }}</span></div>
                <div class="panel-body" style="padding:15px;">
                    {!! $tweet->text !!}
                </div>
                <div class="panel-footer">
                    <span class="details">
                        <small>
                            <span title="Created"><i class="fa fa-clock-o"></i> {{ Twitter::ago($tweet->created_at) }}</span>
                        </small>
                    </span>
                    <span class="manage">
                        <a class="btn btn-danger btn-xs" href="{{ route('admin.twitter.delete', $tweet->id) }}">Delete</a>
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>
@stop