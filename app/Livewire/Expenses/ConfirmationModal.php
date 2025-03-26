<?php

namespace App\Livewire\Expenses;

use Livewire\Component;
use App\Models\Expense;
use App\Mail\Expense\ExpenseApproved;
use App\Mail\Expense\ExpenseRejected;
use Illuminate\Support\Facades\Mail;

class ConfirmationModal extends Component
{
    public $show = false;
    public $expenseId;
    public $action;

    protected $listeners = ['showApprovalModal', 'showRejectionModal'];

    public function showApprovalModal($expenseId)
    {
        $this->expenseId = $expenseId;
        $this->action = 'approve';
        $this->show = true;
    }

    public function showRejectionModal($expenseId)
    {
        $this->expenseId = $expenseId;
        $this->action = 'reject';
        $this->show = true;
    }

    public function hideModal()
    {
        $this->show = false;
    }

    public function confirmAction()
    {
        $expense = Expense::find($this->expenseId);

        if ($this->action === 'approve') {
            $expense->status = 'approved';
            $expense->approved_at = now();
            $expense->save();
            $expense->refresh();

            session()->flash('message', 'Expense approved.');

            // Send email notification to employees
            $recipients = env('EMAIL_RECIPIENT');
            if (isset($recipients) && $recipients !== '') {
                Mail::to($recipients)->send(new ExpenseApproved($expense));
            }

            return redirect()->route('expenses.admin');
        } elseif ($this->action === 'reject') {
            $expense->status = 'rejected';
            $expense->rejected_at = now();
            $expense->save();
            $expense->refresh();

            session()->flash('message', 'Expense rejected.');

            // Send email notification to employees
            $recipients = env('EMAIL_RECIPIENT');
            if (isset($recipients) && $recipients !== '') {
                Mail::to($recipients)->send(new ExpenseRejected($expense));
            }

            return redirect()->route('expenses.admin');
        }

        $this->hideModal();
    }

    public function render()
    {
        return view('livewire.expenses.confirmation-modal');
    }
}