<div>
    @if ($show)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-lg font-semibold mb-4">Confirm {{ ucfirst($action) }}</h2>
                <p>Are you sure you want to {{ $action }} this expense?</p>
                <div class="mt-4 flex justify-end">
                    <button wire:click="hideModal" class="px-4 py-2 bg-zinc-500 text-white rounded-md mr-2">Cancel</button>
                    <button wire:click="confirmAction" class="px-4 py-2 bg-blue-500 text-white rounded-md">Confirm</button>
                </div>
            </div>
        </div>
    @endif
</div>