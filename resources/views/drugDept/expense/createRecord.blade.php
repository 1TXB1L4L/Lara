<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Create New Record</title>
</head>

<body class="h-full">
    <div class="container p-24 mx-auto">
        <h1 class="text-2xl font-bold text-center mb-4">Create New Record</h1>
        <hr>
        <br />
        <a href="{{ route('expense.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</a>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ route('expenseRecord.store') }}" method="POST">
            @csrf
            <!-- Hidden input to store the expense ID -->
            <input type="hidden" name="expense_id" value="{{ $expense_id }}">

            <div id="medicineFields">
                <!-- Dynamic fields will be appended here -->
            </div>

            <button type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" onclick="addMedicineField()">Add Medicine</button>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
        </form>
    </div>

    <script>
        let medicineIndex = 0;

        function addMedicineField() {
            const medicines = @json($medicines);  // Pass the medicines data from Laravel
            const generics = @json($generic);  // Pass the generics data from Laravel

            let medicineOptions = medicines.map(medicine => `<option value="${medicine.id}">${medicine.name}</option>`).join('');
            let genericOptions = generics.map(generic => `<option value="${generic.id}">${generic.name}</option>`).join('');

            let newField = `
                <div class="mb-4 p-4 border rounded" id="medicineField_${medicineIndex}">
                    <label for="medicine_id_${medicineIndex}">Medicine:</label>
                    <select id="medicine_id_${medicineIndex}" name="medicine_id[]" class="form-control" onchange="updateMedicineDetails(${medicineIndex})">
                        <option value="">Select a Medicine</option>
                        ${medicineOptions}
                    </select>

                    <label for="medicine_name_${medicineIndex}" class="mt-2">Medicine Name:</label>
                    <input type="text" id="medicine_name_${medicineIndex}" name="medicine_name[]" class="form-control" readonly>

                    <label for="generic_name_${medicineIndex}" class="mt-2">Generic Name:</label>
                    <input type="text" id="generic_name_${medicineIndex}" name="generic_name[]" class="form-control" readonly>

                    <label for="quantity_${medicineIndex}" class="mt-2">Quantity:</label>
                    <input type="number" id="quantity_${medicineIndex}" name="quantity[]" class="form-control" min="1">

                    <button type="button" class="mt-2 text-red-500" onclick="removeMedicineField(${medicineIndex})">Remove</button>
                </div>
            `;
            document.getElementById('medicineFields').insertAdjacentHTML('beforeend', newField);
            medicineIndex++;
        }

        function removeMedicineField(index) {
            document.getElementById(`medicineField_${index}`).remove();
        }

        function updateMedicineDetails(index) {
            const selectedMedicine = document.getElementById(`medicine_id_${index}`).value;
            const medicines = @json($medicines);

            const medicine = medicines.find(med => med.id == selectedMedicine);
            if (medicine) {
                document.getElementById(`medicine_name_${index}`).value = medicine.name;
                // Assuming each medicine has a generic name
                document.getElementById(`generic_name_${index}`).value = medicine.generic_name || '';
            }
        }

        // Automatically add one medicine field on page load
        document.addEventListener('DOMContentLoaded', addMedicineField);
    </script>
</body>

</html>
