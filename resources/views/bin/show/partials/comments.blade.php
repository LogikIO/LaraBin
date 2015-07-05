<div class="row">
    <div class="col-xs-12 col-md-10 col-md-offset-1">
        @if($bin->comments->count())
            @foreach($comments as $comment)
                <div id="{{ $comment->getRouteKey() }}" class="comment-details panel-default m-b-20 markcomment">
                    <div class="panel-heading"><a href="{{ $comment->user->url() }}">{{ $comment->user->username }}</a><span style="float:right;"><a href="#{{ $comment->getRouteKey() }}">#</a></span></div>
                    <div class="panel-body" style="padding:15px;">
                        {!! markdown()->renderComment($comment->message) !!}
                    </div>
                    <div class="panel-footer">
                        <span class="details">
                            <small>
                                <span title="Created"><i class="fa fa-clock-o"></i> {{ $comment->created_at->diffForHumans() }}</span>
                                @if($comment->modified())
                                    <span title="Updated"><i class="fa fa-pencil"></i> {{ $comment->updated_at->diffForHumans() }}</span>
                                @endif
                            </small>
                        </span>
                        @if(auth()->check() && auth()->user()->getAuthIdentifier() == $comment->user_id)
                            <span class="manage">
                                <a class="btn btn-info btn-xs" href="{{ route('bin.comments.edit', [$bin->getRouteKey(), $comment->getRouteKey()]) }}">Edit</a>
                                <a class="btn btn-danger btn-xs" href="{{ route('bin.comments.delete', [$bin->getRouteKey(), $comment->getRouteKey()]) }}">Delete</a>
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
            {!! $comments->render() !!}
        @else
            <div class="alert alert-info">
                There are currently no comments.
            </div>
        @endif
    </div>
</div>

@if(auth()->check())
    <div class="row m-b-20">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            {!! Form::open(['route' => ['bin.comments', $bin->getRouteKey()]]) !!}
            <div class="editor-instance">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group @if ($errors->has('message')) has-error @endif">
                            <div>
                                {!! Form::textarea('message', null, ['class' => 'form-control', 'id' => 'comment', 'required' => '']) !!}
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

            <button type="submit" class="btn btn-success btn-sm">Comment</button>
            {!! Form::close() !!}
        </div>
    </div>
@endif