<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function manage(Expense $expense)
    {
        return view('expenses.manage', compact('expense'));
    }
}