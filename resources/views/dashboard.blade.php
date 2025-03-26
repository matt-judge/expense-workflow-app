<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @livewire('expenses.dashboard.pending-expenses-count')
            @livewire('expenses.dashboard.total-expenses-count')
            @livewire('expenses.dashboard.approved-expenses-amount')
        </div>
    </div>
</x-layouts.app>
