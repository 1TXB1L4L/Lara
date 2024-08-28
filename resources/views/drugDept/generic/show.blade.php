<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Ward Info</title>
</head>

<body>
    <div class="container">
        <div class="h-10 bg-blue-500 w-full mb-4">
            <div class="container p-24 mx-auto">
                <h1 class="text-2xl font-bold text-center mb-4">Wards Info</h1>
                <br />
                <a href = "{{ route('wards.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" > Back </a>
                <br />
                <br />


                <table class="table-auto border-collapse border border-blue-500 container mx-auto">
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Ward Name</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $ward->ward_name }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Ward Description</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $ward->ward_description }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Capacity</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $ward->ward_capacity }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Status</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $ward->ward_status ? 'Active' : 'Inactive' }}</td>
                    </tr>

                </table>
            </div>
        </div>
</body>

</html>
