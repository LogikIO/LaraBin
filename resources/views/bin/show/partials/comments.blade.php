@if($bin->comments->count())

@else
    <div class="alert alert-info">
        There are currently no comments.
    </div>
@endif

<div class="editor-instance">
    <div class="row">
        <div class="col-xs-12">
            {!! Form::textarea('message', null, ['class' => 'real-code', 'style' => 'display:none']) !!}
            <div id="editor-area"></div>
        </div>
    </div>
</div>