<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Generic List</title>
</head>

<body>
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
                <h1 class="text-2xl font-bold text-center mb-4">Generic List</h1>
                <a href="{{ route('generics.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Generic</a>
                <br />
                <br />
                <br />
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Sr No.</th>
                            <th class="py-3 px-6 text-left">Generic Name</th>
                            <th class="py-3 px-6 text-left">Generic Description</th>
                            <th class="py-3 px-6 text-left">Catagory</th>
                            <th class="py-3 px-6 text-left">Therapeutic Class</th>
                            <th class="py-3 px-6 text-left">Status</th>
                            <th class="py-3 px-6 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($generics as $generic)
                        <tr class="border-b">
                            <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>
                            <td class="py-3 px-6 text-left">{{ $generic->generic_name }}</td>
                            <!-- limit the description to 50 characters -->
                            <!-- make sure the description is not empty -->
                            <td class="py-3 px-6 text-left">{{ $generic->generic_description ? substr($generic->generic_description, 0, 50) . '...' : '' }}</td>
                            <td class="py-3 px-6 text-left">{{ $generic->generic_category }}</td>
                            <td class="py-3 px-6 text-left">{{ $generic->therapeutic_class }}</td>
                            <td class="py-3 px-6 text-left">{{ $generic->generic_status ? 'Active' : 'Inactive' }}</td>
                            <td class="py-3 px-6 text-center">
                                <a href="{{ route('generics.edit', $generic->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                                <a href="{{ route('generics.show', $generic->id) }}" class="text-yellow-500 hover:underline font-bold">Show</a> |
                                <form action="{{ route('generics.destroy', $generic->id) }}" method="POST" class="inline">
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find the alert message element
        var alertMessage = document.getElementById('alert-message');

        // Check if the alert message element exists
        if (alertMessage) {
            // Set a timeout to hide the alert message after 5 seconds (5000 milliseconds)
            setTimeout(function() {
                alertMessage.style.opacity = 0;
                alertMessage.style.transition = 'opacity 0.4s'; // Optional: fade out effect
            }, 4000);
        }
    });
</script>
</body>

</html>
