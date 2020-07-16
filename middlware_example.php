<?php


class Admin
{

    public function handle($request, Closure $next)
    {
       if(Auth::check() && Auth::user()->role_id == 1){
         return $next($request);
       }

        return redirect()->route('customer.dashboard');

    }

}


class Editor
{

    public function handle($request, Closure $next)
    {
      if(Auth::check() && Auth::user()->role_id <= 2){
        return $next($request);
      }

       return redirect()->route('customer.dashboard');
    }
}



class Customer
{
    public function handle($request, Closure $next)
    {

      if(Auth::check() && Auth::user()->role_id == 3){
        return $next($request);
      }

      return redirect()->route('admin.index');

    }
}
