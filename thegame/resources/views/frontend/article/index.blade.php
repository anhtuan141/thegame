@extends('frontend.layout')

@section('title')
BLOG
@endsection
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb1.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Blog</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('f.home')}}">Home</a>
                        <span>Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
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
            <div class="col-lg-8 col-md-7">
                <div class="row">
                    @foreach ($collection as $item)
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{$item->image}}" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> {{$item->updated_at}}</li>
                                    <li><i class="fa fa-comment-o"></i> {{$item->comment}}</li>
                                </ul>
                                <h5><a href="{{route('f.blogdetail',$item->id)}}">{{$item->name}}</a></h5>
                                <p>{{Str::words($item->summary, 40, ' ...')}}</p>
                                <a href="{{route('f.blogdetail',$item->id)}}" class="blog__btn">READ MORE <span
                                        class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-12">
                        {{ $collection->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->
@endsection

@push('jscustom')
@include('frontend.widgets.js')
@endpush
