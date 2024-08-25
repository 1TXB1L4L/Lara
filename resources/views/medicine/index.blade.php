<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Medicines</title>
</head>

<body>
    <div class="container">
        <div class="h-10 bg-blue-500 w-full mb-4">
            <div class="container p-24 mx-auto">

            <!-- session message -->
            @if(session('status'))
            <!-- message will disappear after 3 seconds after page load -->
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('status') }}</p>
            </div>
            @endif
                <h1 class="text-2xl font-bold text-center mb-4">Wards</h1>
                <a href="{{ route('medicines.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Medicine</a>
                <br />
                <br />
                <br />
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Sr No.</th>
                            <th class="py-3 px-6 text-left">Medicine Name</th>
                            <th class="py-3 px-6 text-left">Medicine Status</th>
                            <th class="py-3 px-6 text-center">Generic Name</th>
                            <th class="py-3 px-6 text-center">Quantity</th>
                            <th class="py-3 px-6 text-center">Image</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($medicines as $medicine)
                        <tr class="border-b">
                            <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>
                            <td class="py-3 px-6 text-left">{{ $medicine->med_name }}</td>
                            <td class="py-3 px-6 text-left">{{ $medicine->med_status }}</td>
                            <td class="py-3 px-6 text-center">{{ $medicine->med_generic_name }}</td>
                            <td class="py-3 px-6 text-center">{{ $medicine->med_quantity }}</td>
                            <!-- rounded image -->
                            <td class="py-3 px-6 text-center"><img src="{{ asset('$medicine->med_image') }}" alt="Image" width="100" height="100" class="rounded-full"></td>
                            <td class="py-3 px-6 text-center">
                                <a href="{{ route('medicines.edit', $medicine->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                                <a href="{{ route('medicines.show', $medicine->id) }}" class="text-yellow-500 hover:underline font-bold">Show</a> |
                                <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" class="inline">
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
</body>

</html>
