<?php

namespace App\Livewire\Expenses;

use Livewire\Component;
use Livewire\WithPagination;
use App\Mail\Expense\ExpenseApproved;
use App\Mail\Expense\ExpenseRejected;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ExpenseTable extends Component
{
    use WithPagination;

    public $sortField = 'submitted_at';
    public $sortDirection = 'desc';
    public $title = '';
    public $body = '';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function approve(Expense $expense)
    {
        $expense->status = 'approved';
        $expense->save();
        $expense->refresh();

        session()->flash('message', 'Expense approved.');

        // Send email notification to employees
        $recipients = env('EMAIL_RECIPIENT');
        if (isset($recipients) && $recipients !== '') {
            Mail::to($recipients)->send(new ExpenseApproved($expense));
        }

        // Refresh the list of expenses
        $this->render();
    }

    public function reject(Expense $expense)
    {
        $expense->status = 'rejected';
        $expense->save();
        $expense->refresh();

        session()->flash('message', 'Expense rejected.');

        // Send email notification to employees
        $recipients = env('EMAIL_RECIPIENT');
        if (isset($recipients) && $recipients !== '') {
            Mail::to($recipients)->send(new ExpenseRejected($expense));
        }

        // Refresh the list of expenses
        $this->render();
    }

    public function render()
    {
        if (auth()->user()->isAdmin())
        {
            $expenses = Expense::isPending()
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
        }
        else 
        {
            $expenses = Expense::allUserExpenses()
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
        }

        return view('livewire.expenses.expense-table', [
            'expenses' => $expenses,
        ]);
    }

    public function mount()
    {
        $this->title = (auth()->user()->isAdmin() ? 'All' : 'My') . ' Expenses';
        $this->body = auth()->user()->isAdmin() ? 'All expenses submitted by all users.' : 'Here you will find your expenses and the current status of them.';
    }

    public function getStatusColour(Expense $expense): string
    {
        if ($expense->status === 'pending') {
            return 'yellow';
        }

        if ($expense->status === 'approved') {
            return 'green';
        }

        if ($expense->status === 'rejected') {
            return 'red';
        }

        return 'gray';
    }
}