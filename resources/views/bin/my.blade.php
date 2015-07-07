@extends('layout.master')

@section('title')
    @parent
    :: My Bins
@stop

@section('customcssfiles')

@stop

@section('customcss')
.visibility{
    display: inline-block;
    width: 100px;
}
.details span{margin-right:4px}
.label-versions:first-of-type{margin-left:6px;}
@stop

@section('customjsfiles')

@stop

@section('customjs')
$('.visibility').on('change', function(){
    var id = $(this).data('id');
    var visibility = $(this).val();
    $.post('{{ route('bins.ajax') }}', { type: 'visibility', id: id, visibility: visibility})
        .done(function(e){
            $.bootstrapGrowl(e.msg, {
                type: 'success',
                width: 'auto',
                delay: 2000,
                allow_dismiss: true
            });
        })
        .fail(function(e){
            $.bootstrapGrowl(e.responseJSON.msg, {
                type: 'danger',
                width: 'auto',
                delay: 2000,
                allow_dismiss: true
            });
        });
});
$('.hash').click(function() {
    var id = $(this).data('id');
    $.post('{{ route('bins.ajax') }}', { type: 'hash', id: id})
        .done(function(e){
            $.bootstrapGrowl(e.msg, {
                type: 'success',
                width: 'auto',
                delay: 2000,
                allow_dismiss: true
            });
            if(e.status == 'enabled') {
                $('#share-button-'+id).text('Disable Sharing');
                $('#share-'+id+' input').val(e.url);
                $('#share-'+id).show();
            } else {
                // disabled
                $('#share-button-'+id).text('Share');
                $('#share-'+id).hide();

            }
        })
        .fail(function(e){
            $.bootstrapGrowl(e.responseJSON.msg, {
                type: 'danger',
                width: 'auto',
                delay: 2000,
                allow_dismiss: true
            });
        });
});
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        @if($bins->count())
            @foreach($bins as $bin)
                <div id="{{ $bin->getRouteKey() }}" data-title="{{ $bin->title }}" class="bin-details panel panel-default">
                    <div class="panel-heading">
                        {!! Form::select('visibility', binVisibility(), $bin->visibility, ['class' => 'form-control input-sm visibility', 'data-id' => $bin->getRouteKey()]) !!}<small>{!! $bin->versions_label() !!}</small><a href="{{ $bin->url() }}">{{ $bin->title }}</a>
                        @if($bin->tweeted())
                            <span class="m-l-5" style="float:right;"><i title="Has been tweeted!" class="fa fa-twitter"></i></span>
                        @endif
                        @if($bin->isPrivate())
                            @if(!$bin->isShared())
                            <span style="float:right;"><button id="share-button-{{ $bin->getRouteKey() }}" class="hash btn btn-xs btn-warning" data-id="{{ $bin->getRouteKey() }}">Share</button></span>
                            @else
                                <span style="float:right;"><button id="share-button-{{ $bin->getRouteKey() }}" class="hash btn btn-xs btn-warning" data-id="{{ $bin->getRouteKey() }}">Disable Sharing</button></span>
                            @endif
                        @endif
                    </div>
                    @if($bin->description)
                        <div class="panel-body">
                            {{ $bin->description }}
                            @if($bin->isPrivate())
                                <div id="share-{{ $bin->getRouteKey() }}" class="alert alert-info m-t-10 m-b-0" style="{{ (!$bin->isShared()) ? 'display:none;' : '' }}">
                                    <p class="m-0">
                                        <h5 class="m-t-0">Share URL:</h5>
                                        <input type="text" class="m-t-10 form-control" disabled="" value="{{ $bin->shareUrl() }}" />
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="panel-footer">
                        <span class="details">
                            <small>
                                <span><i class="fa fa-file-text-o"></i> {{ $bin->snippets->count() }}</span>
                                <span><i class="fa fa-comments"></i> <a href="{{ route('bin.comments', $bin->getRouteKey()) }}">{{ $bin->comments->count() }}</a></span>
                                <span title="Created"><i class="fa fa-clock-o"></i> {{ $bin->created_at->diffForHumans() }}</span>
                                @if($bin->modified())
                                    <span title="Updated"><i class="fa fa-pencil"></i> {{ $bin->updated_at->diffForHumans() }}</span>
                                @endif
                            </small>
                        </span>
                        <span style="float:right;">
                            <a class="btn btn-info btn-xs" href="{{ route('bin.edit', hashid()->encode($bin->id)) }}">Edit</a>
                            <a class="btn btn-danger btn-xs" href="{{ route('bin.delete', hashid()->encode($bin->id)) }}">Delete</a>
                        </span>
                    </div>
                </div>
            @endforeach
            {!! $bins->render() !!}
        @else
            <div class="alert alert-info">
                You currently have no bins. <a class="btn btn-sm btn-primary" style="margin-left:10px;" href="{{ route('bins.create') }}">Create Bin +</a>
            </div>
        @endif
    </div>
</div>
@stop