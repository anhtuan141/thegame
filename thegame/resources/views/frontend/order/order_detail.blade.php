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
                    <h2>Order Detail</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('f.home')}}">Home</a>
                        <a href="{{route('f.order_status',auth('frontend')->user()->id)}}">Order Status</a>
                        <span>Order Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Order Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="{{$item->proimg}}" alt="">
                                    {{$item->proname}}
                                </td>
                                <td class="shoping__cart__price">
                                    {{$item->qty}}
                                </td>
                                <td class="shoping__cart__price">
                                    ${{$item->price}}.00
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Order Cart Section End -->
@endsection

@push('jscustom')
@include('frontend.widgets.js')
@endpush
