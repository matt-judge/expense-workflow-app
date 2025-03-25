<?php

namespace App\Livewire\Expenses;

use App\Models\Expense;
use Livewire\Component;

class PendingExpenseCount extends Component
{
    public $pendingExpenseCount = 0;

    public function render()
    {
        return view('livewire.expenses.pending-expense-count');
    }

    public function mount()
    {
        $this->pendingExpenseCount = Expense::isPending()->count();
    }
}
