@if ($paginator->hasPages())
    <nav>
        <ul class="pagination-wrap">
            @if ($paginator->onFirstPage())
                <li class="page-item"><span class="page-link disabled">‹</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->currentPage() - 1) }}">‹</a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item"><span class="page-link disabled">{{ $element }}</span></li>
                @elseif (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="page-item">
                            <a class="page-link {{ $page == $paginator->currentPage() ? 'active' : '' }}" href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->lastPage() == $paginator->currentPage())
                <li class="page-item"><span class="page-link disabled">›</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->currentPage() + 1) }}">›</a></li>
            @endif
        </ul>
    </nav>
@endif
