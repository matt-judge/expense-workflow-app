<?php

namespace App\Livewire\Expenses\Dashboard;

use App\Models\Expense;
use Livewire\Component;

class PendingExpensesCount extends Component
{
    public $count;
    public $title = '';

    public function mount()
    {
        // Admins need visibility over all pending expenses
        if (auth()->user()->isAdmin()) {
            $this->title = 'All Pending Expenses';
            $this->count = Expense::isPending()->count();
        }
        else {
            $this->title = 'My Pending Expenses';
            $this->count = Expense::isPendingForUser()->count();
        }
    }

    public function render()
    {
        return view('livewire.expenses.dashboard.pending-expenses-count');
    }
}
