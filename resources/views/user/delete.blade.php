@extends('layout.master')

@section('title')
    @parent
    :: Confirm Account Deletion
@stop

@section('customcssfiles')

@stop

@section('customcss')
.form-group{margin-bottom:25px}
@stop

@section('customjsfiles')

@stop

@section('customjs')

@stop

@section('content')
<div clas="row">
    <div class="col-md-6 col-md-offset-3">
        <h3>We hate to see you go... :\</h3>

        <div class="alert alert-warning">
            <strong>Heads up!</strong> Deleting your account will delete your {{ auth()->user()->bins->count() }} bins, {{ auth()->user()->snippets->count() }} files and all account data. Proceed with caution!
        </div>

        <div class="well">
            {!! Form::open(['route' => 'delete', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
            <fieldset>

                <legend>Account Deletion</legend>

                @if(auth()->user()->getAuthPassword())
                <div class="form-group">
                    <div class="col-md-12">
                        <label class="control-label">Current Password</label>
                        <!-- fakepassword disables autofill for chrome so an accidental click doesn't delete account due to autofill -->
                        <!-- Refer to http://stackoverflow.com/a/15917221/3369048 -->
                        {!! Form::password('fakepassword', ['style' => 'display:none;']) !!}
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Current Password', 'required' => '', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                @endif

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

                <button type="submit" class="btn btn-sm btn-danger">Delete</button>

            </fieldset>
            {!! Form::close() !!}
        </div>

    </div>
</div>
@stop