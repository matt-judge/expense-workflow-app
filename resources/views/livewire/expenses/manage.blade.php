<div class="max-w-6xl mx-auto py-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Approve or Reject Expense</h2>
        <div class="mb-4">
            <strong>Description:</strong> {{ $expense->description }}
        </div>
        <div class="mb-4">
            <strong>Category:</strong> {{ $expense->category?->name }}
        </div>
        <div class="mb-4">
            <strong>Amount:</strong> £{{ number_format($expense->amount, 2) }}
        </div>
        <div class="mb-4">
            <strong>Status:</strong> {{ ucfirst($expense->status) }}
        </div>
        <div class="mb-4">
            <strong>Submitted By:</strong> {{ $expense->user?->name }}
        </div>
        <div class="mb-4">
            <strong>Submitted On:</strong> {{ $expense->created_at?->format('d F Y H:i:s') }}
        </div>
        @if ($expense->receipt_image)
            <div class="mb-4">
                <strong>Receipt Image:</strong>
                <img src="{{ asset('storage/' . $expense->receipt_image) }}" alt="Receipt Image" class="w-32 h-32 object-cover">
            </div>
        @endif
        <div class="flex justify-end">
            <button wire:click="showApprovalModal('approve')" class="px-4 py-2 bg-green-500 text-white rounded-md mr-2">Approve</button>
            <button wire:click="showRejectionModal('reject')" class="px-4 py-2 bg-red-500 text-white rounded-md">Reject</button>
        </div>
    </div>

    @livewire('expenses.confirmation-modal')
</div>