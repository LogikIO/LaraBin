@extends('layout.master')

@section('title')
    @parent
    :: Create Bin
@stop

@section('customcssfiles')
    {!! HTML::style('css/bins/create.css') !!}
    {!! HTML::style('vendors/bootstrap-select/css/bootstrap-select.min.css') !!}
@stop

@section('customcss')

@stop

@section('customjsfiles')
    {!! HTML::script('vendors/ace/src-min-noconflict/ace.js') !!}
    {!! HTML::script('vendors/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('js/bins/create.js') !!}
@stop

@section('customjs')

@stop

@section('content')
<div class="row">
    <div class="col-xs-10 col-xs-offset-1">
        <div class="row">
            {!! Form::open(['route' => 'bins.create']) !!}
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label">Bin Title</label>
                                <input type="text" class="form-control input-sm" name="title" placeholder="Bin Title" required="" maxlength="150" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Visibility</label>
                                    {!! Form::select('visibility', binVisibility(), 1, ['class' => 'form-control input-sm']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-10">
                            <div class="form-group">
                                <label class="control-label">Bin Description <small>(not required)</small></label>
                                <input type="text" class="form-control input-sm" name="description" placeholder="Bin Description" maxlength="255" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-10">
                            <div class="form-group">
                                <label class="control-label">Laravel Version(s)</label>
                                <br>
                                {!! Form::select('versions[]', $versions, null, ['class' => 'selectpicker', 'multiple' => '']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div id="editor-container">

                </div>

                <div style="margin-top:20px;" class="col-xs-12">
                    <div id="errors"></div>
                </div>

                <div style="margin-top:20px;" class="col-xs-12">
                    <div class="form-group">
                        <a id="add-file" class="btn btn-sm btn-info">Add File +</a>
                        <button type="submit" class="btn btn-sm btn-success">Save Bin</button>
                    </div>
                </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>

@include('bin.new-snippet')
@stop