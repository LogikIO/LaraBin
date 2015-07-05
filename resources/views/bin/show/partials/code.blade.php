@foreach($bin->snippets as $snippet)
    <div id="{{ hashid()->encode($snippet->id) }}" class="panel panel-default">
        <div class="panel-heading"><small>{!! $snippet->label() !!}&nbsp;&nbsp;&nbsp;<a href="#{{ hashid()->encode($snippet->id) }}">{{ $snippet->name }}</a></small> <span class="raw"><a href="{{ $snippet->url() }}" class="btn btn-xs btn-primary">Raw</a></span></div>
        <div class="panel-body">
            @if($snippet->type->css_class == 'markdown')
                {{--<div class="markrender">{!! commonmark()->convertToHtml($snippet->code) !!}</div>--}}
                <div class="markrender">{!! markdown()->renderCode($snippet->code) !!}</div>
            @elseif($snippet->type->css_class == 'nohighlight')
                <div class="plaintext">
                    <pre><code class="{{ $snippet->type->css_class }}">{{ $snippet->code }}</code></pre>
                </div>
            @else
                <div class="highlightable">
                    <pre><code class="{{ $snippet->type->css_class }}">{{ $snippet->code }}</code></pre>
                </div>
            @endif
        </div>
    </div>
@endforeach