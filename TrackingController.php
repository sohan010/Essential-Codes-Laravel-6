<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Shipping;
use Toastr;

class TrackingController extends Controller
{

  public function OrderTracking(Request $request)
  {
      $status_code = $request->status_code;
      $shipping_email = $request->shipping_email;

      $code_check = Order::where('status_code',$status_code)->first();
      $email_check = Shipping::where('shipping_email',$shipping_email)->first();

      if($code_check && $email_check){
        return view('customer.tracking',compact('code_check','email_check'));
      }else{
        Toastr::error('Invalid Status Code or Email !','Error');
        return redirect()->back();
      }
  }

}
