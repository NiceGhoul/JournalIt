<div class="flex items-center justify-between border-t border-gray-700 bg-[#2d2d2d] px-4 py-3 sm:px-6">
    <!-- Mobile Version (Hidden on small screens) -->
    <div class="flex flex-1 justify-between sm:hidden">
        @if ($paginator->onFirstPage())
            <span
                class="relative inline-flex items-center rounded-md border border-gray-600 bg-[#2d2d2d] px-4 py-2 text-sm font-medium text-gray-400">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="relative inline-flex items-center rounded-md border border-gray-600 bg-[#2d2d2d] px-4 py-2 text-sm font-medium text-gray-400 hover:bg-gray-700">Previous</a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-600 bg-[#2d2d2d] px-4 py-2 text-sm font-medium text-gray-400 hover:bg-gray-700">Next</a>
        @else
            <span
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-600 bg-[#2d2d2d] px-4 py-2 text-sm font-medium text-gray-400">Next</span>
        @endif
    </div>

    <!-- Desktop Version (Visible on larger screens) -->
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <!-- Showing Results Information -->
        <div>
            <p class="text-sm text-gray-400">
                Showing
                <span class="font-medium text-white">{{ $paginator->firstItem() }}</span>
                to
                <span class="font-medium text-white">{{ $paginator->lastItem() }}</span>
                of
                <span class="font-medium text-white">{{ $paginator->total() }}</span>
                results
            </p>
        </div>

        <!-- Pagination Controls (Aligned to the right) -->
        <div class="ml-auto">
            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                <!-- Previous Button -->
                @if ($paginator->onFirstPage())
                    <span
                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-600">
                        <span class="sr-only">Previous</span>
                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-600 hover:bg-gray-700">
                        <span class="sr-only">Previous</span>
                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif

                <!-- Page Numbers -->
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span
                            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-400 ring-1 ring-inset ring-gray-600">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <a href="#"
                                    class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $page }}</a>
                            @else
                                <a href="{{ $url }}"
                                    class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-400 ring-1 ring-inset ring-gray-600 hover:bg-gray-700">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                <!-- Next Button -->
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-600 hover:bg-gray-700">
                        <span class="sr-only">Next</span>
                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span
                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-600">
                        <span class="sr-only">Next</span>
                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                @endif
            </nav>
        </div>
    </div>
</div>
