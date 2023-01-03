@extends('Layout.dashboard')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="btn btn-dark"></div><a href="{{route('index')}}">Product List</a>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(Session::has('msg'))
            <div class="alert alert-success">{{Session::get('msg')}}</div>
            @endif
        </div>
        <div class="card-body">
            <form action="{{route('edit',$item->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <input type="text" name="name" value="{{$item->name}}" placeholder="Enter product Name" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <img style="width:60px;" src="{{asset('images/products/'.$item->image)}}" alt="">
                    <input type="file" name="image" class="form-control">
                </div>
                <input type="submit" class="btn btn-success btn-sm mt-3">
            </form>
        </div>
    </div>
</div>
@endsection