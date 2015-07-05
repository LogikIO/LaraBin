<div class="bin-details panel panel-default">
    <div class="panel-heading">
        <small>{!! $bin->label() !!}{!! $bin->versions_label() !!}</small>
        <a href="{{ $bin->user->url() }}">{{ $bin->user->username }}</a>&nbsp;&nbsp;/&nbsp;&nbsp;{{ $bin->title }}
    </div>
    @if($bin->description)
        <div class="panel-body" style="padding:15px;">
            {{ $bin->description }}
        </div>
    @endif
    <div class="panel-footer">
                <span class="details">
                    <small>
                        <span title="Created"><i class="fa fa-clock-o"></i> {{ $bin->created_at->diffForHumans() }}</span>
                        @if($bin->modified())
                            <span title="Updated"><i class="fa fa-pencil"></i> {{ $bin->updated_at->diffForHumans() }}</span>
                        @endif
                    </small>
                </span>
        @if(auth()->check() && auth()->user()->getAuthIdentifier() == $bin->user_id)
            <span class="manage">
                        <a class="btn btn-info btn-xs" href="{{ route('bin.edit', $bin->getRouteKey()) }}">Edit</a>
                        <a class="btn btn-danger btn-xs" href="{{ route('bin.delete', $bin->getRouteKey()) }}">Delete</a>
                    </span>
        @endif
    </div>
</div>