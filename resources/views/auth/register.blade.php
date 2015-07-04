@extends('layout.master')

@section('title')
    @parent
    :: Registration
@stop

@section('customcssfiles')
    {!! HTML::style('css/bootstrap-social.css') !!}
@stop

@section('customcss')
    .btn-github {
        padding:10px 15px 10px 61px;
    }
@stop

@section('customjsfiles')

@stop

@section('customjs')

@stop

@section('content')
<div class="row">

    <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4" style="margin-bottom:20px;">
        <a href="{{ route('social.github') }}" class="btn btn-block btn-social btn-lg btn-github"><i class="fa fa-github"></i>Register with GitHub</a>
    </div>

    <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3">

        <div class="well">
            {!! Form::open(['route' => 'register', 'class' => 'form-horizontal']) !!}
                <fieldset>

                    <legend>Registration</legend>

                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                        <div class="col-md-12">
                            <label class="control-label">Name</label>
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => '']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

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

                    <div class="form-group @if ($errors->has('password')) has-error @endif">
                        <div class="col-md-12">
                            <label class="control-label">Password Confirmation</label>
                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Password Confirmation', 'required' => '']) !!}
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('g-recaptcha-response')) has-error @endif">
                        <div class="col-md-12">
                            {!! Recaptcha::render() !!}
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">{{ $errors->first('g-recaptcha-response') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            <a style="float:right;" href="{{ route('resend.email') }}" class="btn btn-sm btn-default">Resend Confirmation</a>
                        </div>
                    </div>

                </fieldset>
            {!! Form::close() !!}
        </div>

    </div>

</div>
@stop