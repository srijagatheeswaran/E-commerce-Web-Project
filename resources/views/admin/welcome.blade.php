@extends('layout')
@section('title', 'Admin Panel')
@section('content')
<div class="Dashboard">
    <header>
        <h1 class="h1">Dashboard</h1>
        <a href="{{route('auth.logout')}}" class="btn btn-danger">Logout</a>
    </header>
    <div class="createBox">
        <a href="{{route('productCreate')}}" class="btn btn-success mx-3">Create Products</a>
        <a class="btn btn-success" href="{{route('show.orders')}}">Orders</a>
        <a href="{{route('adminregister')}}" class="btn btn-success mx-3">Create Admin</a>
    </div>
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="productTableBox">
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>No</th>
                    <th>product Image</th>
                    <th>product Name</th>
                    <th>product Categorie</th>
                    <th>quantity</th>
                    <th>description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($productDetails as $key => $productDetail)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td class="productImg"><img src="productImg/{{$productDetail->image}}" /></td>
                        <td>{{$productDetail->product_name}}</td>
                        <td>{{$productDetail->product_categorie}}</td>
                        <td>{{$productDetail->quantity}}</td>
                        <td>{{$productDetail->description}}</td>
                        <td>
                            <div class="action"><a href="{{url('product/' . $productDetail->id . '/edit')}}"
                                    class="btn btn-primary">edit</a><a
                                    href="{{url('product/' . $productDetail->id . '/delete')}}"
                                    class="btn btn-danger">delete</a></div>
                        </td>
                    </tr>

                @endforeach

            </tbody>
        </table>
    </div>

</div>

@endsection