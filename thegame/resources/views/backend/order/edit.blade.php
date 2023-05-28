@extends('backend.layout')

@section('title')
Order Status
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Order Status Of {{ $collection1->cusname }}-({{ $collection1->cusemail }})</h1>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('b.home') }}"><i class="fas fa-fw fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">List</a></li>
        <li class="breadcrumb-item">Order Status</li>
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
            <h5 class="m-0 font-weight-bold text-primary">Order Code: {{ $collection1->code }} ({{$collection1->cusname}}-{{ $collection1->cusemail }})</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($collection as $item)
                            <tr>
                                <td> {{ $item->proname }}</td>
                                <td> {{ $item->qty }} </td>
                                <td> ${{ $item->price }}.00 </td>
                            </tr>
                       @endforeach
                    </tbody>
                </table>
                <form action="{{ route('orders.update',$collection1->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Address Ship</label>
                        <input type="text" class="form-control"
                        placeholder="{{ $collection1->address_ship }}" readonly aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <select type="text" class="form-control" name="order_status">
                            <option value="1" {{ ($collection1->order_status == 1) ? 'selected' : '' }}>New</option>
                            <option value="2" {{ ($collection1->order_status == 2) ? 'selected' : '' }}>Confirm</option>
                            <option value="3" {{ ($collection1->order_status == 3) ? 'selected' : '' }}>Packing</option>
                            <option value="4" {{ ($collection1->order_status == 4) ? 'selected' : '' }}>Shipping</option>
                            <option value="5" {{ ($collection1->order_status == 5) ? 'selected' : '' }}>Success</option>
                            <option value="6" {{ ($collection1->order_status == 6) ? 'selected' : '' }}>Fail</option>
                            <option value="7" {{ ($collection1->order_status == 7) ? 'selected' : '' }}>Cancel</option>
                        </select>
                    </div>
                    <div>
                        <a name="" id="" class="btn btn-secondary btn-md" href="{{ route('orders.index') }}"
                            role="button">Back
                            to list</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
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
