@extends('layout.master')

@section('title')
    @parent
    :: Editing User
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
    <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3">

        <div class="well">
            {!! Form::open(['route' => ['admin.users.edit', $user->id], 'class' => 'form-horizontal']) !!}
            <fieldset>

                <legend>Editing User</legend>

                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    <div class="col-md-12">
                        <label class="control-label">Name</label>
                        {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => '']) !!}
                        @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group @if ($errors->has('username')) has-error @endif">
                    <div class="col-md-12">
                        <label class="control-label">Username</label>
                        {!! Form::text('username', $user->username, ['class' => 'form-control', 'placeholder' => 'Username', 'required' => '']) !!}
                        @if ($errors->has('username'))
                            <span class="help-block">{{ $errors->first('username') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group @if ($errors->has('email')) has-error @endif">
                    <div class="col-md-12">
                        <label class="control-label">Email</label>
                        {!! Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => '']) !!}
                        @if ($errors->has('email'))
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group @if ($errors->has('website')) has-error @endif">
                    <div class="col-md-12">
                        <label class="control-label">Website</label><small> (not required)</small>
                        {!! Form::text('website', $user->settings()->get('website'), ['class' => 'form-control', 'placeholder' => 'Website']) !!}
                        @if ($errors->has('website'))
                            <span class="help-block">{{ $errors->first('website') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group @if ($errors->has('github_username')) has-error @endif">
                    <div class="col-md-12">
                        <label class="control-label">GitHub Username</label><small> (not required) So we can link to your profile!</small>
                        {!! Form::text('github_username', $user->settings()->get('github_username'), ['class' => 'form-control', 'placeholder' => 'GitHub Username']) !!}
                        @if ($errors->has('github_username'))
                            <span class="help-block">{{ $errors->first('github_username') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group @if ($errors->has('twitter_username')) has-error @endif">
                    <div class="col-md-12">
                        <label class="control-label">Twitter Username</label><small> (not required) So we can link to your profile!</small>
                        {!! Form::text('twitter_username', $user->settings()->get('twitter_username'), ['class' => 'form-control', 'placeholder' => 'Twitter Username']) !!}
                        @if ($errors->has('twitter_username'))
                            <span class="help-block">{{ $errors->first('twitter_username') }}</span>
                        @endif
                    </div>
                </div>


                <button type="submit" class="btn btn-sm btn-primary">Update</button>

            </fieldset>
            {!! Form::close() !!}
        </div>

    </div>
</div>
@stop