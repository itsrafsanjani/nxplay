@if ($paginator->hasPages())
    <ul class="paginator">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span ><i class="icon ion-ios-arrow-back"></i></span ></li>
        @else
            <li class="paginator__item paginator__item--prev"><a  href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="icon ion-ios-arrow-back"></i></a></li>
        @endif

        @if($paginator->currentPage() > 2)
            <li class="paginator__item"><a  href="{{ $paginator->url(1) }}">1</a></li>
        @endif
        @if($paginator->currentPage() > 3)
            <li class="paginator__item"><span >...</span ></li>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 1)
                @if ($i == $paginator->currentPage())
                    <li class="paginator__item paginator__item--active"><a class="text-warning">{{ $i }}</a ></li>
                @else
                    <li class="paginator__item"><a  href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <li class="paginator__item"><span >...</span ></li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 1)
            <li class="paginator__item"><a  href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="paginator__item paginator__item--next"><a  href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="icon ion-ios-arrow-forward"></i></a></li>
        @else
            <li class="paginator__item disabled"><span ><i class="icon ion-ios-arrow-forward"></i></span ></li>
        @endif
    </ul>
@endif
