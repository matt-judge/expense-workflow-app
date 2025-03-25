<?php

namespace App\Exports\Expenses;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpensesExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $status;

    public function __construct($status = null)
    {
        $this->status = $status;
    }

    public function query()
    {
        $query = Expense::query();

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
            'Category ID',
            'Amount',
            'Receipt Image',
            'Status',
            'User ID',
            'Approver ID',
            'Submitted At',
            'Approved At',
            'Rejected At',
            'Created At',
            'Updated At',
        ];
    }
}