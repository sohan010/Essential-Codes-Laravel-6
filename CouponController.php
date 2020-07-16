<?php


class CouponController extends Controller
{
  public function ApplyCoupon(Request $request)
  {
      $coupon = $request->coupon;
      $check = Coupon::where('coupon_name',$coupon)->first();

      if($check){
        session::put('coupon',[
          'name'=> $check->coupon_name,
          'discount'=> $check->coupon_discount,
          'balance'=> Cart::subtotal() - $check->coupon_discount,
        ]);

        Toastr::success('Coupon Apply Success', 'Success');
        return redirect()->back();

      }else{

        Toastr::error('Invalid Coupon..!', 'Error');
        return redirect()->back();
      }
  }

  public function RemoveCoupon()
  {
      session::forget('coupon');
      Toastr::success('Coupon has been Cancled', 'Success');
      return redirect()->back();
  }
}
