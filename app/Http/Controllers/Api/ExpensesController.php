<?php

namespace App\Http\Controllers\Api;

use App\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExpensesController extends Controller
{

    public function index()
    {
        $expenses = Expense::with('category')->get();
        return response()->json(
            [
                'status' => 'success',
                'expenses' => $expenses->toArray()
            ], 200);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'amount' => 'required',
            'entry_date'  => 'required',
        ]);

        if ($validate->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validate->errors()
            ], 422);
        }


        Expense::create($request->all());
        return response()->json(
            [
                'status' => 'success',
            ], 200);
    }

    public function update(Request $request){
        $expense = Expense::find($request->id);
        $expense->update($request->all());
        return response()->json(
            [
                'status' => 'success',
            ], 200);
    }

    public function destroy(Request $request){
        $expense = Expense::find($request->id);
        $expense->delete();

        return response()->json(
            [
                'status' => 'success'
            ], 200);
    }
}
