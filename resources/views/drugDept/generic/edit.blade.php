<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Ward</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <div class="h-10 bg-blue-500 w-full mb-4"></div>
        <div class="container p-24 mx-auto">
            <form action="{{ route('wards.update', $ward->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="ward_name" class="block text-gray-700 text-sm font-bold mb-2">Ward Name</label>
                    <input type="text" name="ward_name" id="ward_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $ward->ward_name }}"
                </div>
                <div class="mb-4">
                    <label for="ward_description" class="block text-gray-700 text-sm font-bold mb-2">Ward Discription</label>
                    <input type="text" name="ward_description" id="ward_discription" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $ward->ward_description }}">
                </div>
                <div class="mb-4">
                    <label for="ward_capacity" class="block text-gray-700 text-sm font-bold mb-2">Ward Capacity</label>
                    <input type="number" name="ward_capacity" id="ward_capacity" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $ward->ward_capacity }}">
                </div>
                <div class="mb-4">
                    <label for="ward_status" class="block text-gray-700 text-sm font-bold mb-2">Ward Status</label>
                    <input type="checkbox" name="ward_status" class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" {{ $ward->ward_status == 1 ? 'checked' : '' }}>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Ward</button>
                </div>
            </form>
        </div>
    </body>
</html>
