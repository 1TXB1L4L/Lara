<x-drugdept.layout title="Medicine List">
    <div class="container">
        <div class="container p-24 mx-auto">
            <h1 class="mb-4 text-2xl font-bold text-center">Medicines & Surgical Items</h1>
            <a href="{{ route('medicines.create') }}"
                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Create New Medicine</a>
            <br />
            <br />

            <!-- Add search form -->
            <form action="{{ route('medicines.index') }}" method="GET" class="mb-4">
                <div class="flex items-center">
                    <input type="text" name="search" placeholder="Search by medicine or generic name"
                           class="w-full px-4 py-2 border rounded-l"
                           value="{{ request('search') }}">
                    <button type="submit"
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded-r hover:bg-blue-700">
                        Search
                    </button>
                </div>
            </form>

            <div class="border border-gray-200 rounded-lg">
                <div class="overflow-x-auto rounded-t-lg">
                    <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                        <thead class="text-left">
                            <tr>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Sr No.</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Medicine Name</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Generic Name</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Quantity</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Status</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Image</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Action</th>
                            </tr>
                        </thead>

                        <tbody class="border-t divide-y divide-gray-200">
                            @foreach($medicines as $medicine)
                                <tr class="border">
                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $medicine->name }}</td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $medicine->generic->generic_name }} </td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $medicine->quantity }}</td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $medicine->status ? 'Active' : 'Inactive' }}</td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                                    @if ($medicine->image == null)
                                        <p class="text-gray-700">No Image</p>
                                    @else
                                        <img src="{{ asset($medicine->image) }}" alt="Medicine Image" class="w-16 h-16 rounded-full">
                                    @endif
                                    </td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                                        <span class="inline-flex pl-2 pr-2 ml-2 mr-2 -space-x-px overflow-hidden bg-white border rounded-md shadow-sm">
                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative"><a
                                                    href="{{ route('medicines.edit', $medicine->id) }}"
                                                    class="text-blue-500 hover:underline">Edit</a>
                                            </button>

                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative"><a
                                                    href="{{ route('medicines.show', $medicine->id) }}"
                                                    class="font-bold text-yellow-500 hover:underline">Show</a>
                                            </button>

                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
                                                <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST"
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
                <x-drugdept.pagination :paginator="$medicines" />
            </div>
        </div>
    </div>
</x-drugdept.layout>
