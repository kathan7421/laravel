<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Storage;
use File;
use Session;

class AdminAuthController extends Controller
{


    public function adminLogin(){
        return view('admin.auth.login');
    }
    public function loginProcess(Request $request){
        
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
     $checkUser = User::where('email',$request->email)->where('user_type','2')->first();
        if($checkUser){
            $credencial =$request->only('email','password');
            if(Auth::attempt($credencial)) {
                return redirect()->route('admin.dashboard')->withSuccess('You have Successfully loggedin');
            }
        }
        
        return redirect()->route('admin.login')->withSuccess('Oppes! You have entered invalid credentials');

    }
    public function adminDashboard(){
        if(Auth::check() && Auth::user()->user_type === '2'){
            return view('admin.dashboard');
        } else {
            // Redirect to the admin login route
            return redirect("admin.login")->withSuccess('Opps! You do not have access');
            // Or show an error message or perform other actions
        }
    }
   
}
?>