<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Create Expense</title>
</head>

<body class="h-full">
    <div class="container p-24 mx-auto">
        <h1 class="text-2xl font-bold text-center mb-4">Create Expense</h1>
        <hr>
        <br />
        <a href="/expense/" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</a>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    @if (session('error'))
        <!-- center and some margin and padding on sides-->
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-auto w-1/2 mt-10" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    @if (session('status'))
        <!-- center and some margin and padding on sides-->
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-auto w-1/2 mt-10" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif
        <form class="space-y-6" action="{{ route('expense.store') }}" method="POST">
            @csrf
            <div>
                <label for="date" class="block text-sm font-medium leading-6 text-gray-900">Date</label>
                <div class="mt-2">
                    <input id="date" name="date" type="date" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('date') border-red-500 @enderror" value="{{ old('date') }}">
                    @error('date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="ward_id" class="block text-sm font-medium leading-6 text-gray-900">Ward</label>
                <div class="mt-2">
                    <select id="ward_id" name="ward_id" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <!-- make it not selectable -->
                        <option value="" disabled selected>Select Ward</option>
                        @foreach($wards as $ward)
                        <option value="{{ $ward->id }}">{{ $ward->ward_name }}</option>
                        @endforeach
                    </select>
                    @error('ward_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="note" class="block text-sm font-medium leading-6 text-gray-900">Note</label>
                <div class="mt-2">
                    <input id="note" name="note" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('note') }}">
                    @error('note') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('date').valueAsDate = new Date();
    </script>
</body>

</html>
