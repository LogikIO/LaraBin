@extends('layout.master')

@section('title')
    @parent
    :: All Bins
@stop

@section('customcssfiles')

@stop

@section('customcss')
p.sort a{margin-right:6px}
@stop

@section('customjsfiles')

@stop

@section('customjs')

@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @if($bins->count())
                <p class="sort">
                    <span>
                        <a href="{{ route('bins.all') }}" class="{{ ($active == 'latest') ? 'btn-primary' : 'btn-info' }} btn btn-xs">Latest</a>
                        <a href="{{ route('bins.recent') }}" class="{{ ($active == 'recent') ? 'btn-primary' : 'btn-info' }} btn btn-xs">Recently Updated</a>
                    </span>
                </p>
                @foreach($bins as $bin)
                    <div class="bin-details panel panel-default">
                        <div class="panel-heading">
                            <small>{!! $bin->versions_label() !!}</small><a href="{{ $bin->user->url() }}">{{ $bin->user->username }}</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="{{ $bin->url() }}">{{ $bin->title }}</a>
                        </div>
                        @if($bin->description)
                            <div class="panel-body" style="padding:15px;">
                                {{ $bin->description }}
                            </div>
                        @endif
                        <div class="panel-footer">
                            <span class="details">
                                <small>
                                    <span><i class="fa fa-file-text-o"></i> {{ $bin->snippets->count() }}</span>
                                    <span><i class="fa fa-comments"></i> {{ $bin->comments->count() }}</span>
                                    <span title="Created"><i class="fa fa-clock-o"></i> {{ $bin->created_at->diffForHumans() }}</span>
                                    @if($bin->modified())
                                        <span title="Updated"><i class="fa fa-pencil"></i> {{ $bin->updated_at->diffForHumans() }}</span>
                                    @endif
                                </small>
                            </span>
                        </div>
                    </div>
                @endforeach
                {!! $bins->render() !!}
            @else
                <div class="alert alert-info">
                    There are currently no bins. <a class="btn btn-sm btn-primary" style="margin-left:10px;" href="{{ route('bins.create') }}">Create Bin +</a>
                </div>
            @endif
        </div>
    </div>
@stop