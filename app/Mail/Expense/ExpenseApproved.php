<?php

namespace App\Mail\Expense;

use App\Models\Expense;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpenseApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $expense;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your expense has been approved')
                    ->view('emails.expense-approved');
    }
}