@extends('frontend.layout')

@section('title')
Your Wishlist
@endsection

@section('content')
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb1.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Wishlist</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('f.home')}}">Home</a>
                        <span>Wishlist</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Wishlist Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <!-- Check List Existing -->
                    @if (!count($collection))
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <h3>Wishlist Empty</h3>
                                    <div class="col-lg-12">
                                        <div class="shoping__cart__btns mt-5">
                                            <a href="{{ route('f.home') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collection as $item)
                            <tr>
                                <td class="shoping__cart__item">
                                    <a href="{{route('f.prodetail',$item->proalias)}}"><img src="{{ $item->proimg }}"
                                            alt=""></a>
                                    <a href="{{route('f.prodetail',$item->proalias)}}">
                                        <h5>{{$item->proname}}</h5>
                                    </a>
                                </td>
                                <td class="shoping__cart__price">
                                    ${{$item->proprice}}.00
                                </td>
                                <td class="shoping__cart__item__close">
                                    <form
                                        onclick="return confirm('DO YOU WANT TO REMOVE THIS ITEM FROM YOUR WISHLIST?')"
                                        action="{{route('f.wishlist_delete',$item->product_id)}}" method="POST">@csrf
                                        @method('DELETE')<button><span class="icon_close"></span></button></form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Wishlist Cart Section End -->
@endsection

@push('jscustom')
@include('frontend.widgets.js')
@endpush
