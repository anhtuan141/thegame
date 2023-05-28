@extends('frontend.layout')

@section('title')
SEARCH
@endsection

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb1.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>SEARCH</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('f.home')}}">Home</a>
                        <span>Search</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">ALL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                aria-selected="false">GAMES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                aria-selected="false">CONSOLES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab"
                                aria-selected="false">BLOGS</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!--Tab ALL-->
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            @foreach ($collection as $item)
                            <div class="product__details__tab__desc">
                                <a href="{{route('f.prodetail',$item->alias)}}"><h6>{{ $item->name }}</h6></a>
                                <p>{{ $item->desc }}</p>
                            </div>
                            @endforeach
                            @foreach ($collection1 as $item)
                            <div class="product__details__tab__desc">
                                <a href="{{route('f.prodetail',$item->alias)}}"><h6>{{ $item->name }}</h6></a>
                                <p>{{ $item->desc }}</p>
                            </div>
                            @endforeach
                            @foreach ($collection2 as $item)
                            <div class="product__details__tab__desc">
                                <a href="{{ route('f.blogdetail',$item->id) }}"><h6>{{ $item->name }}</h6></a>
                                <p>{{ $item->summary }}</p>
                            </div>
                            @endforeach
                        </div>
                        <!--Tab GAMES-->
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            @foreach ($collection as $item)
                            <div class="product__details__tab__desc">
                                <a href="{{route('f.prodetail',$item->alias)}}"><h6>{{ $item->name }}</h6></a>
                                <p>{{ $item->desc }}</p>
                            </div>
                            @endforeach
                            {{$collection->links()}}
                        </div>
                        <!--Tab CONSOLES-->
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            @foreach ($collection1 as $item)
                            <div class="product__details__tab__desc">
                               <a href="{{route('f.prodetail',$item->alias)}}"><h6>{{ $item->name }}</h6></a>
                                <p>{{ $item->desc }}</p>
                            </div>
                            @endforeach
                            {{$collection1->links()}}
                        </div>
                        <!--Tab BLOGS-->
                        <div class="tab-pane" id="tabs-4" role="tabpanel">
                            @foreach ($collection2 as $item)
                            <div class="product__details__tab__desc">
                                <a href="{{ route('f.blogdetail',$item->id) }}">
                                    <h6>{{ $item->name }}</h6>
                                </a>
                                <p>{{ $item->summary }}</p>
                            </div>
                            @endforeach
                            {{$collection2->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->
@endsection

@push('jscustom')
@include('frontend.widgets.js')
@endpush
