<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //this method will show user registration page
    public function registration()
    {
        return view('front.account.registration');
    }
    //this method will show user login page
    public function login()
    {
        return view('front.account.login');
    }
    //this method will save user data
    public function processRegistration(Request $request)
    {   
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min.5|same:confirm_password',
            'confirm_password' => 'required'
        ]);
        if ($validator->passes()) {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);


            $user->save();

            session()->flash('success', 'you have registered successfully');


            return response()->json([
                'status' => true,
                'errors' => []

            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()

            ]);
        }
    }
}
