<x-drugdept.layout title="Create New Indent">
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[550px] bg-white">
            <form action="{{ route('indents.store') }}" method="POST">
                @csrf

                <!-- Medicine Selection -->
                <div class="mb-5">
                    <label for="medicine_id" class="mb-3 block text-base font-medium text-[#07074D]">
                        Select Medicine
                    </label>
                    <select name="medicine_id" id="medicine_id"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                        @foreach($medicines as $medicine)
                            <option value="{{ $medicine->id }}">
                                {{ $medicine->medicine_name }} ({{ $medicine->generic_name }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Medicine Name -->
                <div class="mb-5">
                    <label for="medicine_name" class="mb-3 block text-base font-medium text-[#07074D]">
                        Medicine Name
                    </label>
                    <input type="text" name="medicine_name" id="medicine_name" placeholder="Enter Medicine Name"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>

                <!-- Generic Name -->
                <div class="mb-5">
                    <label for="generic_name" class="mb-3 block text-base font-medium text-[#07074D]">
                        Generic Name
                    </label>
                    <input type="text" name="generic_name" id="generic_name" placeholder="Enter Generic Name"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>

                <!-- Indent Date -->
                <div class="mb-5">
                    <label for="indent_date" class="mb-3 block text-base font-medium text-[#07074D]">
                        Indent Date
                    </label>
                    <input type="date" name="indent_date" id="indent_date"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>

                <!-- Indent Quantity -->
                <div class="mb-5">
                    <label for="indent_quantity" class="mb-3 block text-base font-medium text-[#07074D]">
                        Indent Quantity
                    </label>
                    <input type="number" name="indent_quantity" id="indent_quantity" placeholder="Enter Quantity"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>

                <!-- Status -->
                <div class="mb-5">
                    <label for="indent_status" class="mb-3 block text-base font-medium text-[#07074D]">
                        Status
                    </label>
                    <select name="indent_status" id="indent_status"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>

                <!-- Indent Amount -->
                <div class="mb-5">
                    <label for="indent_amount" class="mb-3 block text-base font-medium text-[#07074D]">
                        Indent Amount
                    </label>
                    <input type="number" name="indent_amount" id="indent_amount" placeholder="Enter Indent Amount"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>

                <!-- Remarks -->
                <div class="mb-5">
                    <label for="indent_remarks" class="mb-3 block text-base font-medium text-[#07074D]">
                        Remarks
                    </label>
                    <textarea name="indent_remarks" id="indent_remarks" rows="4"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
                </div>

                <!-- Submit Button -->
                <div>
                    <button
                        class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                        Create Indent
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-drugdept.layout>
