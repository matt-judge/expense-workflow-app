<?php

namespace App\Livewire\Expenses;

use Livewire\Component;
use App\Models\Expense;
use App\Mail\Expense\ExpenseApproved;
use App\Mail\Expense\ExpenseRejected;
use Illuminate\Support\Facades\Mail;

class Manage extends Component
{
    public $expense;

    protected $listeners = ['showConfirmationModal'];

    public function mount(Expense $expense)
    {
        $this->expense = $expense;
    }

    public function showApprovalModal()
    {
        $this->dispatch('showApprovalModal', $this->expense->id);
    }

    public function showRejectionModal()
    {
        $this->dispatch('showRejectionModal', $this->expense->id);
    }

    public function render(Expense $expense)
    {
        return view('livewire.expenses.manage');
    }
}