<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;
use Toastr;
use Cart;

class CartController extends Controller
{
    public function index()
    {
      $contents = Cart::content();
      return view('cart',compact('contents'));
    }

    public function AddToCart($id)
    {
      //Without Page Loading Add cart Ajax
      $product = DB::table('products')->where('id',$id)->first();
      $data = array();
      $data['id'] = $product->id;
      $data['name'] = $product->product_name;
      $data['qty'] = 1;
      $data['weight'] = 1;
      $data['price'] = $product->selling_price;
      $data['options']['image_one']= $product->image_one;
      $data['options']['color']= $product->product_color;
      $data['options']['size']= $product->product_size;
       Cart::add($data);
       return \Response::json(['success' => 'Product added on your Cart']);
    }

    public function CheckCart()
    {
        $cart = Cart::content();
        return $cart;
    }

    public function CartUpdate(Request $request)
    {
      $rowId = $request->productid;
      $qty = $request->qty;

      Cart::update($rowId,$qty);
      Toastr::success('Cart Update Success', 'Success');
      return redirect()->back();

    }

    public function RemoveCart($rowId)
    {
        Cart::remove($rowId);
        Toastr::success('Cart Item Remove Success', 'Success');
        return redirect()->back();

    }

    public function AddToCartSingle(Request $request, $id)
    {
      //With Page Loading Add cart


      $product = Product::find($id);

       $data['id']= $product->id;
       $data['name']=$product->product_name;
       $data['qty']=$request->qty;
       $data['price']= $product->selling_price;
       $data['weight']=1;
       $data['options']['image_one']=$product->image_one;
       $data['options']['color']=$request->color;
       $data['options']['size']=$request->size;

       Cart::add($data);
       Toastr::success('Product Added to Cart','Success');
       return redirect()->route('shop.category');
    }
}
