<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Catagories</span>
                    </div>
                    <ul>
                        @foreach ($collection3 as $item)
                        @if ($item->parent_id==0)
                        <div class="btn-group btn-block dropright mb-3">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                                {{$item->name}}
                            </button>
                            <div class="dropdown-menu">
                                @foreach ($item->children as $childs)
                                <a class="dropdown-item mb-3" href="{{route('f.cate_pro',$childs->id)}}">{{$childs->name}}</a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="{{ route('f.search') }}" method="get">
                            <input type="text" placeholder="What do you need?" name="search">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
