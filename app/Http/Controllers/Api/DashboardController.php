<?php

namespace App\Http\Controllers\Api;

use App\Expense;
use App\ExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{

    public function index()
    {
       
        $categories = ExpenseCategory::all();
        $expenses = array();

        foreach ($categories as $key => $category) {
            $expense = Expense::where('expense_category_id', $category->id)->sum('amount');
            array_push($expenses, $expense);
        }

        return response()->json([
            'expenses' => $expenses,
            'categories' => $categories->pluck('name')
        ], 200);

    }
}
