<?php

namespace App\Livewire\Expenses;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

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

    public function render()
    {
        $expenses = Expense::orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

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