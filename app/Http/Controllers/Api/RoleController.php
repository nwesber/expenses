<?php

namespace App\Http\Controllers\Api;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return response()->json(
            [
                'status' => 'success',
                'roles' => $roles->toArray()
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


        Role::create($request->all());
        return response()->json(
            [
                'status' => 'success',
            ], 200);
    }

    public function update(Request $request){
        $role = Role::find($request->id);
        $role->update($request->all());
        return response()->json(
            [
                'status' => 'success',
            ], 200);
    }

    public function destroy(Request $request){
        $role = Role::find($request->id);
        $role->delete();

        return response()->json(
            [
                'status' => 'success'
            ], 200);
    }

}
