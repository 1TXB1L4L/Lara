<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Create Medicine Record</title>
    </head>

<body class="h-full">
    <div class="container p-24 mx-auto">
        <h1 class="text-2xl font-bold text-center mb-4">Create Medicines</h1>
        <hr>
        <br />
        <a href="/medicines/" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</a>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ route('medicines.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="med_name" class="block text-sm font-medium leading-6 text-gray-900">Medicine Name</label>
                <div class="mt-2">
                    <input id="med_name" name="med_name" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('med_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="med_description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                <div class="mt-2">
                    <input id="med_description" name="med_description" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('med_description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="generic_id" class="block text-sm font-medium leading-6 text-gray-900">Generic Name</label>
                <div class="mt-2">
                    <select id="generic_id" name="generic_id" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Select Generic Name">
                        @foreach($generics as $generic)
                        <option value="{{ $generic->id }}">{{ $generic->generic_name }}</option>
                        @endforeach
                    </select>
                    @error('generic_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="med_quantity" class="block text-sm font-medium leading-6 text-gray-900">Quantity</label>
                <div class="mt-2">
                    <input id="med_quantity" name="med_quantity" type="number" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('med_quantity') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="med_price" class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                <div class="mt-2">
                    <input id="med_price" name="med_price" type="number" placeholder="Leave Empty, if its free" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('med_price') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="med_batch_no" class="block text-sm font-medium leading-6 text-gray-900">Batch No.</label>
                <div class="mt-2">
                    <input id="med_batch_no" name="med_batch_no" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('med_batch_no') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="med_dosage" class="block text-sm font-medium leading-6 text-gray-900">Dosage</label>
                <div class="mt-2">
                    <input id="med_dosage" name="med_dosage" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('med_dosage') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="med_strength" class="block text-sm font-medium leading-6 text-gray-900">Strength</label>
                <div class="mt-2">
                    <input id="med_strength" name="med_strength" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('med_med_strength') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="med_route" class="block text-sm font-medium leading-6 text-gray-900">Route</label>
                <div class="mt-2">
                <select id="med_route" name="med_route" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="">Select Route</option>
                <option value="Oral">Oral</option>
                <option value="Intravenous">Intravenous</option>
                <option value="Intramuscular">Intramuscular</option>
                <option value="Subcutaneous">Subcutaneous</option>
                <option value="Topical">Intrathecal</option>
                <option value="Buccal">Buccal</option>
                <option value="Intrathecal">Intrathecal</option>
                <option value="Rectal">Rectal</option>
                <option value="Vaginal">Vaginal</option>
                <option value="Ocular">Ocular</option>
                <option value="Otic">Otic</option>
                <option value="Nasal">Nasal</option>
                <option value="Inhalation">Inhalation</option>
                <option value="Nebulized">Nebulized</option>
                <option value="Transdermal">Transdermal</option>
                <option value="Opthalmic">Opthalmic</option>
                <option value="Other">Other</option>
                </select>
                    @error('med_route') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="med_therapeutic_class" class="block text-sm font-medium leading-6 text-gray-900">Therapeutic Class</label>
                <div class="mt-2">
                    <input id="med_therapeutic_class" name="med_therapeutic_class" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('med_therapeutic_class') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="med_notes" class="block text-sm font-medium leading-6 text-gray-900">Any Note</label>
                <div class="mt-2">
                    <input id="med_notes" name="med_notes" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('med_notes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="med_expiry_date" class="block text-sm font-medium leading-6 text-gray-900">Expiry Date</label>
                <div class="mt-2">
                    <input id="med_expiry_date" name="med_expiry_date" type="date" required class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('med_expiry_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="med_category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                <div class="mt-2">
                    <input id="med_category" name="med_category" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('med_category') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="med_manufacturer" class="block text-sm font-medium leading-6 text-gray-900">Manufacturer</label>
                <div class="mt-2">
                    <input id="med_manufacturer" name="med_manufacturer" type="text" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('med_manufacturer') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <label for="med_status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                </div>
                <div class="mt-2">
                    <input id="med_status" name="med_status" type="checkbox" class="block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="1" {{ old('med_status', $medicine->med_status ?? 'false') == '1' ? 'checked' : '' }}>
                    @error('med_status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <br />

                <div>
                    <label for="med_image" class="block text-sm font-medium leading-6 text-gray-900">Upload Image</label>
                    </div>
                <div class="mt-2">
                    <input type="file" name="med_image" class="block w-full rounded-md border-0 py-1.5 pl-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('med_image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    <p class="text-xs text-gray-500">Image should be less than 2MB</p>
                </div>
            </div>

            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
            </div>
        </form>
    </div>

<!-- defult value today, and if also editable via click. also some other useful function -->
    <script>
        // code here..
    </script>
</body>

</html>
