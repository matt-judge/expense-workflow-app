<div class="max-w-7xl mr-auto py-4">
    <div class="mt-4 mb-2">
        @if (session()->has('message'))
            <div class="p-4 bg-green-100 text-green-700 rounded-md">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <h2 class="text-lg font-semibold">{{ $title }}</h2>

    <div class="mt-4 mb-2">
        <p class="text-sm text-gray-600">{{ $body }}</p>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('description')">
                        Description
                        @if ($sortField === 'description')
                            @if ($sortDirection === 'asc')
                                &uarr;
                            @else
                                &darr;
                            @endif
                        @endif
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('category_id')">
                        Category
                        @if ($sortField === 'category_id')
                            @if ($sortDirection === 'asc')
                                &uarr;
                            @else
                                &darr;
                            @endif
                        @endif
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('amount')">
                        Amount
                        @if ($sortField === 'amount')
                            @if ($sortDirection === 'asc')
                                &uarr;
                            @else
                                &darr;
                            @endif
                        @endif
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('status')">
                        Status
                        @if ($sortField === 'status')
                            @if ($sortDirection === 'asc')
                                &uarr;
                            @else
                                &darr;
                            @endif
                        @endif
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('submitted_at')">
                        Submitted On
                        @if ($sortField === 'submitted_at')
                            @if ($sortDirection === 'asc')
                                &uarr;
                            @else
                                &darr;
                            @endif
                        @endif
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Receipt Image
                    </th>
                    @if (Auth::user()->isAdmin())
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($expenses as $expense)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $expense->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $expense->category?->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">£{{ number_format($expense->amount) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <flux:badge class="expense-count-badge text-xs" color="{{ $this->getStatusColour($expense) }}" variant="pill">
                                {{ ucfirst($expense->status) }}
                            </flux:badge>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $expense->submitted_at->format('d F Y H:i:s') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if ($expense->receipt_image)
                                <img src="{{ asset('storage/' . $expense->receipt_image) }}" alt="Receipt Image" class="w-16 h-16 object-cover cursor-pointer" @click="showImage = true">
                                <div x-data="{ showImage: false }">
                                    <div x-show="showImage" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75">
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $expense->receipt_image) }}" alt="Receipt Image" class="max-w-full max-h-full">
                                            <button @click="showImage = false" class="absolute top-0 right-0 mt-2 mr-2 text-white">Close</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                        @if (Auth::user()->isAdmin())
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <button @click="if (confirm('Are you sure you want to approve this expense?')) { $wire.approve({{ $expense->id }}) }" class="px-4 py-2 bg-green-500 text-white rounded-md">Approve</button>
                                <button @click="if (confirm('Are you sure you want to reject this expense?')) { $wire.reject({{ $expense->id }}) }" class="px-4 py-2 bg-red-500 text-white rounded-md">Reject</button>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $expenses->links() }}
    </div>
</div>