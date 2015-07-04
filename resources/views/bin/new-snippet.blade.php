<div id="editor-template">
    <div class="col-xs-12 editor-instance">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                            <label class="control-label">File name:</label>
                            {!! Form::text('name', null, ['class' => 'form-control input-sm', 'required' => '', 'placeholder' => 'Name this file...', 'maxlength' => '150']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Select language:</label>
                            {!! Form::select('language', $types, 1, ['class' => 'language form-control input-sm']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                {!! Form::textarea('code', null, ['class' => 'real-code', 'style' => 'display:none']) !!}
                <div class="editor-area"></div>
            </div>
            <div class="col-xs-12">
                <div class="row">
                    <div class="form-group col-xs-12 col-md-4">
                        <button class="delete-file btn btn-sm btn-danger">Delete File</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>