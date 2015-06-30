@extends('layout.master')

@section('title')
    @parent
    :: Registration
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
    <div class="col-md-6 col-md-offset-3">

        <div class="well">
            {!! Form::open(['route' => 'register', 'class' => 'form-horizontal']) !!}
                <fieldset>

                    <legend>Registration</legend>

                    <div class="form-group @if ($errors->has('username')) has-error @endif">
                        <div class="col-md-12">
                            <label class="control-label">Username</label>
                            {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username', 'required' => '']) !!}
                            @if ($errors->has('username'))
                                <span class="help-block">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('email')) has-error @endif">
                        <div class="col-md-12">
                            <label class="control-label">Email</label>
                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => '']) !!}
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('password')) has-error @endif">
                        <div class="col-md-12">
                            <label class="control-label">Password</label>
                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required' => '']) !!}
                            @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
                        <div class="col-md-12">
                            <label class="control-label">Password Confirmation</label>
                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Password Confirmation', 'required' => '']) !!}
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>


                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>

                </fieldset>
            {!! Form::close() !!}
        </div>

    </div>
</div>
@stop