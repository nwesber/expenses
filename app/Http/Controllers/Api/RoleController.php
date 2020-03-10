<?php

namespace App\Http\Controllers\Api;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function store(){

    }

    public function update(){

    }

    public function destroy(){
        
    }

}
