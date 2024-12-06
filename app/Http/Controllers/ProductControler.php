<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use Validator;
class ProductControler extends Controller
{
    function productCreate(Request $request){
        if($request->session()->has('loggedInUser'))
        {
            return  view('/productCreate');
        }
        redirect('/home');
    }
    function createProduct(Request $request){
        $product = new products();
        if($request->session()->has('loggedInUser'))
        {
            $validator = Validator::make($request->all(), [
                'product_name' => 'required',
                'product_categorie' => 'required',
                'quantity'=> 'required',
                'description'=> 'required',
                'image'=> 'required|mimes:jpg,png,jpeg|max:2048',
            ]);
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag(),
            ]);

        }else{
            $file = $request->file('image');
            $path = $file->store('productImg');
        
            $product = new products();
            $product->product_name = $request->product_name;
            $product->product_categorie = $request->product_categorie;
            $product->quantity = $request->quantity;
            $product->description = $request->description;
            $product->image = $path;
            $product->save();
            return response()->json(['status' => 200, 'message' => 'success']);
        }
        }
        redirect('/home');
    }
}
