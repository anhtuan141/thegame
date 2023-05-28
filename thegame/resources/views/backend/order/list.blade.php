@extends('backend.layout')

@section('title')
Order List
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Order</h1>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('b.home')}}"><i class="fas fa-fw fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item">List</li>
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
        <div class="card-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item mr-2" role="presentation">
                    <button class="nav-link active" id="pills-new-tab" data-toggle="pill" data-target="#pills-new"
                        type="button" role="tab" aria-controls="pills-new" aria-selected="true">New</button>
                </li>
                <li class="nav-item mr-2" role="presentation">
                    <button class="nav-link" id="pills-confirm-tab" data-toggle="pill" data-target="#pills-confirm"
                        type="button" role="tab" aria-controls="pills-confirm" aria-selected="false">Confirm</button>
                </li>
                <li class="nav-item mr-2" role="presentation">
                    <button class="nav-link" id="pills-packing-tab" data-toggle="pill" data-target="#pills-packing"
                        type="button" role="tab" aria-controls="pills-packing" aria-selected="false">Packing</button>
                </li>
                <li class="nav-item mr-2" role="presentation">
                    <button class="nav-link" id="pills-shipping-tab" data-toggle="pill" data-target="#pills-shipping"
                        type="button" role="tab" aria-controls="pills-shipping" aria-selected="false">Shipping</button>
                </li>
                <li class="nav-item mr-2" role="presentation">
                    <button class="nav-link" id="pills-success-tab" data-toggle="pill" data-target="#pills-success"
                        type="button" role="tab" aria-controls="pills-success" aria-selected="false">Success</button>
                </li>
                <li class="nav-item mr-2" role="presentation">
                    <button class="nav-link" id="pills-fail-tab" data-toggle="pill" data-target="#pills-fail"
                        type="button" role="tab" aria-controls="pills-fail" aria-selected="false">Fail</button>
                </li>
                <li class="nav-item mr-2" role="presentation">
                    <button class="nav-link" id="pills-cancle-tab" data-toggle="pill" data-target="#pills-cancle"
                        type="button" role="tab" aria-controls="pills-cancle" aria-selected="false">Cancle</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-new" role="tabpanel" aria-labelledby="pills-new-tab">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">{{ count($new) }} Orders</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>SusTotal</th>
                                    <th>Order_Status</th>
                                    <th>Payment</th>
                                    <th>Shipping</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>SusTotal</th>
                                    <th>Order_Status</th>
                                    <th>Payment</th>
                                    <th>Shipping</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($new as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->cusname }}</td>
                                    <td>{{ $item->order_date }}</td>
                                    <td>${{ $item->total }}.00</td>
                                    <td>${{ $item->sustotal }}.00</td>
                                    <td class="text-center">
                                        <span class="badge badge-primary">New</span>

                                    </td>
                                    <td>{{ $item->payment }}</td>
                                    <td>{{ $item->shipping }}</td>
                                    <td class="text-center"><a name="" id="" class="btn btn-primary btn-sm"
                                            href="{{ route('orders.edit',$item->id) }}" role="button">Update</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-confirm" role="tabpanel" aria-labelledby="pills-confirm-tab">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">{{ count($confirm) }} Orders</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>SusTotal</th>
                                    <th>Order_Status</th>
                                    <th>Payment</th>
                                    <th>Shipping</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>SusTotal</th>
                                    <th>Order_Status</th>
                                    <th>Payment</th>
                                    <th>Shipping</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($confirm as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->cusname }}</td>
                                    <td>{{ $item->order_date }}</td>
                                    <td>${{ $item->total }}.00</td>
                                    <td>${{ $item->sustotal }}.00</td>
                                    <td class="text-center">
                                        <span class="badge badge-primary">Confirm</span>

                                    </td>
                                    <td>{{ $item->payment }}</td>
                                    <td>{{ $item->shipping }}</td>
                                    <td class="text-center">
                                        <a name="" id="" class="btn btn-primary btn-sm"
                                            href="{{ route('orders.edit',$item->id) }}" role="button">Update</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-packing" role="tabpanel" aria-labelledby="pills-packing-tab">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">{{ count($packing) }} Orders</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>SusTotal</th>
                                    <th>Order_Status</th>
                                    <th>Payment</th>
                                    <th>Shipping</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>SusTotal</th>
                                    <th>Order_Status</th>
                                    <th>Payment</th>
                                    <th>Shipping</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($packing as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->cusname }}</td>
                                    <td>{{ $item->order_date }}</td>
                                    <td>${{ $item->total }}.00</td>
                                    <td>${{ $item->sustotal }}.00</td>
                                    <td class="text-center">
                                        <span class="badge badge-primary">packing</span>

                                    </td>
                                    <td>{{ $item->payment }}</td>
                                    <td>{{ $item->shipping }}</td>
                                    <td class="text-center">
                                        <a name="" id="" class="btn btn-primary btn-sm"
                                            href="{{ route('orders.edit',$item->id) }}" role="button">Update</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-shipping" role="tabpanel" aria-labelledby="pills-shipping-tab">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">{{ count($shipping) }} Orders</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>SusTotal</th>
                                    <th>Order_Status</th>
                                    <th>Payment</th>
                                    <th>Shipping</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>SusTotal</th>
                                    <th>Order_Status</th>
                                    <th>Payment</th>
                                    <th>Shipping</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($shipping as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->cusname }}</td>
                                    <td>{{ $item->order_date }}</td>
                                    <td>${{ $item->total }}.00</td>
                                    <td>${{ $item->sustotal }}.00</td>
                                    <td class="text-center">
                                        <span class="badge badge-primary">Shipping</span>

                                    </td>
                                    <td>{{ $item->payment }}</td>
                                    <td>{{ $item->shipping }}</td>
                                    <td class="text-center">
                                        <a name="" id="" class="btn btn-primary btn-sm"
                                            href="{{ route('orders.edit',$item->id) }}" role="button">Update</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-success" role="tabpanel" aria-labelledby="pills-success-tab">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">{{ count($success) }} Orders</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>SusTotal</th>
                                    <th>Order_Status</th>
                                    <th>Payment</th>
                                    <th>Shipping</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>SusTotal</th>
                                    <th>Order_Status</th>
                                    <th>Payment</th>
                                    <th>Shipping</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($success as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->cusname }}</td>
                                    <td>{{ $item->order_date }}</td>
                                    <td>${{ $item->total }}.00</td>
                                    <td>${{ $item->sustotal }}.00</td>
                                    <td class="text-center">
                                        <span class="badge badge-success">Success</span>

                                    </td>
                                    <td>{{ $item->payment }}</td>
                                    <td>{{ $item->shipping }}</td>
                                    <td class="text-center">
                                        <a name="" id="" class="btn btn-primary btn-sm"
                                            href="{{ route('orders.edit',$item->id) }}" role="button">Update</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-fail" role="tabpanel" aria-labelledby="pills-fail-tab">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">{{ count($fail) }} Orders</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>SusTotal</th>
                                    <th>Order_Status</th>
                                    <th>Payment</th>
                                    <th>Shipping</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>SusTotal</th>
                                    <th>Order_Status</th>
                                    <th>Payment</th>
                                    <th>Shipping</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($fail as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->cusname }}</td>
                                    <td>{{ $item->order_date }}</td>
                                    <td>${{ $item->total }}.00</td>
                                    <td>${{ $item->sustotal }}.00</td>
                                    <td class="text-center">
                                        <span class="badge badge-danger">Fail</span>

                                    </td>
                                    <td>{{ $item->payment }}</td>
                                    <td>{{ $item->shipping }}</td>
                                    <td class="text-center">
                                        <a name="" id="" class="btn btn-primary btn-sm"
                                            href="{{ route('orders.edit',$item->id) }}" role="button">Update</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-cancle" role="tabpanel" aria-labelledby="pills-cancle-tab">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">{{ count($cancle) }} Orders</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>SusTotal</th>
                                    <th>Order_Status</th>
                                    <th>Payment</th>
                                    <th>Shipping</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>SusTotal</th>
                                    <th>Order_Status</th>
                                    <th>Payment</th>
                                    <th>Shipping</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($cancle as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->cusname }}</td>
                                    <td>{{ $item->order_date }}</td>
                                    <td>${{ $item->total }}.00</td>
                                    <td>${{ $item->sustotal }}.00</td>
                                    <td class="text-center">
                                        <span class="badge badge-danger">Cancle</span>

                                    </td>
                                    <td>{{ $item->payment }}</td>
                                    <td>{{ $item->shipping }}</td>
                                    <td class="text-center">
                                        <a name="" id="" class="btn btn-primary btn-sm"
                                            href="{{ route('orders.edit',$item->id) }}" role="button">Update</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
