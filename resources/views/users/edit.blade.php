<x-app-layout>
    <div class="flex justify-center mt-10">
        <div class="w-full max-w-lg bg-white dark:bg-gray-800 shadow rounded p-6">
            <h2 class="text-xl font-bold mb-6 text-center">Edit User</h2>

            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full border rounded p-2" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full border rounded p-2" required>
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Role</label>
                    <select name="role" class="w-full border rounded p-2" required>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Password (leave blank to keep current)</label>
                    <input type="password" name="password" class="w-full border rounded p-2">
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded p-2">
                </div>

                <!-- Save Button -->
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded w-full">
                    Update User
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
