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
                offset: {from: 'top', amount: 80},
                width: 'auto',
                delay: 2000,
                allow_dismiss: true
            });
        });
});
@stop

@section('content')
<div class="row">
    <div class="col-xs-10 col-xs-offset-1">
        @if($bins->count())
            @foreach($bins as $bin)
                <div id="{{ hashid()->encode($bin->id) }}" data-title="{{ $bin->title }}" class="bin-details panel panel-default">
                    <div class="panel-heading">
                        {!! Form::select('visibility', binVisibility(), $bin->visibility, ['class' => 'form-control input-sm visibility', 'data-id' => hashid()->encode($bin->id)]) !!}<small>{!! $bin->versions_label() !!}</small><a href="{{ $bin->url() }}">{{ $bin->title }}</a>
                    </div>
                    @if($bin->description)
                        <div class="panel-body">
                            {{ $bin->description }}
                        </div>
                    @endif
                    <div class="panel-footer">
                        <span class="details">
                            <small>
                                <span><i class="fa fa-file-text-o"></i> {{ $bin->snippets->count() }}</span>
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