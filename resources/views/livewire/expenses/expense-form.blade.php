<div class="">
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
            <textarea id="description" placeholder="Write a short description of your expense" wire:model="description" class="mt-1 block w-full rounded-md border border-gray-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <select id="category_id" wire:model="category_id" class="mt-1 block w-full rounded-md border border-gray-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
            <div class="relative mt-1 rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">£</span>
                </div>
                <input type="number" step="0.01" min="0" id="amount" wire:model="amount" class="block w-full pl-7 pr-12 rounded-md border border-gray-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2" placeholder="0.00">
            </div>
            @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="receipt_image" class="block text-sm font-medium text-gray-700">Receipt Image</label>
            <div class="flex items-center">
                <label class="bg-zinc-500 hover:bg-zinc-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                    Choose file
                    <input type="file" id="receipt_image" wire:model="receipt_image" class="hidden">
                </label>
                <div wire:loading wire:target="receipt_image" class="ml-2">Uploading...</div>
            </div>
            @error('receipt_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if ($receipt_image)
                <div class="mt-2">
                    <img src="{{ $receipt_image->temporaryUrl() }}" alt="Receipt Image Preview" class="max-w-xs">
                </div>
            @endif
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
        </div>
    </form>
</div>