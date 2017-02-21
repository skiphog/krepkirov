@if ($paginator->hasPages())
    <div class="content uk-margin-bottom">
        <ul class="uk-pagination uk-margin-top">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="uk-disabled"><span><i class="uk-icon-angle-double-left"></i></span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}"><i class="uk-icon-angle-double-left"></i></a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="uk-disabled"><span>{{ $element }}</span></li>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="uk-active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}"><i class="uk-icon-angle-double-right"></i></a></li>
            @else
                <li class="uk-disabled"><span><i class="uk-icon-angle-double-right"></i></span></li>
            @endif
        </ul>
    </div>
@endif