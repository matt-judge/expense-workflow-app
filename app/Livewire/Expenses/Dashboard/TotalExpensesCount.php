<?php

namespace App\Livewire\Expenses\Dashboard;

use App\Models\Expense;
use Livewire\Component;

class TotalExpensesCount extends Component
{
    public $count;
    public $title;

    public function mount()
    {
        // Admins need visibility over all pending expenses
        if (auth()->user()->isAdmin()) {
            $this->title = 'Total Submitted Expenses';
            $this->count = Expense::count();;
        }
        else {
            $this->title = 'My Submitted Expenses';
            $this->count = Expense::allUserExpenses()->count();
        }
    }

    public function render()
    {
        return view('livewire.expenses.dashboard.total-expenses-count');
    }
}
