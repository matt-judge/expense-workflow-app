<?php

namespace App\Livewire\Expenses;

use Livewire\Component;
use App\Exports\Expenses\ExpensesExport;
use Maatwebsite\Excel\Facades\Excel;

class ExpenseReport extends Component
{
    public $status;

    public function export()
    {
        return Excel::download(new ExpensesExport($this->status), 'expenses.xlsx');
    }

    public function render()
    {
        return view('livewire.expenses.expense-report');
    }
}