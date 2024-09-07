<div class="flex">
    @if ($items->onFirstPage())
        <span class="flex items-center px-4 py-2 mx-1 text-gray-500 bg-white rounded-md cursor-not-allowed dark:bg-gray-800 dark:text-gray-600">
            Previous
        </span>
    @else
        <a href="{{ $items->previousPageUrl() }}" class="flex items-center px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md dark:bg-gray-800 dark:text-gray-200 hover:bg-blue-600 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200">
            Previous
        </a>
    @endif

    @foreach ($items->links()->elements[0] as $page => $url)
        @if ($page == $items->currentPage())
            <span class="items-center hidden px-4 py-2 mx-1 text-white bg-blue-600 rounded-md sm:flex dark:bg-blue-500">
                {{ $page }}
            </span>
        @else
            <a href="{{ $url }}" class="items-center hidden px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md sm:flex dark:bg-gray-800 dark:text-gray-200 hover:bg-blue-600 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200">
                {{ $page }}
            </a>
        @endif
    @endforeach

    @if ($items->hasMorePages())
        <a href="{{ $items->nextPageUrl() }}" class="flex items-center px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md dark:bg-gray-800 dark:text-gray-200 hover:bg-blue-600 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200">
            Next
        </a>
    @else
        <span class="flex items-center px-4 py-2 mx-1 text-gray-500 bg-white rounded-md cursor-not-allowed dark:bg-gray-800 dark:text-gray-600">
            Next
        </span>
    @endif
</div>
