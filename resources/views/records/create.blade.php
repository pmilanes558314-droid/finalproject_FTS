<x-app-layout>
    <div class="flex justify-center mt-10">
        <div class="w-full max-w-lg bg-white dark:bg-gray-800 shadow rounded p-6">
            <h2 class="text-xl font-bold mb-6 text-center">Add Transaction</h2>

            <form method="POST" action="{{ route('records.store') }}">
                @csrf

                <!-- Category -->
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Category</label>
                    <select name="type" class="w-full border rounded p-2" required>
                        <option value="income">Income</option>
                        <option value="expense">Expense</option>
                    </select>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Description</label>
                    <input type="text" name="title" class="w-full border rounded p-2" required>
                </div>

                <!-- Amount -->
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Amount</label>
                    <input type="number" step="0.01" name="amount" class="w-full border rounded p-2" required>
                </div>

                <!-- Date -->
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Date</label>
                    <input type="date" name="date" class="w-full border rounded p-2" required>
                </div>

                <!-- Save Button -->
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded w-full">
                    Save Transaction
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
