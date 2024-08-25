<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Medicine Info - {{ $medicine->med_name }}</title>
</head>

<body>
    <div class="container">
        <div class="h-10 bg-blue-500 w-full mb-4">
            <div class="container p-24 mx-auto">
                <h1 class="text-2xl font-bold text-center mb-4">{{ $medicine->med_name }} Info</h1>
                <br />
                <a href = "{{ route('medicines.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" > Back </a>
                <br />
                <br />


                <table class="table-auto border-collapse border border-blue-500 container mx-auto">
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Medicine Name</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->med_name }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Description</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->med_description }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Generic Name</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->med_generic_name }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Quantity</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->med_quantity }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Dosage</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->med_dosage }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Price</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->med_price }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Strength</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->med_strength }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Expiry Date</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->med_expiry_date }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Therapeutic Class</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->med_therapeutic_class }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Notes</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->med_notes }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Manufacturer</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->med_manufacturer }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Category</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->category->med_category_name }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Route</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->route->med_route }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Status</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100">{{ $medicine->med_status }}</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-left font-bold border border-gray-300 bg-gray-100">Image</td>
                        <td class="py-3 px-6 text-left border border-gray-300 bg-gray-100"><img src="{{ asset('storage/'.$medicine->med_image) }}" alt="Image" width="100" height="100"></td>
                    </tr>
                </table>
            </div>
        </div>
</body>

</html>
