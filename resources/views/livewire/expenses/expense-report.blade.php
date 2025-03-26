<div class="max-w-2xl mr-auto p-4 bg-white shadow-md rounded-lg">
    <h2 class="text-lg font-semibold">Generate Expense Report</h2>

    <div class="mt-4">
        <label for="status" class="block text-sm font-medium text-gray-700">Filter by Status</label>
        <select id="status" wire:model="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 bg-gray-100">
            <option value="">All</option>
            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>

    <div class="mt-4">
        <button wire:click="export" class="px-4 py-2 bg-indigo-600 rounded-md text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Download Report</button>
    </div>
</div>