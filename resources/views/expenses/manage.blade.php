<x-layouts.app :title="__('Manage Expense')">
    <div class="max-w-6xl mr-auto p-4">
        @livewire('expenses.manage', ['expense' => $expense])
    </div>
</x-layouts.app>