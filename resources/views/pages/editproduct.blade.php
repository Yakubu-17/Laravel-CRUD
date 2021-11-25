@extends('layouts.app')

@section('title')
  Home
@endsection
@section('content')

 @if (Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
        {{ Session::put('success', null) }}
    </div>

 @endif
 {{-- <form action="{{url('/saveproduct')}}" method="POST" class="form-horizontal">
  --}}

 {!! Form::open(['action' => 'App\Http\Controllers\PagesController@updateproduct', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
 {{csrf_field()}}
    <div class="form-group">
        {{ Form::hidden('id',$product->id) }}
        {{-- <label>Product</label> --}}
        {{ Form::label('','Product Name') }}
        {{-- <input type="text" name="products_name" placeholder="Product Name" class="form-control" required> --}}
        {{ Form::text('products_name', $product->products_name,['placeholder' => 'Product Name', 'class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{-- <label>Product Price</label>
        <input type="text" name="products_price" placeholder="Product Price" class="form-control" required>
         --}}
        {{ Form::label('','Product Price') }}
        {{ Form::number('products_price', $product->products_price,['placeholder' => 'Product Price', 'class' => 'form-control']) }}


    </div>
    <div class="form-group">
        {{-- <label>Product description</label>
        <textarea name="products_description" cols="30" rows="10" class="form-control" required></textarea>
         --}}
        {{ Form::label('','Product Description') }}
        {{ Form::textarea('products_description', $product->products_description,['placeholder' => 'Product Description', 'class' => 'form-control']) }}

    </div>
    {{-- <input type="submit" value="Add Product" class="btn btn-primary">
   --}}
      {{ Form::submit('Update Product', ['class' => 'btn btn-primary'] ) }}

 {{-- </form> --}}
 {!!Form::close()!!}

@endsection
