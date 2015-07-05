@extends('layout.master')

@section('title')
    @parent
    :: New Tweet
@stop

@section('customcssfiles')

@stop

@section('customcss')
    #char-left{color:#ff0000}
@stop

@section('customjsfiles')

@stop

@section('customjs')
    $('#new-tweet').on('keyup', function(event) {
        var len = $(this).val().length;
        if (len >= 140) {
            $(this).val($(this).val().substring(0, len-1));
        }
        $('#char-left').text('Left: '+(140 - len));
    });
@stop

@section('content')
<div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
        <h4>New Tweet</h4>
        {!! Form::open(['route' => 'admin.twitter.new', 'class' => 'form-horizontal']) !!}
        <div class="form-group @if ($errors->has('message')) has-error @endif">
            <label class="">Message (140 char limit) <span id="char-left"></span></label>
            {!! Form::textarea('message', null, ['id' => 'new-tweet', 'class' => 'form-control', 'maxlength' => '140', 'required' => '']) !!}
            @if ($errors->has('message'))
                <span class="help-block">{{ $errors->first('message') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-success btn-sm">Submit</button>
        {!! Form::close() !!}
    </div>
</div>
@stop