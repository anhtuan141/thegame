@extends('frontend.layout')

@section('title')
Your Cart
@endsection

@section('content')
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb1.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Your Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('f.home')}}">Home</a>
                        <span>Your Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    @if (session('msg'))
    <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ session('msg') }}</strong>
    </div>

    <script>
        $(".alert").alert();
    </script>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <!-- Check List Existing -->
                    @if (!$list)
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <h3>Shopping Cart Empty</h3>
                                    <div class="col-lg-12">
                                        <div class="shoping__cart__btns mt-5">
                                            <a href="{{ route('f.home') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- List Existing -->
                    @else
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                            @php
                            $amount = $item['price'] * $item['buyqty'] ;
                            $total += $amount;
                            @endphp
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="{{ $item['image'] }}" alt="">
                                    <h5>{{ $item['name'] }}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    ${{ $item['price'] }}.00
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input data-old="{{ $item['buyqty'] }}" data-id="{{ $item['id'] }}"
                                                data-href="{{ route('f.aj.updatecart',$item['id']) }}" class="qtyorder"
                                                type="number" name="cartqtybutton[{{ $item['id'] }}]"
                                                value="{{$item['buyqty']}}">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total" id="amount-{{$item['id']}}">
                                    {{ '$'. number_format($amount,2)}}
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a data-id="{{$item['id']}}" data-href="{{ route('f.aj.delcart',$item['id']) }}" class="delitem"><span class="icon_close"></span></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{route('f.home')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    <button data-href="{{ route('f.aj.delallcart') }}"
                        class="primary-btn cart-btn cart-btn-right clearcart">
                        Clear Cart</button>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Subtotal <span id="subtotal">{{ '$'. number_format($total,2) }}</span></li>
                        <li>Total <span id="total">{{ '$'. number_format($total,2) }}</span></li>
                    </ul>
                    <a href="{{route('f.checkout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
<!-- Shoping Cart Section End -->
@endsection

@push('jscustom')
@include('frontend.widgets.js')
@endpush
