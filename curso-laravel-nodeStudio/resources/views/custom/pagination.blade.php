@if ($paginator->hasPages())
<ul class="pagination">
    {{-- Previous page link --}}
    @if ($paginator->onFirstPage())
        <li class="disabled"><i class="material-icons">chevron_left</i></li>
    @else
        <li class="waves-effect"><a href="{{ $paginator->previousPageUrl() }}"><i class="material-icons">chevron_right</i></a></li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- "three dots" separator --}}
    @if (is_string($element))
        <li class="disabled">{{ $element }}</li>
    @endif

    {{-- Array of links --}}
    @if (is_array($element))
        @foreach ($elements as $page => $url)
            @if ($page == $paginator->currentPage())
                <li class="active">
                    <a>{{ $page }}</a>
                </li>
            @else
                <li class="waves-effect"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
            @endif
        @endforeach
    @endif
    @endforeach

    {{-- Next page link--}}
    @if ($paginator->hasMorePages())
        <li class="waves-effect"><a href="{{ $paginator->nextPageUrl() }}"><i class="material-icons">chevron_right</i></a></li>
    @else
        <li class="disabled"><a href="{{ $paginator->nextPageUrl() }}"><i class="material-icons">chevron_right</i></a></li>
        
    @endif

</ul>
    
@endif