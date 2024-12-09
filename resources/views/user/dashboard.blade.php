@extends('layout')
@section('title', 'Dash Board')

@section('content')

<div class="dashboard">

    @include('user.header')

    <div class="productShow">
        <div class="heading">
            <h4>HOME</h4>
            <form>
                <div>
                    <label for="category">Category</label>
                    <select id="category" class="form-select">
                        <option>Select</option>
                    </select>
                </div>
                <div>
                    <label for="category">Size</label>
                    <select id="category" class="form-select">
                        <option>Select</option>
                        <option>Select</option>
                        <option>Select</option>
                    </select>
                </div>
                <div>
                    <button class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        <div class="products">
            <!-- {{$productDetails}} -->
            @foreach ($productDetails as $key => $productDetail)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top cardImg" src="productImg/{{$productDetail->image}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$productDetail->product_name}}</h5>
                    <h6>Price <span>₹{{$productDetail->price}}</span></h6>
                    <div class="productAction">
                        <a><i class="fa-solid fa-cart-plus"></i></a>
                        <a><i class="fa-solid fa-heart"></i></a>
                    </div>
                    <!-- <p class="card-text">{{$productDetail->product_categorie}}</p> -->
                    <!-- <p class="card-text">{{$productDetail->description}}</p> -->
                </div>
            </div>
            @endforeach
        </div>

    </div>

    @include('user.navigation')


</div>



@endsection

@section('script')

@endsection