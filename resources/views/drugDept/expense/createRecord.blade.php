<x-drugdept.layout title="Create Record">
    <div class="container p-4 mx-auto">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-700">Create New Record</h1>
        <hr class="mb-6">

        <a href="{{ route('expense.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6 inline-block">Back</a>

        <div class="bg-white shadow-md rounded-lg mx-auto p-4" style="min-width: 600px;">
            <form class="space-y-6" action="{{ route('expenseRecord.store') }}" method="POST">
                @csrf
                <input type="hidden" name="expense_id" value="{{ $expense_id }}">

                <div id="medicineFields" class="space-y-4"></div>

                <button type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" onclick="addMedicineField()">+ Add Medicine</button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Save</button>
            </form>
        </div>
    </div>

    <script>
        let medicineIndex = 0;

        function addMedicineField() {
            const medicines = @json($medicines);
            const generics = @json($generics);

            let newField = `
                <div class="flex items-center p-4 border border-gray-200 rounded-lg bg-gray-50 space-x-4 mb-4" id="medicineField_${medicineIndex}">
                    <input type="hidden" id="medicine_id_${medicineIndex}" name="medicine_id[]">

                    <div class="flex-none w-[170px] relative">
                        <label for="medicine_search_${medicineIndex}" class="block text-sm font-medium text-gray-700">Search Medicine:</label>
                        <input type="text" id="medicine_search_${medicineIndex}" name="medicine_search[]" class="w-full border rounded-md px-2 py-1 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="searchMedicine(${medicineIndex})" placeholder="Type to search...">
                        <div id="medicineResults_${medicineIndex}" class="absolute z-10 bg-white border border-gray-300 rounded-md mt-1 w-full max-h-48 overflow-auto shadow-lg hidden"></div>
                    </div>

                    <div class="flex-none w-[100px]">
                        <label for="medicine_name_${medicineIndex}" class="block text-sm font-medium text-gray-700">Medicine Name:</label>
                        <input type="text" id="medicine_name_${medicineIndex}" name="medicine_name[]" class="w-full border rounded-md px-2 py-1 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                    </div>

                    <div class="flex-none w-[100px]">
                        <label for="generic_name_${medicineIndex}" class="block text-sm font-medium text-gray-700">Generic Name:</label>
                        <input type="text" id="generic_name_${medicineIndex}" name="generic_name[]" class="w-full border rounded-md px-2 py-1 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                    </div>

                    <div class="flex-none w-[70px]" id="quantityContainer_${medicineIndex}">
                        <label for="quantity_${medicineIndex}" class="block text-sm font-medium text-gray-700">Quantity:</label>
                        <input type="number" id="quantity_${medicineIndex}" name="quantity[]" class="w-full border rounded-md px-2 py-1 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" min="1">
                    </div>

                    <div class="flex-none w-[50px]">
                        <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="removeMedicineField(${medicineIndex})">-</button>
                    </div>
                </div>
            `;
            document.getElementById('medicineFields').insertAdjacentHTML('beforeend', newField);
            medicineIndex++;
        }

        function removeMedicineField(index) {
            document.getElementById(`medicineField_${index}`).remove();
        }

        function searchMedicine(index) {
            const searchQuery = document.getElementById(`medicine_search_${index}`).value.toLowerCase();
            const medicines = @json($medicines);
            const generics = @json($generics);
            const resultContainer = document.getElementById(`medicineResults_${index}`);

            if (searchQuery === '') {
                resultContainer.innerHTML = '';
                resultContainer.classList.add('hidden');
                return;
            }

            const filteredMedicines = medicines.filter(med =>
                med.name.toLowerCase().includes(searchQuery) ||
                generics.some(gen => gen.id == med.generic_id && gen.generic_name.toLowerCase().includes(searchQuery))
            );

            let resultsHTML = '';

            if (filteredMedicines.length > 0) {
                filteredMedicines.forEach(medicine => {
                    const generic = generics.find(gen => gen.id == medicine.generic_id);
                    const isSurgicalItems = generic && generic.generic_name === 'Surgical Items';
                    const displayText = isSurgicalItems
                        ? `${medicine.name}`
                        : `${medicine.name} (${generic ? generic.generic_name : ''}) - ${medicine.strength} - ${medicine.route}`;
                    resultsHTML += `<div class="p-2 hover:bg-gray-100 cursor-pointer" onclick="selectMedicine(${index}, '${medicine.id}', '${medicine.name}', '${generic ? generic.generic_name : ''}', '${medicine.strength}', '${medicine.route}')">${displayText}</div>`;
                });
            } else {
                resultsHTML = '<div class="p-2 text-gray-500">No results found</div>';
            }

            resultContainer.innerHTML = resultsHTML;
            resultContainer.classList.remove('hidden');
        }

        function selectMedicine(index, id, name, genericName, strength, route) {
            document.getElementById(`medicine_search_${index}`).value = `${name}`;
            document.getElementById(`medicine_name_${index}`).value = name;
            document.getElementById(`generic_name_${index}`).value = genericName;
            document.getElementById(`medicine_id_${index}`).value = id;

            // Conditionally hide elements based on generic ID
            if (genericName === 'Surgical Items' || genericName === 'Surgical Items') {
                document.getElementById(`quantityContainer_${index}`).classList.add('hidden');
                document.getElementById(`medicine_search_${index}`).value = `${name}`;
            } else {
                document.getElementById(`quantityContainer_${index}`).classList.remove('hidden');
            }

            // Conditionally hide strength and route based on generic ID
            if (genericName === 'Surgical Items' || genericName === 'Surgical Items') {
                document.getElementById(`medicine_search_${index}`).value = `${name}`;
            } else {
                document.getElementById(`medicine_search_${index}`).value = `${name} (${genericName}) - ${strength} - ${route}`;
            }

            document.getElementById(`medicineResults_${index}`).classList.add('hidden');
        }

        // Load all medicines when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the first medicine field
            addMedicineField();
        });
    </script>
</x-drugdept.layout>
