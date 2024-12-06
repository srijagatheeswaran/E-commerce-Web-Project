@extends('layout')
@section('title', 'Admin Panel')
@section('content')
<div class="Dashboard">
    <header>
        <h1 class="h1">Dashboard</h1>
        <a href="{{route('auth.logout')}}" class="btn btn-danger">Logout</a>
    </header>
    <div class="createBox">
        <a href="{{route('productCreate')}}" class="btn btn-success mx-3" >Create Products</a>

        <a href="{{route('register')}}" class="btn btn-success mx-3">Create Admin</a>
    </div>

</div>

@endsection