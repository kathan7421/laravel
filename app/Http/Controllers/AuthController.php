<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Storage;
use File;
use Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function loginProcess(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $checkUser = User::where('email',$request->email)->where('user_type','1')->first();
        if($checkUser){
            $credencial =$request->only('email','password');
            if(Auth::attempt($credencial)) {
                return redirect()->intended('dashboard')->withSuccess('You have Successfully loggedin');
            }
}
        
        return redirect("login")->with('error','Oppes! You have entered invalid credentials');
    }
    public function register(){
      return view('auth.register');
    }
    public function registerProcess(Request $request){
        $request->validate([
			'name' => 'required',
			'email' => 'required',
            'phone' =>'required',
			'password' => 'required|min:6',
			'profile_pic' => 'mimes:jpeg,jpg,png,gif|required',
		]);

         // Check if a file has been uploaded
    

        $request = User::create([
			'name'=>$request->name,
			'email'=>$request->email,
			'phone'=>$request->phone,
			'password'=>Hash::make($request->password),
			'profile_pic'=>$this->uploadImage($request->profile_pic),
		]);
		return redirect ('login');
    }
    public function uploadImage($file){
		$fileName   = time() . $file->getClientOriginalName();
		Storage::disk('public')->put('images/' . $fileName, File::get($file));
		$file_name  = $file->getClientOriginalName();
		$file_type  = $file->getClientOriginalExtension();
		$filePath   =  $fileName;
		return $filePath;
	}
    public function dashboard(){
        if(Auth::check()){
            return view('auth.dashboard');
        }
        return redirect()->route('login')->withSuccess('Opps! You do not have access');
    }
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
   
}
