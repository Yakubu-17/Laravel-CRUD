<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::inRandomOrder()->paginate(3);


        return view('products.services')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, ['products_name' => 'required',
                                   'products_price' => 'required',
                                   'products_description' => 'required',
                                   'products_image' => 'image|nullable|max:1999']);
       // print('This image is '.$request->file('products_image'));
       $fileName = $request->file('products_image')->getClientOriginalName();
       print('The original is '.$fileName);

       echo '<pre></pre>';

       $file = pathinfo($fileName, PATHINFO_FILENAME );

       print('The file name is '.$file);
       echo '<pre></pre>';
       $ext = $request->file('products_image')->getClientOriginalExtension();
       print('The original is '.$ext);

       echo '<pre></pre>';
       $fileStore = $fileName.'_'.time().'.'.$ext;
       print('The filename to store is '.$fileStore);

       $product = new Product();
       $product->products_name = $request->products_name;
       $product->products_price = $request->products_price;
       $product->products_description = $request->products_description;
       /*$product->save();

       Session::put('success','The '.$request->products_name.' has been added successfully');

       return redirect('/products');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Product::find($id);

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::find($id);

        return view('products.editproduct')->with('product', $product);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::find($id);
        $product->products_name = $request->products_name;
        $product->products_price = $request->products_price;
        $product->products_description = $request->products_description;
        $product->update();

        Session::put('success', 'The ' . $request->products_name . ' has been updated successfully');

        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);

        $product->delete();

        Session::put('success', 'The ' . $product->products_name . ' has been deleted successfully');

        return redirect('/products');
    }
}
