@extends('Layout.dashboard')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="btn btn-dark"><a href="{{route('create')}}">Add Product</a></div>
            @if(Session::has('msg'))
            <div class="alert alert-success">{{Session::get('msg')}}</div>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>

                @foreach ($product as $i=>$item )
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$item->name}}</td>
                    <td>
                        <img style="width:60px;" src="{{asset('images/products/'.$item->image)}}" alt="">
                    </td>
                    <td>
                        <a href="{{route('edit',$item->id)}}"><div class="btn btn-primary btn-sm">Edit</div></a>
                        <a href="{{route('delete',$item->id)}}"><div class="btn btn-primary btn-sm">Delete</div></a>
                    </td>
                </tr> 
                @endforeach

            </table>
        </div>
    </div>
</div>
@endsection