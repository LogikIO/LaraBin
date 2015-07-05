@extends('layout.master')

@section('title')
    @parent
    :: Delete Bin
@stop

@section('customcssfiles')

@stop

@section('customcss')

@stop

@section('customjsfiles')

@stop

@section('customjs')

@stop

@section('content')
    <div clas="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="alert alert-warning">
                <strong>Heads up!</strong> Deleting this bin will also delete the {{ $bin->snippets->count() }} associated files and {{ $bin->comments->count() }} comments. Proceed with caution!
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="bin-details panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ $bin->url() }}">{{ $bin->title }}</a>
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
                                    <span><i class="fa fa-comments"></i> <a href="{{ route('bin.comments', $bin->getRouteKey()) }}">{{ $bin->comments->count() }}</a></span>
                                    <span title="Created"><i class="fa fa-clock-o"></i> {{ $bin->created_at->diffForHumans() }}</span>
                                    @if($bin->modified())
                                        <span title="Updated"><i class="fa fa-pencil"></i> {{ $bin->updated_at->diffForHumans() }}</span>
                                    @endif
                                </small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="well">
                {!! Form::open(['route' => ['bin.delete', $bin->getRouteKey()], 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
                <fieldset>

                    <legend>Bin Deletion</legend>

                    <div class="form-group @if ($errors->has('agree')) has-error @endif">
                        <div class="col-sm-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="agree" value="1" required=""> I am aware that this is permanent.
                                </label>
                            </div>
                            @if ($errors->has('agree'))
                                <span class="help-block">{{ $errors->first('agree') }}</span>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-danger">Delete Bin</button>

                </fieldset>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@stop