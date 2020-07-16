@extends('layouts.frontend.app')
@section('title','Customer Dashboard')


@section('content')

  <!--================Home Banner Area =================-->
  <section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
      <div class="container">
        <div class="banner_content text-center">
          <h2>Dashboard</h2>
          <div class="page_link">
            <a href="index.html">Home</a>
            <a href="index.html">Customer</a>
            <a href="login.html">Dashboard</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Home Banner Area =================-->

  <div class="container">
      <div class="row">
         <div class="col-9 card mt-3">
           <h2 class="text-center py-2 text-dark"><u class="text-dark">Customer Dashboard</u></h2>
           <table class="table table-bordered ">
             <thead class="text-light bg-dark">
               <tr>
                 <th scope="col">SL#</th>
                 <th scope="col">Date</th>
                 <th scope="col">Payment Type</th>
                 <th scope="col">Payment ID</th>
                 <th scope="col">Amount</th>
                  <th scope="col">Tracking Code</th>
                  <th scope="col">Status </th>
               </tr>
             </thead>
             <tbody>
               @foreach($orders as $key=>$order)
               <tr>
                 <td>{{$key+1}}</td>
                 <td>{{$order->created_at}}</td>
                 <td>{{$order->payment_type}}</td>
                 <td>{{$order->payment_id}}</td>
                 <td>${{$order->total}}</td>
                 <td>{{$order->status_code}}</td>
                 <td>
                   @if($order->status == 0)
                   <span class="badge badge-warning">Pending</span>
                  @elseif($order->status == 1)
                   <span class="badge badge-info">Payment Accepted</span>
                  @elseif($order->status == 2)
                 <span class="badge badge-info">Under Progress</span>
                  @elseif($order->status == 3)
                 <span class="badge badge-success">Delevered</span>
                  @else
                 <span class="badge badge-danger">Canceled</span>
                  @endif
                 </td>

               </tr>
             @endforeach
             </tbody>
           </table>
         </div>
         <div class="col-3 mt-3">
           <div class="card" style="width: 18rem;">
            <img src="{{ asset('contents/frontend/avatar.png') }}" class="card-img-top" style="height: 90px; width: 90px; margin-left: 34%;" >
            <div class="card-body">
              <h5 class="card-title text-center">{{Auth::user()->name}}</h5>
            </div>

              <li class="list-group-item"><a href="">Edit Profile</a></li>
              <li class="list-group-item"><a href="#">Return Order</a></li>
              <li class="list-group-item"><a href="#">Change Password</a></li>


            <ul class="list-group list-group-flush">

            </ul>
            <div class="card-body">
              <a href="{{route('customer.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
            </div>
          </div>
         </div>
      </div>
  </div>
</div>


@endsection
