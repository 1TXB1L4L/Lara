<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>Create New Record</title>
    <style>
        .select2-container--default .select2-selection--single {
            height: auto;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 1.5;
        }
        .medicine-select {
            width: 100%;
        }
        .input-group {
            display: flex;
            align-items: center;
            gap: 1rem; /* Adjust gap as needed */
        }
        .input-group input,
        .input-group select {
            height: 2.5rem; /* Adjust height as needed */
        }
    </style>
</head>

<body class="h-full bg-gray-50">
    <div class="container p-6 mx-auto">
        <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Create New Record</h1>
        <hr class="mb-6">
        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
        @endif
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
        @endif
        <a href="{{ route('expense.index') }}" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded mb-6 inline-block">Back</a>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <form id="expenseForm" class="space-y-6" action="{{ route('expenseRecord.store') }}" method="POST">
                @csrf
                <input type="hidden" name="expense_id" value="{{ $expense_id }}">

                <div id="medicineFields" class="space-y-4"></div>

                <div class="text-center">
                    <button type="button" class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded" onclick="addMedicineField()">Add Medicine</button>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        let medicineIndex = 0;
        let selectedMedicines = new Map();

        function addMedicineField() {
            let newField = `
                <div class="input-group bg-gray-100 p-4 border border-gray-300 rounded-lg" id="medicineField_${medicineIndex}">
                    <input type="hidden" id="medicine_id_${medicineIndex}" name="medicine_id[]">

                    <div class="flex-1">
                        <label for="medicine_search_${medicineIndex}" class="block text-sm font-medium text-gray-700">Search Medicine:</label>
                        <select id="medicine_search_${medicineIndex}" name="medicine_search[]" class="medicine-select border rounded-md px-4 py-2 mt-1"></select>
                    </div>

                    <div class="flex-1">
                        <label for="medicine_name_${medicineIndex}" class="block text-sm font-medium text-gray-700">Medicine Name:</label>
                        <input type="text" id="medicine_name_${medicineIndex}" name="medicine_name[]" class="border rounded-md px-4 py-2 mt-1" readonly>
                    </div>

                    <div class="flex-1">
                        <label for="generic_name_${medicineIndex}" class="block text-sm font-medium text-gray-700">Generic Name:</label>
                        <input type="text" id="generic_name_${medicineIndex}" name="generic_name[]" class="border rounded-md px-4 py-2 mt-1" readonly>
                    </div>

                    <div class="flex-1">
                        <label for="quantity_${medicineIndex}" class="block text-sm font-medium text-gray-700">Quantity:</label>
                        <input type="number" id="quantity_${medicineIndex}" name="quantity[]" class="border rounded-md px-4 py-2 mt-1" min="1">
                    </div>

                    <div class="ml-4">
                        <button type="button" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded" onclick="removeMedicineField(${medicineIndex})">Remove</button>
                    </div>

                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700">Available Quantity:</label>
                        <p id="available_quantity_${medicineIndex}" class="text-sm text-gray-600">--</p>
                    </div>
                </div>
            `;

            document.getElementById('medicineFields').insertAdjacentHTML('beforeend', newField);
            initializeSelect2(medicineIndex);
            medicineIndex++;
        }

        function removeMedicineField(index) {
            const medicineId = document.getElementById(`medicine_id_${index}`).value;
            if (medicineId) {
                selectedMedicines.delete(index);
            }
            document.getElementById(`medicineField_${index}`).remove();
            updateTotalItems();
        }

        function initializeSelect2(index) {
            const medicines = @json($medicines);
            const generics = @json($generics);
            const selectElement = $(`#medicine_search_${index}`);

            const options = medicines.map(med => {
                const generic = generics.find(gen => gen.id == med.generic_id);
                const displayText = `${med.name} (${generic ? generic.generic_name : ''}) - ${med.category} - ${med.strength} - ${med.route}`;
                return {
                    id: med.id,
                    text: displayText,
                    availableQuantity: med.quantity
                };
            });

            selectElement.select2({
                data: options,
                placeholder: 'Search for a medicine',
                allowClear: true,
                width: 'resolve'
            }).on('select2:open', function() {
                setTimeout(function() {
                    $('.select2-search__field').focus();
                }, 0);
            }).on('select2:select', function(e) {
                const selectedData = e.params.data;
                const selectedId = selectedData.id;

                let isDuplicate = false;
                selectedMedicines.forEach((value, key) => {
                    if (value === selectedId && key !== index) {
                        isDuplicate = true;
                    }
                });

                if (isDuplicate) {
                    alert('This medicine has already been added.');
                    selectElement.val(null).trigger('change');
                    return;
                }

                selectedMedicines.set(index, selectedId);
                document.getElementById(`medicine_id_${index}`).value = selectedId;
                document.getElementById(`medicine_name_${index}`).value = selectedData.text.split(' (')[0];
                const genericName = selectedData.text.match(/\(([^)]+)\)/);
                document.getElementById(`generic_name_${index}`).value = genericName ? genericName[1] : '';
                
                document.getElementById(`available_quantity_${index}`).innerText = selectedData.availableQuantity;

                updateTotalItems();
            }).on('select2:unselect', function(e) {
                selectedMedicines.delete(index);

                document.getElementById(`medicine_id_${index}`).value = '';
                document.getElementById(`medicine_name_${index}`).value = '';
                document.getElementById(`generic_name_${index}`).value = '';
                document.getElementById(`available_quantity_${index}`).innerText = '--';

                updateTotalItems();
            });

            selectElement.val(null).trigger('change');
        }

        function updateTotalItems() {
            const medicineFields = document.querySelectorAll('#medicineFields .input-group');
            medicineFields.forEach((field, index) => {
                const selectElement = field.querySelector('select');
                if (selectElement) {
                    const currentValue = $(selectElement).val();
                    $(selectElement).select2('destroy').select2({
                        data: getMedicineOptions(),
                        placeholder: 'Search for a medicine',
                        allowClear: true,
                        width: 'resolve'
                    });
                    $(selectElement).val(currentValue).trigger('change');
                }
            });
        }

        function getMedicineOptions() {
            const medicines = @json($medicines);
            const generics = @json($generics);
            return medicines.map(med => {
                const generic = generics.find(gen => gen.id == med.generic_id);
                const displayText = `${med.name} (${generic ? generic.generic_name : ''}) - ${med.category} - ${med.strength} - ${med.route}`;
                return {
                    id: med.id,
                    text: displayText,
                    availableQuantity: med.quantity
                };
            });
        }

        document.addEventListener('DOMContentLoaded', addMedicineField);

        document.addEventListener('keydown', function(event) {
            if (event.ctrlKey && event.key === 'Enter') {
                event.preventDefault();
                document.getElementById('expenseForm').submit();
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.shiftKey && event.key === 'N') {
                addMedicineField();
            }
        });
    </script>
</body>
</html>