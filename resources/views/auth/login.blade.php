@extends('layout.master')

@section('title')
    @parent
    :: Login
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
            <a href="{{ route('social.github') }}" class="btn btn-block btn-social btn-lg btn-github"><i class="fa fa-github"></i>Login with GitHub</a>
        </div>

        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3">

            <div class="well">
                {!! Form::open(['route' => 'login', 'class' => 'form-horizontal']) !!}
                <fieldset>

                    <legend>Login</legend>

                    <div class="form-group @if ($errors->has('useremail')) has-error @endif">
                        <div class="col-md-12">
                            <label class="control-label">Username or Email</label>
                            {!! Form::text('useremail', null, ['class' => 'form-control', 'placeholder' => 'Username or Email', 'required' => '']) !!}
                            @if ($errors->has('useremail'))
                                <span class="help-block">{{ $errors->first('useremail') }}</span>
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

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox"> Remember me?
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-sm btn-success">Login</button>
                            <a style="float:right;" href="{{ route('reset') }}" class="btn btn-sm btn-default">Reset Password</a>
                        </div>
                    </div>

                </fieldset>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@stop