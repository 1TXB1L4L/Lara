<x-drugdept.layout title="Medicine List">
    <div class="container">

        <div class="container p-24 mx-auto">
            <h1 class="text-2xl font-bold text-center mb-4">Medicines & Sugical Items</h1>
            <a href="{{ route('medicines.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Medicine</a>
            <br />
            <br />
            <br />
            <div class="rounded-lg border border-gray-200">
                <div class="overflow-x-auto rounded-t-lg">
                    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                        <thead class="text-left">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Sr No.</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Medicine Name</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Generic Name</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Quentity</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Image</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 border-t">
                            @foreach($medicines as $medicine)
                                <tr class="border">
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $medicine->name }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $medicine->generic->generic_name }} </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $medicine->quantity }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $medicine->status ? 'Active' : 'Inactive' }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                    @if ($medicine->image == null)
                                        <p class="text-gray-700">No Image</p>
                                    @else
                                        <img src="{{ asset('$medicine->image') }}" alt="Medicine Image" class="w-16 h-16 rounded-full">
                                    @endif
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                        <span class="inline-flex -space-x-px overflow-hidden rounded-md border bg-white shadow-sm pr-2 pl-2 ml-2 mr-2">
                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative"><a
                                                    href="{{ route('medicines.edit', $medicine->id) }}"
                                                    class="text-blue-500 hover:underline">Edit</a>
                                            </button>

                                            <button
                                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative"><a
                                                    href="{{ route('medicines.show', $medicine->id) }}"
                                                    class="text-yellow-500 hover:underline font-bold">Show</a>
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