@extends('backend.layout')

@section('title')
    Create New User
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create User</h1>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('b.home') }}"><i class="fas fa-fw fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item">Create</li>
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
            <h5 class="m-0 font-weight-bold text-primary">
        </div>
        <div class="card-body">
            <form action="{{ route('b.createuser_action') }}" method="POST" >
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="add_name" value="{{old('add_name','')}}" aria-describedby="emailHelp">
                    @error('add_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Avatar</label>
                    <img witdh="100"/>
                    <input type="text" name="image" id="image" class="form-control" placeholder="" aria-describedby="helpId">
                    <button type="button" onclick="openfile('image')">Choose File</button>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" required value="{{old('add_username','')}}" name="add_username" aria-describedby="emailHelp">
                    @error('add_username')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" required name="add_password" id="exampleInputPassword1">
                    @error('add_password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" required value="{{old('add_email','')}}" name="add_email" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('add_email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Group</label>
                    <select type="text" class="form-control" name="add_group">
                        <option value="5">User Waiting</option>
                        <option value="1">Admin</option>
                        <option value="2">Purchase User</option>
                        <option value="3">Warehouse User</option>
                        <option value="4">User Consultant</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="text" class="form-control" value="{{old('add_phone','')}}" name="add_phone" aria-describedby="emailHelp">
                    @error('add_phone')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <a name="" id="" class="btn btn-secondary btn-md" href="{{ route('b.home') }}" role="button">Back to
                    home</a>
                <button type="submit" class="btn btn-primary">Sign up</button>
            </form>
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

<!-- CKEditor -->
<script src="{{asset('backend/ckfinder/ckfinder.js')}}"></script>
<script src="{{asset('backend/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('backend/js/myscript.js')}}"></script>
@endpush
