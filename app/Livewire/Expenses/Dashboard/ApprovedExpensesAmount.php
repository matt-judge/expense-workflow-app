<?php

namespace App\Livewire\Expenses\Dashboard;

use App\Models\Expense;
use Livewire\Component;

class ApprovedExpensesAmount extends Component
{
    public $totalAmount;
    public $title;

    public function mount()
    {
        // Admins need visibility over all pending expenses
        if (auth()->user()->isAdmin()) {
            $this->title = 'Total Approved Expenses';
            $this->totalAmount = Expense::isApproved()->sum('amount');
        }
        else {
            $this->title = 'My Approved Expenses';
            $this->totalAmount = Expense::isApproved()->allUserExpenses()->sum('amount');
        }
    }

    public function render()
    {
        return view('livewire.expenses.dashboard.approved-expenses-amount');
    }
}
