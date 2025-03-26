<?php

namespace App\Livewire\Expenses;

use Livewire\Component;
use App\Mail\Expense\ExpenseSubmitted;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\WithFileUploads;
use Symfony\Component\HttpFoundation\Response;

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

    protected $messages = [
        'category_id.required' => 'The category field is required.',
    ];

    public function submit()
    {
        if (!Auth::check()) {
            abort(Response::HTTP_FORBIDDEN, 'You must be logged in to submit an expense.');
        }

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
        $expense->refresh();

        // Send email notification to admins
        $recipients = env('EMAIL_RECIPIENT');
        if (isset($recipients) && $recipients !== '') {
            Mail::to($recipients)->send(new ExpenseSubmitted($expense));
        }

        session()->flash('message', 'Expense submitted successfully.');

        return redirect()->route('expenses.index');
    }

    public function render()
    {
        return view('livewire.expenses.expense-form', [
            'categories' => ExpenseCategory::orderBy('name', 'asc')->get(),
        ]);
    }
}