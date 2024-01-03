<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     


    //this section for updateprofilepic
    public function updateProfilePic(Request $request)
    {
       dd($request->all());
    }
   

    //authenticate login process

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',

        ]);
        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('account.profile');
            } else {
                return redirect()->route('account.login')->with('error', 'either email/password is incorrect');
            }
        } else {
            return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }
    //profile page
    public function profile()
    {
       $id = Auth::user()->id;
       
      

       $user = User::where('id',$id)->first();
    


       return view('front.account.profile',[
        'user' => $user]);
    }
      // update profile
    public function upadteProfile(Request $request){

        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [


            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users,email,.$id.,id',

        ]);

        if($validator->passes()) {

            $user = User::find($id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->destination = $request->designation;
            $user->save();

            session()->flash('success','profile updated successfully');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }
     //logout
     public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
     }
    //this method will save user data
    public function processRegistration(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|same:confirm_password',
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
