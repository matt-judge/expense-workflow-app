<div class="max-w-2xl mx-auto p-4 bg-gray-100 shadow-md rounded-lg">
    <div class="mt-4">
        @if (session()->has('message'))
            <div class="p-4 bg-green-100 text-green-700 rounded-md">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <h2 class="text-lg font-semibold">Submit New Expense</h2>

    <div class="mt-4">
        <p class="text-sm text-gray-600">Please fill out the form below to submit a new expense request. Once submitted, this will need to be approved by an admin before you can receive your expense.</p>
    </div>    
    
    <form wire:submit.prevent="submit" class="mt-4">
        @csrf

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" wire:model="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 bg-gray-100"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <select id="category_id" wire:model="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 bg-gray-100">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
            <input type="number" step="0.01" min="0" id="amount" wire:model="amount" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 bg-gray-100">
            @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="receipt_image" class="block text-sm font-medium text-gray-700">Receipt Image</label>
            <input type="file" id="receipt_image" wire:model="receipt_image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 bg-gray-100">
            @error('receipt_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if ($receipt_image)
                <div class="mt-2">
                    <img src="{{ $receipt_image->temporaryUrl() }}" alt="Receipt Image Preview" class="max-w-xs">
                </div>
            @endif
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Submit</button>
        </div>
    </form>
</div>