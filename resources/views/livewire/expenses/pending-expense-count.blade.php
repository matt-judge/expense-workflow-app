<div class="pending-expense-count">
    @if ($pendingExpenseCount > 0)
        <flux:badge class="expense-count-badge text-xs" variant="pill" color="red">{{ $pendingExpenseCount }}</flux:badge>
    @endif
</div>
