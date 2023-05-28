@if ($paginator->hasPages())
<nav>
    <ul class=" product__pagination blog__pagination text-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <a class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <i class="fa fa-long-arrow-left"></i></span>
            @else

            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i
                    class="fa fa-long-arrow-left"></i></a>

            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <a class="disabled" aria-disabled="true">{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <a class="active" aria-current="page">{{ $page }}</a>
            @else
            <a href="{{ $url }}">{{ $page }}</a>
            @endif
            @endforeach
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i
                    class="fa fa-long-arrow-right"></i></a>
            @else
            <a class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <i class="fa fa-long-arrow-right"></i>
            </a>
            @endif
    </ul>
</nav>
@endif
