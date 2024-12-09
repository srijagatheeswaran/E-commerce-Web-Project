<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function profile(){
        if (session()->has('loggedInUser')){
            return view('user.profile');
        }
        return redirect('/login');
    }
    function cart(){
        if (session()->has('loggedInUser')){
            return view('user.cart');
        }
        return redirect('/login');
    }
    function like(){
        if (session()->has('loggedInUser')){
            return view('user.like');
        }
        return redirect('/login');
    }
    function orders(){
        if (session()->has('loggedInUser')){
            return view('user.orders');
        }
        return redirect('/login');
    }
}
