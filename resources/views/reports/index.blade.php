<x-app-layout>
    <div class="flex justify-center mt-10">
        <div class="w-full max-w-5xl bg-white dark:bg-gray-800 shadow rounded p-6">
            <h2 class="text-xl font-bold mb-6 text-center">Reports</h2>

            @if(session('success'))
                <div class="mb-4 text-green-600 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-left">
                        <th class="p-3">Report Title</th>
                        <th class="p-3">Description</th>
                        <th class="p-3">Generated On</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                        <tr class="border-b">
                            <td class="p-3">{{ $report->title }}</td>
                            <td class="p-3">{{ $report->description }}</td>
                            <td class="p-3">{{ $report->created_at->format('Y-m-d') }}</td>
                            <td class="p-3">
                                <a href="{{ route('reports.show', $report) }}" class="text-blue-600 hover:underline">View</a>
                                <a href="{{ route('reports.edit', $report) }}" class="text-indigo-600 hover:underline ml-2">Edit</a>
                                <form action="{{ route('reports.destroy', $report) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this report?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-3 text-center text-gray-500">No reports available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
