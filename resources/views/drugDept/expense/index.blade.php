<x-drugdept.layout title="Expense Records">
    <div class="container">
        <div class="container p-24 mx-auto">
            <h1 class="mb-4 text-2xl font-bold text-center text-gray-900 dark:text-white">Expense History</h1>
            <a href="{{ route('expense.create') }}"
                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-800" autofocus>New Expense</a>
            <br />
            <br />
            <div class="border border-gray-200 rounded-lg dark:border-gray-700">
                <div class="overflow-x-auto rounded-t-lg">
                    <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                        <thead class="text-left">
                            <tr>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">Sr No.</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">Date</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">Ward</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">Totals Items</th>
                                <th class="px-4 py-2 font-medium text-center text-gray-900 whitespace-nowrap dark:text-gray-200">Action</th>
                            </tr>
                        </thead>

                        <tbody class="border-t divide-y divide-gray-200 dark:divide-gray-700 dark:border-gray-700">
                            @foreach ($records as $record)
                                <tr class="border dark:border-gray-700">
                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">
                                        {{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap dark:text-gray-300">{{ $record->date }}</td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap dark:text-gray-300">{{ $record->ward->ward_name }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap dark:text-gray-300">{{ $record->getTotalRecordsAttribute() }}
                                    </td>
                                    <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap dark:text-gray-300">
                                        <span
                                            class="inline-flex pl-2 pr-2 ml-2 mr-2 -space-x-px overflow-hidden bg-white border rounded-md shadow-sm dark:bg-gray-700">
                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:relative"><a
                                                    href="{{ route('expense.edit', $record->id) }}"
                                                    class="text-blue-500 dark:text-blue-400 hover:underline">Edit</a>
                                            </button>

                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:relative"><a
                                                    href="{{ route('expenseRecord.create', $record->id) }}"
                                                    class="font-bold text-yellow-500 dark:text-yellow-400 hover:underline">Create Record</a>
                                            </button>

                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 dark:text-[#d4e282] hover:bg-gray-50 dark:hover:bg-gray-600 focus:relative"><a
                                                    href="{{ route('expense.show', $record->id) }}"
                                                    class="text-sm hover:underline">View Record</a>
                                            </button>

                                            <!--<button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:relative"><a
                                                    href="{{ route('expenseRecord.edit', $record->id) }}"
                                                    class="font-bold text-yellow-500 dark:text-yellow-400 hover:underline">Edit Record</a>
                                            </button>-->

                                            <!--<button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:relative">
                                                <form action="{{ route('expense.destroy', $record->id) }}" method="POST"
                                                    class="inline text-center">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 dark:text-red-400 hover:underline">Delete</button>-->
                                                </form>
                                            </button>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        <div class="flex items-center justify-center gap-3 my-4 text-sm">
        <x-drugdept.pagination :paginator="$records" />
        </div>
        </div>
    </div>
</x-drugdept.layout>