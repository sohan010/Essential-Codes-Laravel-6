<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wishlist;
use Toastr;
use Auth;
use DB;

class WishlistController extends Controller
{
    public function index()
    {
      $wishlists = Wishlist::where('user_id',Auth::id())->get();
      return view('wishlist',compact('wishlists'));
    }

    public function AddToWishlist($id)
    {
      $userid = Auth::id();
      $check = DB::table('wishlists')->where('user_id',$userid)->where('product_id',$id)->first();

      $data=array();
      $data['user_id']=$userid;
      $data['product_id']=$id;


      if(Auth::check()){

      if($check){

        return \Response::json(['error'=>'Already added in wishlist']);
      }else{
        DB::table('wishlists')->insert($data);
        return \Response::json(['success'=>'Product added on wishlist']);
      }

        }else{
          return \Response::json(['error'=>'Login your account first']);

          }
        }

        public function RemoveWishlist($id)
        {

          Wishlist::where('id',$id)->delete();
          Toastr::success('Wishlist Item Delete Success', 'Success');
          return redirect()->back();
        }
}
