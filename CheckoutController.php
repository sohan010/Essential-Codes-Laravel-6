<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Toastr;
use App\Shipping;
use App\Order;
use App\OrderDetail;
use DB;
use Cart;
use Session;
use App\Mail\InvoiceMail;
use Mail;

class CheckoutController extends Controller
{
    public function index()
    {
      if(Auth::check()){
        return view('checkout');
      }else{
        Toastr::error('Please Login your Account First','Error');
        return redirect()->route('customer.login');
      }
    }

    public function PaymentProcess(Request $request)
    {

        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_country'] = $request->shipping_country;
        $data['order_note'] = $request->order_note;

        return view('stripe_payment',compact('data'));
    }

    public function StripeCharge(Request $request)
    {
      $userEmail = Auth::user()->email;
      $total = $request->total;

      \Stripe\Stripe::setApiKey('sk_test_KlxKKA65GPlm3iok7sbp9QEj00QuHkkWBZ');

       $token = $_POST['stripeToken'];
       $charge = \Stripe\Charge::create([

          'amount' => $total*100,
          'currency' => 'usd',
          'description' => 'Fashion Ecommerce',
          'source' => $token,
          'metadata' => ['order_id' => uniqid()],
      ]);

      //Order table Insert here
      $data = array();
      $data['user_id'] = Auth::id();
      //(Payment method and metada etc got from (dd) of $charge)
      $data['payment_id'] = $charge->payment_method;
      $data['payment_type'] = $request->payment_type;
      $data['stripe_order_id'] = $charge->metadata->order_id;
      $data['balance_transection_id'] = $charge->balance_transaction;
      $data['shipping_charge'] = $request->shipping_charge;
      $data['vat'] = $request->vat;
      $data['total'] = $request->total;

      if(Session::has('coupon')){
       $data['subtotal'] = Session::get('coupon')['balance'];
      }else{
       $data['subtotal']=Cart::Subtotal();
      }
      $data['status'] =0;
      $data['date'] =date('d-m-y');
      $data['month'] =date('F');
      $data['year'] =date('Y');
      $data['status_code'] = mt_rand(100000,999999);
    $order_id = DB::table('orders')->insertGetId($data);

    //Sending mail to user
     Mail::to($userEmail)->send(new InvoiceMail($data));


       // Insert shipping details here
        $shipping = array();
        $shipping['order_id']=$order_id;
        $shipping['shipping_name']=$request->shipping_name;
        $shipping['shipping_email']=$request->shipping_email;
        $shipping['shipping_phone']=$request->shipping_phone;
        $shipping['shipping_address']=$request->shipping_address;
        $shipping['shipping_country']=$request->shipping_country;
        $shipping['order_note']=$request->order_note;
        DB::table('shippings')->insert($shipping);

       // Insert Order details table here
        $content = Cart::content();
        $details = array();

          foreach($content as $row){
                $details['order_id']=$order_id;
                $details['product_id']=$row->id;
                $details['name']=$row->name;
                $details['color']=$row->options->color;
                $details['size']=$row->options->size;
                $details['qty']=$row->qty;
                $details['unit_price']=$row->price;
                $details['total_price']=$row->qty * $row->price;
                DB::table('order_details')->insert($details);
          }

                Cart::destroy();

                if(Session::has('coupon')){
                Session::forget('coupon');
             }

             Toastr::success('Order Submit Success', 'Success');
             return redirect()->route('website.index');

    }
}
