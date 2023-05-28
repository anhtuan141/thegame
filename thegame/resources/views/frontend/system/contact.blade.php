@extends('frontend.layout')

@section('title')
Contact Us
@endsection

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb1.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Contact Us</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('f.home')}}">Home</a>
                        <span>Contact Us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_phone"></span>
                    <h4>Phone</h4>
                    <p>+01-3-8888-6868</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_pin_alt"></span>
                    <h4>Address</h4>
                    <p>227 Nguyen Van Cu. 5 District, HCM City</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_clock_alt"></span>
                    <h4>Open time</h4>
                    <p>8:00 am to 20:00 pm</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_mail_alt"></span>
                    <h4>Email</h4>
                    <p>thegamegt1409@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<!-- Map Begin -->
<div class="map">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.631042905991!2d106.67968217575205!3d10.762892259441742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f19554afa79%3A0x961af94a35c6f42!2zVHJ1bmcgdMOibSBUaW4gaOG7jWMgdHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBLaG9hIGjhu41jIFThu7Egbmhpw6puLCAyMjcgxJAuIE5ndXnhu4VuIFbEg24gQ-G7qywgUGjGsOG7nW5nIDQsIFF14bqtbiA1LCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1682565889816!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
        height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    <div class="map-inside">
        <i class="icon_pin"></i>
        <div class="inside-widget">
            <h4>The Game</h4>
            <ul>
                <li>Phone: +12-345-6789</li>
                <li>Add: 227 Nguyen Van Cu. 5 District, HCM City</li>
            </ul>
        </div>
    </div>
</div>
<!-- Map End -->

<!-- Contact Form Begin -->
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
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Leave Message</h2>
                </div>
            </div>
        </div>
        <form action="{{route('f.send')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <input type="text" name="name" id="name" placeholder="Your name">
                </div>
                <div class="col-lg-6 col-md-6">
                    <input type="text" name="email" id="email" placeholder="Your Email">
                </div>
                <div class="col-lg-12">
                    <input type="text" name="title" id="title" placeholder="Title">
                </div>
                <div class="col-lg-12 text-center">
                    <textarea name="content" id="content" placeholder="Your message"></textarea>
                    <button type="submit" class="site-btn">SEND MESSAGE</button>
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
