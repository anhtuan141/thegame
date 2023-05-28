<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="{{ route('f.home') }}"><img src="{{ asset('frontend/img/logo.png') }}" alt=""></a>
    </div>
    @if (Auth::guard('frontend')->check())
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="{{ route('f.wishlist',auth('frontend')->user()->id) }}"><i class="fa fa-heart"></i></a></li>
            <li><a href="{{ route('f.shopcart') }}"><i class="fa fa-shopping-bag"></i>
                    <span class="countcart">{{ count(session('cart',[])) }}</span></a></li>
        </ul>
        <!-- Show Total Price -->
        @if (!session('cart')){
        @php
        $subtotal = 0;
        @endphp
        }
        @else{
        @foreach (session('cart') as $item)
        @php
        $cart = session('cart');
        $subtotal = collect($cart)->sum(function (array $item) {
        return $item['buyqty'] * $item['price'];
        });
        @endphp
        @endforeach
        }
        @endif
        <div class="header__cart__price">item: <span class="subtotal">{{ '$'. $subtotal .'.00' }}</span></div>
    </div>
    @else
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="{{ route('f.shopcart') }}"><i class="fa fa-shopping-bag"></i>
                    <span class="countcart">{{ count(session('cart',[])) }}</span></a></li>
        </ul>
        <!-- Show Total Price -->
        @if (!session('cart')){
        @php
        $subtotal = 0;
        @endphp
        }
        @else{
        @foreach (session('cart') as $item)
        @php
        $cart = session('cart');
        $subtotal = collect($cart)->sum(function (array $item) {
        return $item['buyqty'] * $item['price'];
        });
        @endphp
        @endforeach
        }
        @endif
        <div class="header__cart__price">item: <span class="subtotal">{{ '$'. $subtotal .'.00' }}</span></div>
    </div>
    @endif
    <div class="humberger__menu__widget">
        <div class="header__top__right__language">
            <img src="{{ asset('frontend/img/language.png') }}" alt="">
            <div>English</div>
            <span class="arrow_carrot-down"></span>
            <ul>
                <li><a href="#">Spanis</a></li>
                <li><a href="#">English</a></li>
            </ul>
        </div>
        <div class="header__top__right__auth">
            @if (Auth::guard('frontend')->check())
            <div class="header__top__right__profile">
                <div>{{auth('frontend')->user()->name}}</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="{{route('f.profile',auth('frontend')->user()->id)}}">Profile</a></li>
                    <li><a href="{{route('f.shopcart')}}">Shopping Cart</a></li>
                    <li><a href="{{route('f.order_status',auth('frontend')->user()->id)}}">Order Status</a></li>
                    <li><a href="{{route('f.wishlist',auth('frontend')->user()->id)}}">Wishlist</a></li>
                    <li><a href="{{route('f.logout')}}">Logout</a></li>
                </ul>
            </div>
            @else
            <a href="{{route('f.login')}}"><i class="fa fa-user"></i> Login</a>
            @endif
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="{{ route('f.home') }}">Home</a></li>
            <li><a href="{{route('f.shop')}}">Shop</a></li>
            <li><a href="{{route('f.blog')}}">Blog</a></li>
            <li><a href="{{route('f.contact')}}">Contact</a></li>
            <li><a href="#">Service</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> thegamegt1409@gmail.com</li>
            <li>Free Shipping for all Order of $99</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> thegamegt1409@gmail.com</li>
                            <li>Free Shipping for all Order of $99</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <img src="{{ asset('frontend/img/language.png') }}" alt="">
                            <div>English</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">Vietnamese</a></li>
                                <li><a href="#">English</a></li>
                            </ul>
                        </div>
                        <div class="header__top__right__auth">
                            @if (Auth::guard('frontend')->check())
                            <div class="header__top__right__profile">
                                <div>{{auth('frontend')->user()->name}}</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="{{route('f.profile',auth('frontend')->user()->id)}}">Profile</a></li>
                                    <li><a href="{{route('f.shopcart')}}">Shopping Cart</a></li>
                                    <li><a href="{{route('f.order_status',auth('frontend')->user()->id)}}">Order
                                            Status</a></li>
                                    <li><a href="{{route('f.wishlist',auth('frontend')->user()->id)}}">Wishlist</a></li>
                                    <li><a href="{{route('f.logout')}}">Logout</a></li>
                                </ul>
                            </div>
                            @else
                            <a href="{{route('f.login')}}"><i class="fa fa-user"></i> Login</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ route('f.home') }}"><img src="{{ asset('frontend/img/logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{ route('f.home') }}">Home</a></li>
                        <li><a href="{{route('f.shop')}}">Shop</a></li>
                        <li><a href="{{route('f.blog')}}">Blog</a></li>
                        <li><a href="{{route('f.contact')}}">Contact</a></li>
                        <li><a href="#">Service</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                @if (Auth::guard('frontend')->check())
                <div class="header__cart">
                    <ul>
                        <li><a href="{{route('f.wishlist',auth('frontend')->user()->id)}}"><i
                                    class="fa fa-heart"></i></a></li>
                        <li><a href="{{route('f.shopcart')}}"><i class="fa fa-shopping-bag"></i>
                                <span class="countcart">{{ count(session('cart',[])) }}</span></a>
                        </li>
                    </ul>
                    <div class="header__cart__price">item: <span class="subtotal">{{ '$'. $subtotal .'.00' }}</span></div>
                </div>
                @else
                <div class="header__cart">
                    <ul>
                        <li><a href="{{route('f.shopcart')}}"><i class="fa fa-shopping-bag"></i>
                                <span class="countcart">{{ count(session('cart',[])) }}</span></a>
                        </li>
                    </ul>
                    <div class="header__cart__price">item: <span class="subtotal">{{ '$'. $subtotal .'.00' }}</span></div>
                </div>
                @endif
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
