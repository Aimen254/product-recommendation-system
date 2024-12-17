<style>
    .previous {
        position: fixed;
        top: 50%;
    }
    .next {
        position: fixed;
        top: 50%;
        left: 92%;
    }
    i{
        color:#D60C8C; font-size:36px
    }

    .previous:hover i{
        color: #002B5C;
    }
    .next span, .next a, .previous span, .previous a{
        border: 2px solid #D60C8C; border-radius:50%; color:#fff; height: 70px !important;
    display: block;
    width: 70px;
    }
    .previous:hover a, .previous:hover span{
        border: 2px solid #002B5C!important;
    }
    .next:hover i{
        color: #002B5C;
    }
    .next:hover a, .next:hover span{
        border: 2px solid #002B5C;
    }
    @media (max-width: 992px) {
        .previous {
            position: fixed;
            top: 83%;
            /* display: none; */
        }

        .next {
            position: fixed;
            top: 83%;
            left: 80%;
            /* display: none; */
        }

    }

</style>
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        <div class="previous">
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex items-center px-4 py-3 text-sm font-medium text-gray-500 cursor-default leading-5 rounded-md">
                   <i class="far fa-less-than"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="relative inline-flex items-center px-4 py-3 text-sm font-medium text-gray-700 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                    >
                  <i class="far fa-less-than"></i>
                </a>
            @endif
        </div>
        {{-- Next Page Link --}}
        <div class="next">
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="relative inline-flex pt-2 items-center px-4 py-3 text-sm font-medium text-gray-700 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                    >
                    <i class="far fa-greater-than"></i>
                </a>
            @else
                <span
                    class="relative inline-flex items-center px-4 py-3 text-sm font-medium text-gray-500 cursor-default leading-5 rounded-md"
                   >
                    <i class="far fa-greater-than" ></i>
                </span>
            @endif
        </div>
    </nav>
@endif
