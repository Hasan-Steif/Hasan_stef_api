<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   
    public function index()
    {
        return  UserResource::collection(User::all());

    }

    
    public function show($id)
    {
        $user=User::find($id);
        if(! $user){
            return response()->json([
                "message"=>"User not found"
            ],404
        );
        }
        return new UserResource(resource: $user);
    }

    // إضافة مستخدم جديد
    public function store(Request $request)
    {
        $User = User::create($request->all());

        return response()->json([
            'message' => 'User created successfully',
            'User' => $User,
        ], 201);
    }

    
    public function update(Request $request, $id)
    {
        $User= User::find($id);
        if(!$User){
            return response()->json([
                "message" => "User not found"
            ],
            404
        );
        }
        $User->update($request->all());
        return response()->json([
            "message" => "User successful update", 
            $User
        ]);
    }

   
    public function destroy($id)
    {
        $User= User::find($id);
        if(!$User){
            return response()->json([
                "message" => "User not found"
            ],
            404
        );
        }
        $User->delete();
        return response()->json([
            "message" => "User successful delete"
        ]);
    }
}
