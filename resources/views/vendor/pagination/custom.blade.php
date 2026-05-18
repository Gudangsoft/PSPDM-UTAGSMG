@if ($paginator->hasPages())
<nav class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2 mt-3">
    {{-- Info --}}
    <p class="mb-0 text-muted" style="font-size:.82rem;">
        Menampilkan <strong>{{ $paginator->firstItem() }}</strong>–<strong>{{ $paginator->lastItem() }}</strong>
        dari <strong>{{ $paginator->total() }}</strong> data
    </p>

    {{-- Page buttons --}}
    <ul class="pagination mb-0" style="gap:4px;">

        {{-- Prev --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link rounded-pill px-3" style="border:none; background:#f5f5f5; color:#aaa; font-size:.82rem;">
                    <i class="bi bi-chevron-left"></i>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link rounded-pill px-3" href="{{ $paginator->previousPageUrl() }}"
                   style="border:none; background:#f5f5f5; color:#555; font-size:.82rem;">
                    <i class="bi bi-chevron-left"></i>
                </a>
            </li>
        @endif

        {{-- Pages --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link rounded-pill px-3" style="border:none; background:transparent; color:#aaa; font-size:.82rem;">…</span>
                </li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link rounded-pill px-3"
                                  style="border:none; background:linear-gradient(135deg,#C0304A,#8B1A2E); color:white; font-size:.82rem; font-weight:700; box-shadow:0 2px 8px rgba(192,48,74,.35);">
                                {{ $page }}
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link rounded-pill px-3" href="{{ $url }}"
                               style="border:none; background:#f5f5f5; color:#555; font-size:.82rem; transition:all .15s;"
                               onmouseover="this.style.background='#ffe5ea'; this.style.color='#C0304A';"
                               onmouseout="this.style.background='#f5f5f5'; this.style.color='#555';">
                                {{ $page }}
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link rounded-pill px-3" href="{{ $paginator->nextPageUrl() }}"
                   style="border:none; background:#f5f5f5; color:#555; font-size:.82rem;">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link rounded-pill px-3" style="border:none; background:#f5f5f5; color:#aaa; font-size:.82rem;">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </li>
        @endif

    </ul>
</nav>
@endif
