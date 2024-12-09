<?php

namespace App\Http\Controllers;
// use Illuminate\support\facades\Auth;
// use Auth;
use App\Models\products;
use Hash;
use Illuminate\Http\Request;
use App\Models\admins;
use Validator;

class adminController extends Controller
{
    function index(Request $request){
        if($request->session()->has('loggedInUser'))
        {
            return  redirect('/adminhome');
        }
        return view('admin.adminLogin');
    }
    function login(Request $request)
    {
        if($request->session()->has('loggedInUser'))
        {
            return  redirect('/adminhome');
        }
        return view('admin.adminLogin');

    }
    function home(Request $request)
    {
        if($request->session()->has('loggedInUser'))
        {
            $productDetails =products::get();
            // return $productDetails;
            return view('admin.welcome',compact('productDetails'));
        }
        return  redirect('/adminlogin');
    }
    function register(Request $request)
    {
        if($request->session()->has('loggedInUser'))
        {
            return view('admin.adminregister');
        }
        return redirect('/adminlogin');
    }
    function logout(){

        if(session()->has('loggedInUser')){
            session()->pull('loggedInUser');
            return redirect('/adminlogin');
        }
    }


    function loginPost(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required|min:6|max:50'
        ]);
        $email = $request->email;
        $password = $request->password;
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag(),
            ]);
        } else {
            $admin = admins::where(['email' => $email])->first();
            if ($admin) {
                if (Hash::check($password, $admin->password)) {
                    // return redirect()->intended(route('home'))->with("success", "Login success");
                    $request->session()->put('loggedInUser', $admin->id);
                    return response()->json(['status' => 200, 'message' => 'success']);
                } else {
                    return response()->json(['status' => 401, 'message' => 'password is not match']);
                }
            } else {
                return response()->json(['status' => 401, 'message' => 'Email is not match']);
            }
        }

        //    $credentails = $request -> only('email','password');

    }



    function registerPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:50',
            'email' => 'required|email|max:100|unique:admins',
            'password' => 'required|min:6|max:50',
            'repassword'=>'required|min:6|max:50|same:password'
        ],[
            'repassword.same'=>'Password did not matched!',
            'repassword.required'=>' Confirm Password is required!'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag(),
            ]);
        }else{
            $admin = new admins();
            $admin->name= $request->name;
            $admin->email= $request->email;
            $admin->password= Hash::make($request->password);
            $admin->save();
            return response()->json(
                ['status'=> 200,'message'=> 'registered successfully']
            );
        }

    }
}
