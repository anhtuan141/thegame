@extends('frontend.layout')

@section('title')
{{$collection->name}}
@endsection

@section('content')
<!-- Blog Details Hero Begin -->
<section class="blog-details-hero set-bg" data-setbg="{{ asset('frontend/img/breadcrumb1.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog__details__hero__text">
                    <h2>{{$collection->name}}</h2>
                    <ul>
                        <li>{{$collection->updated_at}}</li>
                        <li>{{$collection->comment}} Comments</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 order-md-1 order-2">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <form action="{{ route('f.search') }}" method="get">
                            <input type="text" placeholder="Search..." name="search">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="blog__sidebar__item col-lg-3">
                        <h4>Categories</h4>
                        <ul>
                            @foreach ($collection3 as $item)
                            @if ($item->parent_id==0)
                            <div class="btn-group dropright mb-3">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">
                                    {{$item->name}}
                                </button>
                                <div class="dropdown-menu">
                                    @foreach ($item->children as $childs)
                                    <li><a class="dropdown-item mb-3" href="{{route('f.cate_pro',$childs->id)}}">{{$childs->name}}</a>
                                    </li>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Recent News</h4>
                        <div class="blog__sidebar__recent">
                            @foreach ($news as $item)
                            <a href="{{route('f.blogdetail',$item->id)}}" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="{{$item->image}}" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>{{$item->name}}</h6>
                                    <span>{{$item->updated_at}}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Search By</h4>
                        <div class="blog__sidebar__item__tags">
                            <a href="#">Apple</a>
                            <a href="#">Beauty</a>
                            <a href="#">Vegetables</a>
                            <a href="#">Fruit</a>
                            <a href="#">Healthy Food</a>
                            <a href="#">Lifestyle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
                <div class="blog__details__text">
                    <img src="{{$collection->image}}" alt="">
                    <p>{{$collection->content}}</p>
                </div>
                <div class="blog__details__content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="blog__details__author">
                                <div class="blog__details__author__pic">
                                    <img src="{{ asset('frontend/img/no_avt.png') }}" alt="">
                                </div>
                                <div class="blog__details__author__text">
                                    <h6>Michael Scofield</h6>
                                    <span>Admin</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="blog__details__widget">
                                <ul>
                                    <li><span>Categories:</span> Food</li>
                                    <li><span>Tags:</span> All, Trending, Cooking, Healthy Food, Life Style</li>
                                </ul>
                                <div class="blog__details__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->

<!-- Related Blog Section Begin -->
<section class @endsection @push('jscustom') @include('frontend.widgets.js') @endpush
