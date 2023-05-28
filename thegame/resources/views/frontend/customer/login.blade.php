@extends('frontend.layout')

@section('title')
Login
@endsection

@section('content')
<div class="container">
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

    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" action="{{route('f.loginpost')}}" method="POST">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" required name="email"
                                            id="email" aria-describedby="emailHelp"
                                            placeholder="Enter Email Address...">
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" required
                                            name="password" id="password" placeholder="Password">
                                        @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="p-0 custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" id="remember" value="1">
                                            <label class="form-check-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    @csrf
                                    <button class="btn btn-primary btn-user btn-block">
                                        Login</button>
                                </form>
                                <hr>
                                <div class="text-center login-cus">
                                    <h4><a class="small" href="forgot-password.html">Forgot Password?</a></h4>
                                </div>
                                <div class="text-center login-cus">
                                    <h4><a class="small" href="{{ route('f.register') }}">Create an Account!</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('jscustom')
@include('frontend.widgets.js')
@endpush
