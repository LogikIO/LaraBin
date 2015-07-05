@extends('layout.master')

@section('title')
    @parent
    :: Set New Password
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
    <div class="row">

        <div class="col-xs-12 col-sm-6 col-sm-offset-3">

            <div class="well">
                {!! Form::open(['route' => ['reset.confirm', $token->token], 'class' => 'form-horizontal']) !!}
                <fieldset>

                    <legend>Set New Password</legend>

                    <div class="form-group @if ($errors->has('new_password')) has-error @endif">
                        <div class="col-md-12">
                            <label class="control-label">New Password</label>
                            {!! Form::password('new_password', ['class' => 'form-control input-sm', 'placeholder' => 'New Password', 'required' => '']) !!}
                            @if ($errors->has('new_password'))
                                <span class="help-block">{{ $errors->first('new_password') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('new_password')) has-error @endif">
                        <div class="col-md-12">
                            <label class="control-label">New Password Confirmation</label>
                            {!! Form::password('new_password_confirmation', ['class' => 'form-control input-sm', 'placeholder' => 'New Password Confirmation', 'required' => '']) !!}
                            @if ($errors->has('new_password_confirmation'))
                                <span class="help-block">{{ $errors->first('new_password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </div>

                </fieldset>
                {!! Form::close() !!}
            </div>

        </div>

    </div>
@stop