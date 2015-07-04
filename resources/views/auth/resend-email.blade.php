@extends('layout.master')

@section('title')
    @parent
    :: Resend Email Confirmation
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
                {!! Form::open(['route' => 'resend.email', 'class' => 'form-horizontal']) !!}
                <fieldset>

                    <legend>Resend Email Confirmation</legend>

                    <div class="form-group @if ($errors->has('email')) has-error @endif">
                        <div class="col-md-12">
                            <label class="control-label">Email</label>
                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => '']) !!}
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
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
                        </div>
                    </div>

                </fieldset>
                {!! Form::close() !!}
            </div>

        </div>

    </div>
@stop