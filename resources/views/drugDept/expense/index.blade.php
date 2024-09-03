<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Expense</title>
</head>

<body>
    <div class="container">
        <div class="h-10 bg-blue-500 w-full mb-4">
            <div class="container p-24 mx-auto">

            <!-- session message -->
            @if(session('status'))
            <!-- message will disappear after 3 seconds after page load -->
            <div id="alert-message" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('status') }}</p>
            </div>
            @endif
                <h1 class="text-2xl font-bold text-center mb-4">Expense History</h1>
                <a href="{{ route('expense.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">New Expense</a>
                </a>
                <br />
                <br />
                <br />
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Sr No.</th>
                            <th class="py-3 px-6 text-left">Date</th>
                            <th class="py-3 px-6 text-left">Ward</th>
                            <th class="py-3 px-6 text-center">Totals Items</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($records as $record)
                        <tr class="border-b">
                            <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>
                            <td class="py-3 px-6 text-left date">{{ $record->date }}</td>
                            <td class="py-3 px-6 text-left">{{ $record->ward->ward_name }}</td>
                            <!-- generic name -->
                            <td class="py-3 px-6 text-center">{{ $record->total_items }}</td>
                            <!-- quantity -->
                            <td class="py-3 px-6 text-center">
                                <a href="{{ route('expense.edit', $record->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                                <a href="{{ route('expenseRecord.create', $record->id) }}" class="text-yellow-500 hover:underline font-bold">Create Record</a> |
                                <form action="{{ route('expense.destroy', $record->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find the alert message element
        var alertMessage = document.getElementById('alert-message');

        // Check if the alert message element exists
        if (alertMessage) {
            // Set a timeout to hide the alert message after 5 seconds (5000 milliseconds)
            setTimeout(function() {
                alertMessage.style.opacity = 0;
                alertMessage.style.transition = 'opacity 0.4s'; // Optional: fade out effect
            }, 4000);
        }
    });

    // change date format from yyyy-mm-dd to dd-month_name-yyyy
    var dates = document.querySelectorAll('.date');
    dates.forEach(function(date) {
        var dateObj = new Date(date.textContent);
        var month = dateObj.toLocaleString('default', { month: 'long' });
        date.textContent = dateObj.getDate() + '-' + month + '-' + dateObj.getFullYear();
    });


    var deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            var confirmDelete = confirm('Are you sure you want to delete this record?');
            if (confirmDelete) {
                button.parentElement.submit();
            }
        });
    });
</script>
</body>

</html>
