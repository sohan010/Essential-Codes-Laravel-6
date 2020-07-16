<?php

@extends('layouts.frontend.app')
@section('title','Order Tracking')

@section('content')

  <!--================Home Banner Area =================-->
  <section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
      <div class="container">
        <div class="banner_content text-center">
          <h2>Tracking</h2>
          <div class="page_link">
            <a href="index.html">Home</a>
            <a href="index.html">Customer</a>
            <a href="login.html">Order Tracking</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Home Banner Area =================-->


  <div class="container mt-5">
             <div class="row">

                 <div class="col-lg-5 offset-lg-1"  style="border: 1px solid blue; padding: 20px;">
                     <div class="contact_form_container" >
                         <h4 class=" mb-3 text-center mb-4">Your Order Status</h4>
                         <div class="progress mb-1">

                         @if($code_check->status ==0)
                         	 <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>

                         @elseif($code_check->status ==1)
                         	 <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>

                         	<div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>


                         @elseif($code_check->status ==2)
                         <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>

                         	<div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>

                         	<div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>


                         @elseif($code_check->status ==3)

                         <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>

 						  <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>

 						  <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>

 						   <div class="progress-bar bg-success" role="progressbar" style="width: 35%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>

                         @else
                           <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                         @endif

 						</div>

 						 @if($code_check->status ==0)
 						  <h5>Note : Your Order Is Under Review</h5>
 						 @elseif($code_check->status ==1)
 						  <h5>Note : Your Order is under payment accept</h5>
 						 @elseif($code_check->status ==2)
 						  <h5>Note : Your Order is Under Handover progress</h5>
 						 @elseif($code_check->status ==3)
 						  <h5>Note : Product Delevered Successfully </h5>
 						 @else
 			<h5>Note : Your order has been canceled <span class="text-danger">( due to some issues)</h5></span>
 						 @endif

                     </div>
                 </div>

                    <div class="col-lg-5 offset-lg-1"  style="border: 1px solid green; padding: 20px;">
                     <div class="contact_form_container" >
                         <h4 class=" mb-3 text-center">Your Order Information</h4>
                         <div class="jumbotron">
                         	<ul>
     		<li>Payment Type : <span class="text-primary">{{$code_check->payment_type}}</span></li>
     		<li>Payment ID : <span class="text-primary">{{$code_check->payment_id}}</span></li>
     		<li>Balance Transaction ID : <span class="text-primary">{{$code_check->balance_transection_id}}</span></li>
     		<li>Subtotal : <span class="text-primary">${{$code_check->subtotal}}</span></li>
     		<li>Shipping Charge : <span class="text-primary">${{$code_check->shipping_charge}}</span></li>
     		<li>Total : <span class="text-primary">${{$code_check->total}}</span></li>
     		<li>Month : <span class="text-primary">{{$code_check->month}}</span></li>
     		<li>Date : <span class="text-primary">{{$code_check->date}}</span></li>
                         	</ul>
 						</div>

                     </div>
                 </div>

             </div>
         </div>


@endsection
