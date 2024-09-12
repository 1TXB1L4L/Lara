<x-drugdept.layout title="Expense Records">
    <div class="container">

        <div class="container p-24 mx-auto">
            <h1 class="text-2xl font-bold text-center mb-4">Expense History</h1>
            <a href="{{ route('expense.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">New Expense</a>
            <br />
            <br />
            <div class="rounded-lg border border-gray-200">
                <div class="overflow-x-auto rounded-t-lg">
                    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                        <thead class="text-left">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Sr No.</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Date</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Ward</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Totals Items</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 border-t">
                            @foreach ($records as $record)
                                <tr class="border">
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        {{ $loop->iteration }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $record->date }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $record->ward->ward_name }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $record->getTotalRecordsAttribute() }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                        <span
                                            class="inline-flex -space-x-px overflow-hidden rounded-md border bg-white shadow-sm pr-2 pl-2 ml-2 mr-2">
                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative"><a
                                                    href="{{ route('expense.edit', $record->id) }}"
                                                    class="text-blue-500 hover:underline">Edit</a>
                                            </button>

                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative"><a
                                                    href="{{ route('expenseRecord.create', $record->id) }}"
                                                    class="text-yellow-500 hover:underline font-bold">Create Record</a>
                                            </button>

                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative"><a
                                                    href="{{ route('expense.show', $record->id) }}"
                                                    class="text-blue-500 hover:underline">View Record</a>
                                            </button>

                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative"><a
                                                    href="{{ route('expenseRecord.edit', $record->id) }}"
                                                    class="text-yellow-500 hover:underline font-bold">Edit Record</a>
                                            </button>

                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
                                                <form action="{{ route('expense.destroy', $record->id) }}" method="POST"
                                                    class="inline text-center">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 hover:underline">Delete</button>
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