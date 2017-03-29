@if ($paginator->hasPages())
    <nav aria-label="post's pagination">
        <ul class="pager">
            @if ($paginator->onFirstPage())
                <li class="previous disabled"><span>&laquo;之前</span></li>
            @else
                <li class="previous"><a href="{{ $paginator->previousPageUrl() }}">&laquo;之前</a></li>
            @endif

            @if ($paginator->hasMorePages())
                <li class="next"><a href="{{ $paginator->nextPageUrl() }}">之后&raquo;</a></li>
            @else
                <li class="next disabled"><span>之后 &raquo;</span></li>
            @endif
        </ul>
    </nav>
@endif
