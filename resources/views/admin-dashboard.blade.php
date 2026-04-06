<x-app-layout>
    <div class="flex">
        <div class="flex-1 p-8 mx-auto max-w-6xl">
            <h2 class="text-2xl font-bold mb-6 text-center">
                Admin Dashboard
            </h2>

            <p class="text-center text-gray-600 dark:text-gray-300 mb-8">
                Welcome, {{ Auth::user()->name }}. You have administrator access.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Users Management -->
                <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded shadow text-center">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Manage Users</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">View and manage registered users.</p>
                    <a href="{{ route('users.index') }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Go to Users
                    </a>
                </div>

                <!-- Transactions Overview -->
                <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded shadow text-center">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Transactions</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Monitor all financial records.</p>
                    <a href="{{ route('admin.records') }}" 
                       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        View Records
                    </a>
                </div>

                <!-- Reports -->
                <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded shadow text-center">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Reports</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Generate system reports.</p>
                    <a href="{{ route('reports.index') }}" 
                       class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        View Reports
                    </a>
                </div>
            </div>

            <div class="mt-6 text-sm text-gray-500 text-center">
                Last login: {{ Auth::user()->last_login_at ?? now() }}
            </div>
        </div>
    </div>
</x-app-layout>
