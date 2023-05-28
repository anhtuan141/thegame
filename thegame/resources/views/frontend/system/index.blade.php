@extends('frontend.layout')

@section('title')
THE GAME
@endsection

@section('content')
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="slider-area">
                    <!-- Slider -->
                    <div class="block-slider block-slider4">
                        <ul class="" id="bxslider-home4">
                            @foreach ($collection8 as $item)
                            <li>
                                <div class="hero__item set-bg" data-setbg="{{ $item->imgshare }}">
                                    <div class="hero__text">
                                        <span>PRE-ORDER NOW</span>
                                        <h2>{{$item->namepre}}<br>
                                        {{$item->nameprelast}}</h2>
                                        <p>ON SALE WORLDWIDE <br>
                                            {{$item->release_day}}</p>
                                        <a href="{{route('f.prodetail',$item->alias)}}" class="primary-btn">PRE-ORDER</a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- ./Slider -->
                </div> <!-- End slider area -->
            </div>
        </div>
    </div>
</section>
<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>HOT</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach ($collection as $item)
                <div class="col-lg-3">
                    <div class="featured__item">
                        <div class=" featured__item__pic categories__item set-bg" data-setbg="{{ $item->image }}">
                            <ul class="featured__item__pic__hover">
                                <li><form action="{{route('f.wishlist_create',$item->id)}}" method="POST">@csrf<button><i class="fa fa-heart"></i></button></form></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><button data-href="{{route('f.aj.addcart',$item->id)}}" class="addtocart"><i class="fa fa-shopping-cart"></i></button></li>
                            </ul>
                        </div>
                        <div class="featured__item__text ">
                            <h6><a href="{{route('f.prodetail',$item->alias)}}">{{$item->name}}</a></h6>
                            <h5>${{$item->price}}.00</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>GAME</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        <li data-filter=".ps5">Playstation 5</li>
                        <li data-filter=".ps4">Playstation 4</li>
                        <li data-filter=".switch">Nintendo Switch</li>
                        <li data-filter=".xbox">Xbox</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            @foreach ($collection1 as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mix {{$item->platforms}}">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{ $item->image }}">
                        <ul class="featured__item__pic__hover">
                            <li><form action="{{route('f.wishlist_create',$item->id)}}" method="POST">@csrf<button><i class="fa fa-heart"></i></button></form></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><button data-href="{{route('f.aj.addcart',$item->id)}}" class="addtocart"><i class="fa fa-shopping-cart"></i></button></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="{{route('f.prodetail',$item->alias)}}">{{$item->name}}</a></h6>
                        <h5>${{$item->price}}.00</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Console Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>CONSOLE</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach ($collection2 as $item)
                <div class="col-lg-3">
                    <div class="featured__item">
                        <div class=" featured__item__pic categories__item set-bg" data-setbg="{{ $item->image }}">
                            <ul class="featured__item__pic__hover">
                                <li><form action="{{route('f.wishlist_create',$item->id)}}" method="POST">@csrf<button><i class="fa fa-heart"></i></button></form></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><button data-href="{{route('f.aj.addcart',$item->id)}}" class="addtocart"><i class="fa fa-shopping-cart"></i></button></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="{{route('f.prodetail',$item->alias)}}">{{$item->name}}</a></h6>
                            <h5>${{$item->price}}.00</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Console Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4><a href="#">Coming Soon</a></h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @foreach ($collection4 as $item)
                            <a href="{{route('f.prodetail',$item->alias)}}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ $item->image }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{$item->name}}</h6>
                                    <span>${{$item->price}}.00</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4><a href="#">Top Rated</a></h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @foreach ($collection5 as $item)
                            <a href="{{route('f.prodetail',$item->alias)}}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ $item->image }}" alt="" style="width:110px;height:110px;">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{$item->name}}</h6>
                                    <span>${{$item->price}}.00</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Sale Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @foreach ($collection6 as $item)
                            <a href="{{route('f.prodetail',$item->alias)}}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ $item->image }}" alt="" style="width:110px;height:110px;">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{$item->name}}</h6>
                                    <span>${{$item->price}}.00</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->

<!-- Blog Section Begin -->
<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($collection7 as $item)
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{ $item->image }}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> {{ $item->updated_at }}</li>
                            <li><i class="fa fa-comment-o"></i> {{$item->comment}}</li>
                        </ul>
                        <h5><a href="{{route('f.blogdetail',$item->id)}}">{{$item->name}}</a></h5>
                        <p>{{Str::words($item->summary, 40, ' ...')}}</p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- Blog Section End -->
@endsection

@push('jscustom')
@include('frontend.widgets.js')
@endpush
