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
        $this->body = auth()->user()->isAdmin() ? 'All expenses submitted by all users.' : 'All expenses submitted by you.';
    }
}