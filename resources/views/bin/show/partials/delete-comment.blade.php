<div class="row m-b-20">
    <h4 class="text-center m-b-20">Deleting Comment</h4>
    <div class="col-xs-12 col-md-10 col-md-offset-1">
        {!! Form::open(['route' => ['bin.comments.delete', $bin->getRouteKey(), $comment->getRouteKey()]]) !!}
        <div class="editor-instance">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group has-error">
                        <div>
                            {!! Form::textarea('message', $comment->message, ['class' => 'form-control', 'id' => 'comment', 'disabled' => '']) !!}
                            <span class="help-block">Are you sure?</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="errors"></div>

        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        {!! Form::close() !!}
    </div>
</div>