@extends('layouts.frontend.app')
@section('title','Stripe Payment')

@push('css')
  <script src="https://js.stripe.com/v3/"></script>

  <style>
  .StripeElement {
box-sizing: border-box;

height: 40px;
width: 50%;
padding: 10px 12px;

border: 1px solid transparent;
border-radius: 4px;
background-color: white;

box-shadow: 0 1px 3px 0 #e6ebf1;
-webkit-transition: box-shadow 150ms ease;
transition: box-shadow 150ms ease;
}

.StripeElement--focus {
box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
border-color: #fa755a;
}

.StripeElement--webkit-autofill {
background-color: #fefde5 !important;
}
  </style>
@endpush

@section('content')

  <!--================Home Banner Area =================-->
  	<section class="banner_area">
  		<div class="banner_inner d-flex align-items-center">
  			<div class="container">
  				<div class="banner_content text-center">
  					<h2>Checkout</h2>
  					<div class="page_link">
  						<a href="index.html">Payement Gateway</a>
  						<a href="cart.html">Stripe</a>
  					</div>
  				</div>
  			</div>
  		</div>
  	</section>
  	<!--================End Home Banner Area =================-->

    <div class="mt-5" style="margin-left:400px;">
      <h4 class="mb-3 text-primary">Stripe Payment (Credit or debit card)</h4>
      <form action="{{route('stripe.charge')}}" method="post" id="payment-form">
        @csrf
      <div class="form-row">
        <label for="card-element">
        </label>
        <div id="card-element">
          <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
      </div>
      @php
          $setting =DB::table('company_details')->first();
          $charge = $setting->shipping_charge;
      @endphp
       {{-- Cart and other data passing --}}
        <input type="hidden" name="shipping_charge" value="{{$charge}}">
        <input type="hidden" name="vat" value="0">
        <input type="hidden" name="payment_type" value="stripe">
        <input type="hidden" name="total" value="{{Cart::Subtotal()+ $charge}}">
      <!-- Shipping data passing on hidden input here -->
        <input type="hidden" name="shipping_name" value="{{$data['shipping_name']}}">
        <input type="hidden" name="shipping_phone" value="{{$data['shipping_phone']}}">
        <input type="hidden" name="shipping_email" value="{{$data['shipping_email']}}">
        <input type="hidden" name="shipping_address" value="{{$data['shipping_address']}}">
        <input type="hidden" name="shipping_country" value="{{$data['shipping_country']}}">
        <input type="hidden" name="order_note" value="{{$data['order_note']}}">

      <button class="btn btn-sm btn-primary mt-2">Submit Payment</button>
    </form>
    </div>


@endsection

@push('js')

<script>
// Create a Stripe client.
var stripe = Stripe('pk_test_CXvM6l2y3bqvTRN4R8gY9adG001p6R8o1y');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
base: {
  color: '#32325d',
  fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
  fontSmoothing: 'antialiased',
  fontSize: '16px',
  '::placeholder': {
    color: '#aab7c4'
  }
},
invalid: {
  color: '#fa755a',
  iconColor: '#fa755a'
}
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
var displayError = document.getElementById('card-errors');
if (event.error) {
  displayError.textContent = event.error.message;
} else {
  displayError.textContent = '';
}
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
event.preventDefault();

stripe.createToken(card).then(function(result) {
  if (result.error) {
    // Inform the user if there was an error.
    var errorElement = document.getElementById('card-errors');
    errorElement.textContent = result.error.message;
  } else {
    // Send the token to your server.
    stripeTokenHandler(result.token);
  }
});
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
// Insert the token ID into the form so it gets submitted to the server
var form = document.getElementById('payment-form');
var hiddenInput = document.createElement('input');
hiddenInput.setAttribute('type', 'hidden');
hiddenInput.setAttribute('name', 'stripeToken');
hiddenInput.setAttribute('value', token.id);
form.appendChild(hiddenInput);

// Submit the form
form.submit();
}
</script>

@endpush
