@extends('frontend.layout')

@section('title')
Checkout
@endsection

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb1.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Checkout</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('f.home')}}">Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="{{route('f.shopcart')}}">Click here</a>
                    to enter your code
                </h6>
            </div>
        </div>
        <div class="checkout__form">
            <h4>Billing Details</h4>
            <form action="{{route('f.addorder')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        @if (Auth::guard('frontend')->check())
                        <div class="checkout__input">
                            <p>Full Name<span>*</span></p>
                            <input type="text" name="name" readonly placeholder="{{auth('frontend')->user()->name}}">
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" name="address" readonly placeholder="{{auth('frontend')->user()->address}}"
                                class="checkout__input__add">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text" name="phone" readonly
                                        placeholder="{{auth('frontend')->user()->phone}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" name="email" readonly
                                        placeholder="{{auth('frontend')->user()->email}}">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="diff-acc">
                                Ship to a different address?
                                <input type="checkbox" id="diff-acc"
                                    onchange="if(this.checked){document.getElementById('shipping_section').style.display='block'}else{document.getElementById('shipping_section').style.display='none'}"
                                    name="cus_orther" id="cus_orther" value="1">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        {{--Ship to a different address --}}
                        <div id="shipping_section" style="display:none">
                            <div class="checkout__input">
                                <p>Full Name<span>*</span></p>
                                <input type="text" name="name_dif" value="{{old('name_dif','')}}" placeholder="Full Name">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address_dif" value="{{old('address_dif','')}}" placeholder="Street Address"
                                    class="checkout__input__add">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone_dif" value="{{old('phone_dif','')}}" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email_dif" value="{{old('email_dif','')}}" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="checkout__input">
                            <p>Full Name<span>*</span></p>
                            <input type="text" name="name2" value="{{old('name2','')}}" placeholder="Full Name" required>
                            @error('name2')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" name="address2" value="{{old('address2','')}}" placeholder="Street Address" class="checkout__input__add"
                                required>
                            @error('address2')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text" name="phone2" value="{{old('phone2','')}}" placeholder="Phone" required>
                                    @error('phone2')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="email" name="email2" value="{{old('email2','')}}" placeholder="Email" required>
                                    @error('email2')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="checkout__input">
                            <p>Order notes<span>*</span></p>
                            <input type="text" name="order_note" placeholder="Notes about your order, e.g. special notes for delivery.">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <ul>
                                @foreach ($list as $item)
                                @php
                                $amount = $item['price']* $item['buyqty'] ;
                                $total += $amount;
                                @endphp
                                <li>{{$item['name']}} <span>${{number_format($amount)}}.00</span></li>
                                @endforeach
                            </ul>
                            <div class="checkout__order__subtotal">Subtotal <span>${{number_format($total)}}.00</span>
                            </div>
                            <div class="checkout__order__total">Total <span>${{number_format($total)}}.00</span></div>
                            <div class="checkout__input__checkbox">
                                <label for="payment">
                                    Check Payment
                                    <input type="checkbox" id="payment">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Paypal
                                    <input type="checkbox" id="paypal">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <button type="submit" class="site-btn" name="place_or">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
@endsection

@push('jscustom')
@include('frontend.widgets.js')
@endpush
