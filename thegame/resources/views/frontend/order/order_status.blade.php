@extends('frontend.layout')

@section('title')
Your Cart
@endsection

@section('content')
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb1.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Your Order</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('f.home')}}">Home</a>
                        <span>Your Order</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Order Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Code</th>
                                <th>Order Date</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th>Address Ship</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                            <tr>
                                <td class="shoping__cart__price text-left">
                                    <a class="mr-2" href="{{route('f.order_detail',$item->id)}}"><i class="fa fa-eye"></i></a>
                                    {{$item->code}}
                                </td>
                                <td class="shoping__cart__price">
                                    {{$item->order_date}}
                                </td>
                                <td class="shoping__cart__price">
                                    {{$item->note}}
                                </td>
                                <td class="shoping__cart__price">
                                    @if ($item->order_status == 1)
                                        <span class="badge badge-primary">New</span>
                                     @elseif ($item->order_status == 2)
                                        <span class="badge badge-primary">Confirm</span>
                                     @elseif ($item->order_status == 3)
                                       <span class="badge badge-primary">Packing</span>
                                     @elseif  ($item->order_status == 4)
                                       <span class="badge badge-primary">Shipping</span>
                                     @elseif  ($item->order_status == 5)
                                       <span class="badge badge-success">Success</span>
                                     @elseif  ($item->order_status == 6)
                                        <span class="badge badge-primary">Fail</span>
                                     @else
                                        <span class="badge badge-danger">Cancel</span>
                                    @endif
                                </td>

                                <td class="shoping__cart__price">
                                    {{$item->address_ship}}
                                </td>
                                <td class="shoping__cart__total">
                                    ${{$item->total}}.00
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$list->links()}}
            </div>
        </div>
    </div>
</section>
<!-- Order Cart Section End -->
@endsection

@push('jscustom')
@include('frontend.widgets.js')
@endpush
