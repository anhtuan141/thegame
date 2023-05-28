@extends('frontend.layout')

@section('title')
Profile
@endsection

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb1.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Profile</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('f.home')}}">Home</a>
                        <span>Profile</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Profile Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>{{auth('frontend')->user()->name}}</h2>
                </div>
                <!--Error-->
                @if (session('msg'))
                <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{session('msg')}}</strong>
                </div>

                <script>
                    $(".alert").alert();
                </script>
                @endif
                <!--End Error-->
            </div>
        </div>
        <form action="{{route('f.update_profile',auth('frontend')->user()->id)}}" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <label for="exampleInputEmail1">FullName</label>
                    <input type="text" name="name" placeholder="{{auth('frontend')->user()->name}}">
                </div>
                <div class="col-lg-6 col-md-6">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="text" name="email" readonly placeholder="{{auth('frontend')->user()->email}}">
                </div>
                <div class="col-lg-6 col-md-6">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" name="address" placeholder="{{auth('frontend')->user()->address}}">
                </div>
                <div class="col-lg-6 col-md-6">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="text" name="phone" placeholder="{{auth('frontend')->user()->phone}}">
                </div>
                <div class="col-lg-4 ">
                    <button class="btn btn-md btn-primary btn-user btn-block">
                        Update</button>
                    <button type="reset" class="btn btn-md btn-danger btn-user btn-block">
                        Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Contact Form End -->
@endsection

@push('jscustom')
@include('frontend.widgets.js')
@endpush
