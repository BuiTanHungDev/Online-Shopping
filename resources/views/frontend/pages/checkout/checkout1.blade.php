@extends('frontend.layouts.master')

@section('content')
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Checkout</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Checkout Step Area -->
    <div class="checkout_steps_area">
        <a class="complated" href="checkout-1.html"><i class="icofont-check-circled"></i> Login</a>
        <a class="active" href="checkout-2.html"><i class="icofont-check-circled"></i> Billing</a>
        <a href="checkout-3.html"><i class="icofont-check-circled"></i> Shipping</a>
        <a href="checkout-4.html"><i class="icofont-check-circled"></i> Payment</a>
        <a href="checkout-5.html"><i class="icofont-check-circled"></i> Review</a>
    </div>

    <!-- Checkout Area -->
    <div class="checkout_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger" id="alert">
                            <ul>
                                @foreach ($errors->all() as $error )
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="checkout_details_area clearfix">
                        <h5 class="mb-4">Billing Details</h5>
                        <form action="{{ route('checkout1.store') }}" method="post">
                            @csrf
                            <div class="row">

                                @php
                                    if (auth()->check() && isset($user->full_name)) {
                                        $name = explode(' ', $user->full_name);
                                        $first_name = isset($name[0]) ? $name[0] : '';
                                        $last_name = isset($name[1]) ? $name[1] : '';
                                    }
                                @endphp

                                <div class="col-md-6 mb-3">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" placeholder="First Name"
                                        name="first_name" value="{{ $first_name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" placeholder="Last Name"
                                        name="last_name" value="{{ $last_name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email_address">Email Address</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email Address"
                                        name="email" value="{{ isset($user->email) ? $user->email : '' }}" readonly>


                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="number" class="form-control" id="phone" min="0" name="phone"
                                        value="{{ isset($user->phone) ? $user->phone : '' }}">

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" id="country" name="country"
                                        value="{{ isset($user->country) ? $user->country : '' }}"
                                        placeholder="Enter country">

                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="street_address">Street address</label>
                                    <input type="text" class="form-control" id="address" placeholder="Street Address"
                                        value="{{ isset($user->address) ? $user->address : '' }}" name="address">

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="city">Town/City</label>
                                    <input type="text" class="form-control" id="city"
                                        placeholder="Town/City"name="city"
                                        vvalue="{{ isset($user->city) ? $user->city : '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" placeholder="State"
                                        name="state" value="{{ isset($user->state) ? $user->state : '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="postcode">Postcode/Zip</label>
                                    <input type="text" class="form-control" id="postcode" placeholder="Postcode / Zip"
                                        name="postcode" value="{{ isset($user->postcode) ? $user->postcode : '' }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="order-notes">Order Notes</label>
                                    <textarea class="form-control" id="order-notes" cols="30" rows="10" name="note"
                                        placeholder="Notes about your order,  special notes for delivery."></textarea>
                                </div>
                            </div>

                            <!-- Different Shipping Address -->
                            <div class="different-address mt-50">
                                <div class="ship-different-title mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Ship to a same
                                            address?</label>
                                    </div>
                                </div>
                                <div class="row shipping_input_field">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="sfirst_name"
                                            placeholder="First Name" name="sfirst_name" value="{{ $first_name }}"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="slast_name"
                                            placeholder="Last Name" name="slast_name" value="{{ $last_name }}"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email_address">Email Address</label>
                                        <input type="email" class="form-control" id="semail"
                                            placeholder="Email Address" name="semail"
                                            value="{{ isset($user->email) ? $user->email : '' }}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="number" class="form-control" id="sphone" min="0"
                                            placeholder="Enter phone" name="sphone"
                                            value="{{ isset($user->phone) ? $user->phone : '' }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="scountry" name="scountry"
                                            value="{{ isset($user->country) ? $user->country : '' }}"
                                            placeholder="Enter country">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="street_address">Street address</label>
                                        <input type="text" class="form-control" id="saddress"
                                            placeholder="Street Address"
                                            value="{{ isset($user->address) ? $user->address : '' }}" name="saddress">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="city">Town/City</label>
                                        <input type="text" class="form-control" id="scity"
                                            placeholder="Town/City"name="scity"
                                            value="{{ isset($user->city) ? $user->city : '' }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" id="sstate" placeholder="State"
                                            name="sstate" value="{{ isset($user->state) ? $user->state : '' }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="postcode">Postcode/Zip</label>
                                        <input type="text" class="form-control" id="spostcode"
                                            placeholder="Postcode / Zip" name="spostcode"
                                            value="{{ isset($user->postcode) ? $user->postcode : '' }}">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden"name="sub_total"
                                value="{{ number_format((float) \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal()) }}">
                            <input type="hidden"name="total_amount"
                                value="{{ number_format((float) \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal()) }}">

                            <div class="col-12">
                                <div class="checkout_pagination d-flex justify-content-end mt-50">
                                    <a href="{{ route('cart') }}" class="btn btn-primary mt-2 ml-2">Go Back</a>
                                    <button type="submit" class="btn btn-primary mt-2 ml-2">Continue</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Checkout Area -->
@endsection


@section('scripts')
    <script>
        $('#customCheck1').on('change', function(e) {
            e.preventDefault();

            if (this.checked) {
                $('#sfirst_name').val($('#first_name').val());
                $('#slast_name').val($('#last_name').val());
                $('#semail').val($('#email').val());
                $('#sphone').val($('#phone').val());
                $('#scountry').val($('#country').val());
                $('#scity').val($('#city').val());
                $('#spostcode').val($('#postcode').val());
                $('#sstate').val($('#state').val());

                $('#saddress').val($('#address').val());
            } else {
                $('#sfirst_name').val(" ");
                $('#slast_name').val(" ");
                $('#semail').val(" ");
                $('#sphone').val(" ");
                $('#scountry').val(" ");
                $('#scity').val(" ");
                $('#scity').val(" ");
                $('#spostcode').val(" ");
                $('#sstate').val(" ");
                $('#saddress').val(" ");


            }

        });
    </script>
@endsection
