@if ($paginator->hasPages())
    <nav aria-label="Navigasi halaman">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li><span>&laquo; Sebelumnya</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; Sebelumnya</a></li>
            @endif

            <li><span>Halaman {{ $paginator->currentPage() }}</span></li>

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Berikutnya &raquo;</a></li>
            @else
                <li><span>Berikutnya &raquo;</span></li>
            @endif
        </ul>
    </nav>
@endif
