<?php

  $date = date('d-m-y');
  $month = date('F');
  $year = date('Y');

  $totalProfilt = DB::Table('orders')->where('status',3)->sum('total');
  $todayOrder = DB::Table('orders')->where('date',$date)->sum('total');
  $todayDelevery = DB::Table('orders')->where('date',$date)->where('status',3)->sum('total');
  $thisMonth = DB::Table('orders')->where('month',$month)->sum('total');
  $thisYear = DB::Table('orders')->where('year',$year)->sum('total');

  $product = DB::Table('products')->count();
  $brand = DB::Table('brands')->count();
  $category = DB::Table('categories')->count();
  $admin = DB::Table('users')->whereIn('role_id',[1,2])->count();
  $customer = DB::Table('users')->where('role_id',3)->count();

  $totalPost = App\BlogPost::count();
  $totalSubscriber = App\Subscriber::count();
