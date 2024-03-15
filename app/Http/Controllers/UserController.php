<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function login(Request $request)
    {
        
        try {
            $email = $request->input("email");
            $password = $request->input("password");
            $user = User::where("email", $email)->first();

            if ($user !== null) {
                if (password_verify($password, $user->password)) {
                    return response()->json(['user'=>$user],200);
               }
            } else {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to login: ' . $e->getMessage()], 500);
        }
    }

    public function signup(Request $request)
    {
        
        try {
            $user = $this->buildUser($request);
            $insertOK = $user->save();
            if ($insertOK) {
                return response()->json(['user'=>$user],201);
            } else {
                return response()->json(['error' => 'Insert error'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to signup: ' . $e->getMessage()], 500);
        }
    }
    public function forgot(Request $request)
    {
        try {
            $email = $request->input('email');
            return response()->json(['message'=>'Te hemos enviado un email para recuperar la contraseña a: '. $email],200);
            
        } catch (\Exception $e) {

        }
    }

    public function edit(Request $request)
    {
        try {
            $id = $request->input('id');
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $address = $request->input('address');
            $user = User::where('id', $id)->first();

            if ($user !== null) {

                if ($email !== null) {
                    $user->email = $email;
                }
                if ($phone !== null) {
                    $user->phone = $phone;
                }
                if ($name !== null) {
                    $user->name = $name;
                }
                if ($address !== null) {
                    $user->address = $address;
                }
                 $user->save();

                return response() -> json(['message' => 'user updated'],200);
            } else {
                return response() -> json(['message'=> 'Error updating user'],400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update: ' . $e->getMessage()], 500);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $id = $request->input('id');
            $password = $request->input('password');
            $password = bcrypt($password);
            $user = User::where('id', $id)->first();
            if ($user !== null) {
                if ($password !== null) {
                    $user->password = $password;
                    $updatePassword = $user->save();
                    if ($updatePassword) {
                        return response() -> json(['message' => 'password updated'],200);
                    } else {
                        return response() -> json(['message'=> 'Error updating password'],400);
                    }
                }
            } else {
                return response() -> json(['message'=> 'Error updating password'],404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update: ' . $e->getMessage()], 500);
        }
    }
    private function buildUser(Request $request)
    {
        $name = $request->input("name");
        $password = $request->input("password");
        $password = bcrypt($password);
        $phone = $request->input("phone");
        $email = $request->input("email");
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->phone = $phone;
        $user->type = 1;
        return $user;
    }
}
