<x-drugdept.layout title="Wards">
    <div class="container">

        <div class="h-10 bg-blue-500 w-full mb-4">
            <div class="container p-24 mx-auto">
                                       <!-- session message -->
                                       @if(session('status'))
            <!-- message will disappear after 3 seconds after page load -->
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert" id="alert-message">
                <p>{{ session('status') }}</p>
            </div>
            @endif
                <h1 class="text-2xl font-bold text-center mb-4">Wards</h1>
                <a href="{{ route('wards.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Ward</a>
                <br />
                <br />
                <br />
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Sr No.</th>
                            <th class="py-3 px-6 text-left">Ward Name</th>
                            <th class="py-3 px-6 text-left">Ward Description</th>
                            <th class="py-3 px-6 text-left">Capacity</th>
                            <th class="py-3 px-6 text-left">Status</th>
                            <th class="py-3 px-6 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($wards as $ward)
                        <tr class="border-b">
                            <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>
                            <td class="py-3 px-6 text-left">{{ $ward->ward_name }}</td>
                            <td class="py-3 px-6 text-left">{{ $ward->ward_description }}</td>
                            <td class="py-3 px-6 text-left">{{ $ward->ward_capacity }}</td>
                            <td class="py-3 px-6 text-left">{{ $ward->ward_status ? 'Active' : 'Inactive' }}</td>
                            <td class="py-3 px-6 text-center">
                                <a href="{{ route('wards.edit', $ward->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                                <a href="{{ route('wards.show', $ward->id) }}" class="text-yellow-500 hover:underline font-bold">Show</a> |
                                <form action="{{ route('wards.destroy', $ward->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-drugdept.layout>
