@extends('layout.master')

@section('title')
    @parent
    :: Login
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

                    <button type="submit" class="btn btn-sm btn-success">Login</button>

                </fieldset>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@stop