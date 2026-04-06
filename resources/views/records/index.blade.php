<x-app-layout>
    <div class="flex justify-center mt-10">
        <div class="w-full max-w-5xl bg-white dark:bg-gray-800 shadow rounded p-6">
            <h2 class="text-xl font-bold mb-6 text-center">Transactions</h2>

            @if(session('success'))
                <div class="mb-4 text-green-600 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-left">
                        <th class="p-3">Title</th>
                        <th class="p-3">Amount</th>
                        <th class="p-3">Type</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $record)
                        <tr class="border-b">
                            <td class="p-3">{{ $record->title }}</td>
                            <td class="p-3">₱{{ number_format($record->amount, 2) }}</td>
                            <td class="p-3 capitalize">{{ $record->type }}</td>
                            <td class="p-3">{{ $record->created_at->format('Y-m-d') }}</td>
                            <td class="p-3">
                                <a href="{{ route('records.edit', $record) }}" class="text-blue-600 hover:underline">Edit</a>

                                <!-- Delete Button triggers modal -->
                                <button type="button"
                                        class="text-red-600 hover:underline ml-2"
                                        onclick="openDeleteModal({{ $record->id }})">
                                    Delete
                                </button>

                                <!-- Hidden delete form -->
                                <form id="delete-form-{{ $record->id }}"
                                      action="{{ route('records.destroy', $record) }}"
                                      method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-3 text-center text-gray-500">No transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded shadow-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">
                Confirm Deletion
            </h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">
                Are you sure you want to delete this record? This action cannot be undone.
            </p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeDeleteModal()"
                        class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-700">
                    Cancel
                </button>
                <button id="confirmDeleteBtn"
                        class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        let deleteRecordId = null;

        function openDeleteModal(recordId) {
            deleteRecordId = recordId;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }

        function closeDeleteModal() {
            deleteRecordId = null;
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (deleteRecordId) {
                document.getElementById('delete-form-' + deleteRecordId).submit();
                closeDeleteModal();
            }
        });
    </script>
</x-app-layout>
