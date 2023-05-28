@extends('frontend.layout')

@section('title')
All Product
@endsection

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb1.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shop</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('f.home')}}">Home</a>
                        <span>All</span>
                        <h5 class="m-0 font-weight-bold text-primary">{{count($all)}} Items</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="row">
                    @foreach ($collection as $item)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{{$item->image}}}">
                                <ul class="product__item__pic__hover">
                                    <li><form action="{{route('f.wishlist_create',$item->id)}}" method="POST">@csrf<button><i class="fa fa-heart"></i></button></form></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><button data-href="{{route('f.aj.addcart',$item->id)}}" class="addtocart"><i class="fa fa-shopping-cart"></i></button></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{route('f.prodetail',$item->alias)}}">{{$item->name}}</a></h6>
                                <h5>${{$item->price}}.00</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                    {{$collection->links()}}
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->
@endsection

@push('jscustom')
@include('frontend.widgets.js')
@endpush
