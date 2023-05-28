@extends('backend.layout')

@section('title')
Customer Order
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Customer: {{$cus->name}}</h1>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('b.home')}}"><i class="fas fa-fw fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="{{route('customers.index')}}">List</a></li>
        <li class="breadcrumb-item">Order: {{$cus->name}}</li>
    </ul>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
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
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">{{count($collection)}} Orders</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order Code</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Order Status</th>
                            <th>Order Date</th>
                            <th>Address Ship</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Order Code</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Order Status</th>
                            <th>Order Date</th>
                            <th>Address Ship</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($collection as $item)
                        <tr>
                            <td>{{ $item->order_code }}</td>
                            <td>{{ $item->prod_name }}</td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td>${{ $item->prod_price }}.00</td>
                            <td class="text-center">
                                @if ( $item->order_status == 1 )
                                <span class="badge badge-primary">New</span>
                                @elseif ($item->order_status == 2 )
                                <span class="badge badge-primary">Confirm</span>
                                @elseif ($item->order_status == 3 )
                                <span class="badge badge-primary">Packing</span>
                                @elseif ($item->order_status == 4 )
                                <span class="badge badge-primary">Shipping</span>
                                @elseif ($item->order_status == 5 )
                                <span class="badge badge-success">Success</span>
                                @elseif ($item->order_status == 6 )
                                <span class="badge badge-primary">Fail</span>
                                @else
                                <span class="badge badge-danger">Cancel</span>
                                @endif
                            </td>
                            <td>{{ $item->order_date }}</td>
                            <td>{{ $item->order_address }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                <a name="" id="" class="btn btn-secondary btn-md" href="{{ route('customers.index') }}"
                    role="button">Back
                    to list</a>
            </div>
        </div>
    </div>

</div>
@endsection

@push('jscustom')
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('backend/asset/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/asset/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('backend/asset/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('backend/asset/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{ asset('backend/asset/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('backend/asset/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('backend/asset/js/demo/datatables-demo.js')}}"></script>
@endpush
