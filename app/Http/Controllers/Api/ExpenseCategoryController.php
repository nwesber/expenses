<?php

namespace App\Http\Controllers\Api;

use App\ExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExpenseCategoryController extends Controller
{

    public function index()
    {
        $categories = ExpenseCategory::all();
        return response()->json(
            [
                'status' => 'success',
                'categories' => $categories->toArray()
            ], 200);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'description'  => 'required',
        ]);

        if ($validate->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validate->errors()
            ], 422);
        }


        ExpenseCategory::create($request->all());
        return response()->json(
            [
                'status' => 'success',
            ], 200);
    }

    public function update(Request $request){
        $category = ExpenseCategory::find($request->id);
        $category->update($request->all());
        return response()->json(
            [
                'status' => 'success',
            ], 200);
    }

    public function destroy(Request $request){
        $category = ExpenseCategory::find($request->id);
        $category->delete();

        return response()->json(
            [
                'status' => 'success'
            ], 200);
    }
}
