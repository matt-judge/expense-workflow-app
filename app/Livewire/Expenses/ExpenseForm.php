<?php

namespace App\Livewire\Expenses;

use Livewire\Component;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class ExpenseForm extends Component
{
    use WithFileUploads;

    public $description;
    public $category_id;
    public $amount;
    public $receipt_image;
    public $status = 'pending';

    protected $rules = [
        'description' => 'required|string',
        'category_id' => 'required|exists:expense_categories,id',
        'amount' => 'required|numeric|min:0',
        'receipt_image' => 'required|image|max:1024', // 1MB
    ];

    public function submit()
    {
        $this->validate();

        $expense = new Expense();
        $expense->description = $this->description;
        $expense->category_id = $this->category_id;
        $expense->amount = $this->amount;
        $expense->user_id = Auth::id();

        if ($this->receipt_image) {
            $expense->receipt_image = $this->receipt_image->store('receipts', 'public');
        }

        $expense->save();

        session()->flash('message', 'Expense submitted successfully.');

        return redirect()->route('expenses.index');
    }

    public function render()
    {
        return view('livewire.expenses.expense-form', [
            'categories' => ExpenseCategory::with('category')->orderBy('name', 'asc')->get(),
        ]);
    }
}