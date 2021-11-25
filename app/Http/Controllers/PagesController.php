<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Session;

class PagesController extends Controller
{
    //
   public function home() {
    return view('pages.index');
   }

   public function about() {
    return view('pages.about');
   }

    public function services()
    {
       /* $products = DB::table('products')
                    ->get(); */

          $products = Product::inRandomOrder()->paginate(3);


        return view('pages.services')->with('products',$products);
    }

    public function show($id){
      /* $product = DB::table('products')
                    ->where('id', $id)
                    ->first(); */
         $product = Product::find($id);

                    return view('pages.show')->with('product', $product);
                }
    public function create(){

        return view('pages.create');

    }

    public function saveproduct(Request $request){

        $this->validate($request, ['products_name' => 'required',
                                   'products_price' => 'required',
                                   'products_description' => 'required']);

       $product = new Product();
       $product->products_name = $request->products_name;
       $product->products_price = $request->products_price;
       $product->products_description = $request->products_description;
       $product->save();

       Session::put('success','The product has been added successfully');

       return redirect('/create');
    }

    public function editproduct($id){

        $product = Product::find($id);

        return view('pages.editproduct')->with('product',$product);

    }
    public function updateproduct(Request $request){
       $product = Product::find($request->id);
       $product->products_name = $request->products_name;
       $product->products_price = $request->products_price;
       $product->products_description = $request->products_description;
       $product->update();

       Session::put('success','The '.$request->products_name.' has been updated successfully');

       return redirect('/services');

    }

    public function deleteproduct($id){
        $product = Product::find($id);

        $product->delete();

        Session::put('success','The '.$product->products_name.' has been deleted successfully');

       return redirect('/services');

    }

}
