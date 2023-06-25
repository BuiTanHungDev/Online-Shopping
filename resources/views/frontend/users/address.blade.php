@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>My Account</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- My Account Area -->
    <section class="my-account-area section_padding_100_50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="my-account-navigation mb-50">
                        <ul>
                            <li><a href="my-account.html">Dashboard</a></li>
                            <li><a href="order-list.html">Orders</a></li>
                            <li><a href="downloads.html">Downloads</a></li>
                            <li class="active"><a href="addresses.html">Addresses</a></li>
                            <li><a href="account-details.html">Account Details</a></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="my-account-content mb-50">
                        <p>The following addresses will be used on the checkout page by default.</p>

                        <div class="row">
                            <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                                <h6 class="mb-3">Billing Address</h6>
                                <address>
                                    {{$user->address}} <br>
                                    {{$user->state}} <br>
                                    {{$user->city}} <br>
                                    {{$user->country}}<br>
                                    {{$user->postcode}}
                                
                                </address>
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#editAddress">Edit Address</a>
                                {{-- Modal Edit Address --}}
                                <div class="modal fade" id="editAddress" style="background: rgba(20, 20, 20, 0.5); z-index: 99999999;"
                                    data-backdrop="false" data-keyboard="false" tabindex="-1"
                                    aria-labelledby="exampleModalCenter" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenter">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('billing.address',$user->id)}}" method="post">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="">Address</label>
                                                        <textarea name="address" id=""  class="form-control">{{ $user->address }}</textarea>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Country</label>
                                                        <input value="{{ $user->country }}" name="country"class="form-control"
                                                            id=""></input>


                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Postcode</label>
                                                        <input name="postcode"value="{{ $user->postcode }}" class="form-control"
                                                            id=""></input>


                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">State</label>
                                                        <input value="{{ $user->state }}" name="state"class="form-control"
                                                            id=""></input>


                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">City</label>
                                                        <input value="{{ $user->state }}" name="city" class="form-control"
                                                            id=""></input>


                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <h6 class="mb-3">Shipping Address</h6>
                                <address>
                                    {{$user->saddress}} <br>
                                    {{$user->sstate}} <br>
                                    {{$user->scity}} <br>
                                    {{$user->scountry}}<br>
                                    {{$user->spostcode}}
                                
                                </address>
                                <a href="#" class="btn btn-primary btn-sm"  data-toggle="modal"
                                data-target="#editSAddress">Edit Shipping Address</a>
                                    {{-- Modal Edit Shipping Address --}}
                                <div class="modal fade" id="editSAddress" style="background: rgba(20, 20, 20, 0.5) "
                                data-backdrop="false" data-keyboard="false" tabindex="-1"
                                aria-labelledby="examplaeModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="examplaeModalLongTitle">Edit Shipp Address</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{route('shipping.address', $user->id)}}" method="post">
                                            @csrf
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="">Shipping Address</label>
                                                    <textarea name="saddress" id=""class="form-control"  value="" >{{ $user->saddress }}</textarea>

                                                </div>
                                                <div class="form-group">
                                                    <label for="">Shipping Country</label>
                                                    <input name="scountry"class="form-control"value="{{ $user->scountry }}"
                                                        id=""></input>


                                                </div>
                                                <div class="form-group">
                                                    <label for="">Shipping Postcode</label>
                                                    <input name="spostcode"class="form-control" value="{{ $user->spostcode }}"
                                                        id=""></input>


                                                </div>
                                                <div class="form-group">
                                                    <label for="">Shipping State</label>
                                                    <input name="sstate"class="form-control" value="{{ $user->sstate }}"
                                                        id=""></input>


                                                </div>
                                                <div class="form-group">
                                                    <label for="">Shipping City</label>
                                                    <input name="scity" class="form-control" value="{{ $user->scity }}"
                                                        id=""></input>


                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My Account Area -->
@endsection


@section('head')
   <style>
        .footer_area{
            z-index: -1;
        }
   </style>
@endsection
