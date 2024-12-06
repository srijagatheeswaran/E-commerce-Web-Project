<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use Validator;
class ProductControler extends Controller
{
    function productCreate(Request $request)
    {
        if ($request->session()->has('loggedInUser')) {
            return view('/productCreate');
        }
        return redirect('/login');
    }
    function createProduct(Request $request)
    {
        $product = new products();
        if ($request->session()->has('loggedInUser')) {
            $validator = Validator::make($request->all(), [
                'product_name' => 'required',
                'product_categorie' => 'required',
                'quantity' => 'required',
                'description' => 'required',
                'image' => 'required|mimes:jpg,png,jpeg|max:2048',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => $validator->getMessageBag(),
                ]);

            } else {
                $file = $request->file('image');
                $imageName = time() . '.' . $request->image->extension();

                if ($request->image->move(public_path('productImg'), $imageName)) {
                    $product = Products::create([
                        'product_name' => $request->input('product_name'),
                        'product_categorie' => $request->input('product_categorie'),
                        'quantity' => $request->input('quantity'),
                        'description' => $request->input('description'),
                        'image' => $imageName,
                    ]);
                    return response()->json(['status' => 200, 'message' => 'Product Created successfully']);
                }


            }
        }
        redirect('/login');
    }
    function productEdit(Request $request, int $id)
    {
        if ($request->session()->has('loggedInUser')) {
            $product = Products::findOrFail($id);
            return view('productEdit', compact('product'));
        }
        return redirect('/login');

    }
    function productUpdate(Request $request, int $id)
    {
        if ($request->session()->has('loggedInUser')) {
            $validator = Validator::make($request->all(), [
                'product_name' => 'required',
                'product_categorie' => 'required',
                'quantity' => 'required',
                'description' => 'required',
                'image' => 'mimes:jpg,png,jpeg|max:2048',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => $validator->getMessageBag(),
                ]);

            } else {
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $imageName = time() . '.' . $request->image->extension();

                    if ($request->image->move(public_path('productImg'), $imageName)) {
                        products::findOrFail($id)->update([
                            'product_name' => $request->input('product_name'),
                            'product_categorie' => $request->input('product_categorie'),
                            'quantity' => $request->input('quantity'),
                            'description' => $request->input('description'),
                            'image' => $imageName,
                        ]);
                        return response()->json(['status' => 200, 'message' => 'Update SuccessFully']);
                    }
                } else {
                    products::findOrFail($id)->update(
                        [
                            'product_name' => $request->input('product_name'),
                            'product_categorie' => $request->input('product_categorie'),
                            'quantity' => $request->input('quantity'),
                            'description' => $request->input('description'),
                        ]
                    );
                    return response()->json([
                        'status' => 200,
                        'message' => 'Update SuccessFully'
                    ]);
                }
            }
            return redirect('/login');



        }

    }
    function productDelete(Request $request,int $id)
    {

        if ($request->session()->has('loggedInUser')) {
            $prodect = Products::findOrFail($id);
            $prodect->delete();
            return redirect()->back()->with('success', 'Product delete Successfully');
        }
        return redirect('/login');

    }
    function showOrders(Request $request)
    {
        if ($request->session()->has('loggedInUser')) {
            return view('orders');
        }
        return redirect('/login');



    }
}
