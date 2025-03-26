<?php

namespace App\Exports\Expenses;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExpensesExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $status;

    public function __construct($status = null)
    {
        $this->status = $status;
    }

    public function query()
    {
        $query = Expense::query()->with(['category', 'user', 'approver']);

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Description',
            'Category',
            'Amount',
            'Receipt Image',
            'Status',
            'User',
            'Approver',
            'Submitted At',
            'Approved At',
            'Rejected At',
            'Created At',
            'Updated At',
        ];
    }

    public function map($expense): array
    {
        return [
            $expense->id,
            $expense->description,
            $expense->category ? $expense->category->name : '',
            $expense->amount,
            $expense->receipt_image,
            $expense->status,
            $expense->user ? $expense->user->name : '',
            $expense->approver ? $expense->approver->name : '',
            $expense->submitted_at,
            $expense->approved_at,
            $expense->rejected_at,
            $expense->created_at,
            $expense->updated_at,
        ];
    }
}