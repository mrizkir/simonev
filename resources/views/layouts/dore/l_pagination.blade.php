<nav class="mt-4 mb-3">
    <ul class="pagination justify-content-center mb-0">
        @if ($paginator->hasPages())
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <li class="page-item">
                <a class="page-link first" href="#">
                    <i class="simple-icon-control-start"></i>
                </a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link first" href="{{ $paginator->previousPageUrl() }}">
                    <i class="simple-icon-control-start"></i>
                </a>
            </li>
            <li class="page-item ">
                <a class="page-link prev" href="#">
                    <i class="simple-icon-arrow-left"></i>
                </a>
            </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled">
                        <a href="#">{{ $element }}</a>
                    </li>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link" href="#">{{ $page }}</a>
                            </li>                            
                        @else
                            <li class="page-item ">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li class="page-item ">
                <a class="page-link next" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                    <i class="simple-icon-arrow-right"></i>
                </a>
            </li>            
            @else
            <li class="page-item ">
                <a class="page-link last" href="#">
                    <i class="simple-icon-control-end"></i>
                </a>
            </li>
            @endif
        @else
        <li class="page-item active">
            <a class="page-link" href="#">1</a>
        </li>
        @endif        
    </ul>
</nav>