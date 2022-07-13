<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;

class UsersController extends Controller
{
    public function searchUsers(Request $request)
    {
        try {
            $result = User::select("*")->orderBy('name','ASC');

            if(!empty($request->keyword))
            {
                $result->where('name','like', '%'.$request->keyword.'%')
                ->orWhere('email', 'like', '%'.$request->keyword.'%');
            }

            
            $data = $result->get();
            
        } catch (\Throwable $th) {
            return response()->json(['code' => '00','message' => 'errors']);  
        }

        return response()->json(['code' => '00','message' => 'success', 'data' => $data]);   
    }

    public function indexUsers()
    {
        $data = User::all();

        return response()->json(['code' => '00','message' => 'success', 'data' => $data]);   
    }

    public function createUsers(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['code' => '00','message' => 'success']);   
    }

    public function detailUsers($id)
    {
        $data = User::find($id);

        return response()->json(['code' => '00','message' => 'success', 'data' => $data]);
    }

    public function updateUsers(Request $request ,$id)
    {
        $users = User::find($id);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ];

        $users->update($data);

        return response()->json(['code' => '00','message' => 'success']);
    }

    public function deleteUsers($id)
    {
        $data = User::find($id);
        $data->delete();

        return response()->json(['code' => '00','message' => 'success']);
    }

}
