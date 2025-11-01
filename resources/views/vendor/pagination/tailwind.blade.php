@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="@lang('pagination.previous')"
                  class="relative inline-flex items-center px-3 py-2 mx-1 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-md cursor-default">
                <!-- Setinha Esquerda Desabilitada -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
               class="relative inline-flex items-center px-3 py-2 mx-1 text-sm font-medium text-gray-100 bg-gray-800 border border-gray-700 rounded-md hover:bg-gray-600 focus:z-10 focus:outline-none focus:ring ring-gray-300"
               aria-label="@lang('pagination.previous')">
                <!-- Setinha Esquerda -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span aria-disabled="true"
                      class="relative inline-flex items-center px-4 py-2 mx-1 text-sm font-medium text-gray-400 bg-gray-700 border border-gray-600 rounded-md">
                    {{ $element }}
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page"
                            class="relative inline-flex items-center px-3 py-2 mx-1 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-md font-bold">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="relative inline-flex items-center px-4 py-2 mx-1 text-sm font-medium text-gray-100 bg-gray-800 border border-gray-700 rounded-md hover:bg-gray-600 focus:z-10 focus:outline-none focus:ring ring-gray-300"
                           aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
               class="relative inline-flex items-center px-3 py-2 mx-1 text-sm font-medium text-gray-100 bg-gray-800 border border-gray-700 rounded-md hover:bg-gray-600 focus:z-10 focus:outline-none focus:ring ring-gray-300"
               aria-label="@lang('pagination.next')">
                <!-- Setinha Direita -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @else
            <span aria-disabled="true" aria-label="@lang('pagination.next')"
                  class="relative inline-flex items-center px-3 py-2 mx-1 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-md cursor-default">
                <!-- Setinha Direita Desabilitada -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </span>
        @endif
    </nav>
@endif