<x-drugdept.layout title="Edit Expense">
    <div class="container">
        <div class="container p-4 mx-auto pt-10">
            <h1 class="text-2xl font-bold text-center mb-4">Edit Expense Details</h1>
            <a href="{{ URL::previous() }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</a>
            <br />
            <div class="mx-auto w-full max-w-[550px] p-3 shadow-lg rounded-md">
                <form method="POST" action="{{ route('expense.update', $expense->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label for="date" class="mb-3 block text-base font-medium text-[#07074D]">
                            Date
                        </label>
                        <input type="date" name="date" id="date"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300"
                            value="{{ old('date', $expense->date) }}" autofocus />
                        @error('date')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="ward_id" class="mb-3 block text-base font-medium text-[#07074D]">
                            Ward
                        </label>
                        <select name="ward_id" id="ward_id"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300">
                            <option value="" disabled>Select Ward</option>
                            @foreach ($wards as $ward)
                                <option value="{{ $ward->id }}" {{ $ward->id == $expense->ward_id ? 'selected' : '' }}>
                                    {{ $ward->ward_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('ward_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="note" class="mb-3 block text-base font-medium text-[#07074D]">
                            Note
                        </label>
                        <textarea name="note" id="note" placeholder="Any Note"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] focus:border-[#6A64F1] focus:shadow-md placeholder:opacity-70 placeholder-gray-300">{{ old('note', $expense->note) }}</textarea>
                        @error('note')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <button
                            class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('date').valueAsDate = new Date();
    </script>
</x-drugdept.layout>
