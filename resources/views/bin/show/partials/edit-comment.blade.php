<div class="row m-b-20">
    <h4 class="text-center m-b-20">Editing Comment</h4>
    <div class="col-xs-12 col-md-10 col-md-offset-1">
        {!! Form::open(['route' => ['bin.comments.edit', $bin->getRouteKey(), $comment->getRouteKey()]]) !!}
        <div class="editor-instance">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group @if ($errors->has('message')) has-error @endif">
                        <div>
                            {!! Form::textarea('message', $comment->message, ['class' => 'form-control', 'id' => 'comment', 'required' => '']) !!}
                            @if ($errors->has('message'))
                                <span class="help-block">{{ $errors->first('message') }}</span>
                            @endif
                            <span class="help-block">Markdown supported. User tagging supported ( @username ) <small>[ still working on notifying user they were tagged ]</small></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="errors"></div>

        <button type="submit" class="btn btn-success btn-sm">Update</button>
        {!! Form::close() !!}
    </div>
</div>