<x-app-layout>
    <div class="flex">
        <!-- Main Content -->
        <div class="flex-1 p-8 mx-auto max-w-5xl">
            <h2 class="text-2xl font-bold mb-6 text-center">
                Welcome, {{ Auth::user()->name }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Income -->
                <div class="bg-green-100 p-6 rounded shadow text-center">
                    <h3 class="text-lg font-semibold text-green-700">Total Income</h3>
                    <p class="text-2xl font-bold text-green-800">₱{{ number_format($income, 2) }}</p>
                </div>

                <!-- Expense -->
                <div class="bg-red-100 p-6 rounded shadow text-center">
                    <h3 class="text-lg font-semibold text-red-700">Total Expense</h3>
                    <p class="text-2xl font-bold text-red-800">₱{{ number_format($expense, 2) }}</p>
                </div>

                <!-- Balance -->
                <div class="bg-blue-100 p-6 rounded shadow text-center">
                    <h3 class="text-lg font-semibold text-blue-700">Balance</h3>
                    <p class="text-2xl font-bold text-blue-800">₱{{ number_format($income - $expense, 2) }}</p>
                </div>
            </div>

            <div class="mt-6 text-sm text-gray-500 text-center">
                Last login: {{ Auth::user()->last_login_at ?? now() }}
            </div>
        </div>
    </div>
</x-app-layout>
