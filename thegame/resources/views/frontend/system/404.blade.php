@extends('frontend.layout')

@section('title')
404
@endsection

@section('content')
<div class="container-fluid">
    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Page Not Found</p>
        <a href="{{route('f.home')}}" style="color:#d63031;font-size:30px;">&larr; Back to Home</a>
    </div>
</div>
@endsection

@push('jscustom')
@include('frontend.widgets.js')
@endpush
