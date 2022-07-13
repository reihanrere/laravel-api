<?php

namespace App\Http\Controllers;

use \App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
 
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
 
        return response()->json(compact('credentials','token'));
    }
 
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
 
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
 
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
 
        $token = JWTAuth::fromUser($user);
 
        return response()->json(compact('user','token'),201);
    }
 
    public function getAuthenticatedUser()
    {
        try {
 
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
 
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
 
            return response()->json(['token_expired'], $e->getStatusCode());
 
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
 
            return response()->json(['token_invalid'], $e->getStatusCode());
 
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
 
            return response()->json(['token_absent'], $e->getStatusCode());
 
        }
 
        return response()->json(compact('user'));
    }

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|max:20',
            'address' => 'required|max:255',
            'role' => 'required|max:10',
            'password' => 'required|string|min:6',
        ]);
 
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
 
        $token = JWTAuth::fromUser($user);
 
        return response()->json(['code' => '00','message' => 'success', 'data' => compact('user','token')],201);

        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'address' => $request->address,
        //     'role' => $request->role,
        //     'password' => bcrypt($request->password),
        // ]);

        // return response()->json(['code' => '00','message' => 'success']);   
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
