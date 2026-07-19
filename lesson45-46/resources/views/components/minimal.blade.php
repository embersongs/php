@if ($paginator->hasPages())
    <div>
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}">‹</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span>…</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <strong>{{ $page }}</strong>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">›</a>
        @endif
    </div>
@endif
