@extends('layouts.app')


@section('title')
  Services
@endsection


@section('content')


        <h1>Welcome to the services page</h1>
        <h2>Product details</h2>
           <div >
               <h1>{{ $product->products_name }}</h1>
               <h4>$ {{ $product->products_price }}</h4>
               <p>{{ $product->products_description }}</p>
               <hr>
               <h4>Written at {{ $product->created_at }}</h4>
               <hr>
               <a href="/products/{{ $product->id }}/edit" class="btn btn-primary">Edit</a>
               {!! Form::open(['action' => ['App\Http\Controllers\ProductController@destroy', $product->id], 'class'=> 'pull-right']) !!}
                   {{ Form::submit('Delete', ['class' => 'btn btn-danger'] )}}
                   {{ Form::hidden('_method', 'DELETE')}}
               {!! Form::close() !!}

           </div>



@endsection
