<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    }
    //this method will save user data
    public function processRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min.5|same:confirm_password',
            'confirm_password' => 'required'
        ]);
        if ($validator->passes()) {

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()

            ]);
        }
    }
    // //this method will save user data
    // public function processRegistration(){

    // }

}
