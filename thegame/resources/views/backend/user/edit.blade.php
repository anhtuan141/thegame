@extends('backend.layout')

@section('title')
User Information
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Update User</h1>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('b.home') }}"><i class="fas fa-fw fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('b.userlist') }}">List</a></li>
        <li class="breadcrumb-item">Update for
                <strong>{{ $user->name }}</strong> (<strong>{{ $user->username }}</strong>)</li>
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
            <form action="{{ route('b.useredit_update',$user->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="edit_name" value="{{ $user->name }}"
                        aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="">Avatar</label>
                    <img width="100" src="{{ $user->image }}" alt=""/>
                    <input type="text" name="image" id="image" value="" class="form-control" placeholder="" aria-describedby="helpId">
                    <button type="button" onclick="openfile('image')">Choose File</button>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" readonly class="form-control" value="{{ $user->username }}" name=" edit_username"
                        aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Group</label>
                    <select type="text" class="form-control" name="edit_group">
                        <option value="1" {{ $user->grid == 1 ? 'selected' : '' }} >Admin</option>
                        <option value="2" {{ $user->grid == 2 ? 'selected' : '' }} >Purchase User</option>
                        <option value="3" {{ $user->grid == 3 ? 'selected' : '' }} >Warehouse User</option>
                        <option value="4" {{ $user->grid == 4 ? 'selected' : '' }} >User Consultant</option>
                        <option value="5" {{ $user->grid == 5 ? 'selected' : '' }} >User Waiting</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" readonly class="form-control" value="{{ $user->email }}" name=" edit_email"
                        id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="text" class="form-control" value="{{ $user->phone }}" name=" edit_phone"
                        aria-describedby="emailHelp">
                    @error('edit_phone')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="edit_status" id="" value="-2" {{
                            $user->status==-2 ? 'checked' : '' }}>
                        Block
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="edit_status" id="" value="1" {{
                            $user->status==1 ? 'checked' : '' }}>
                        Active
                    </label>
                </div>
                <div>
                    <a name="" id="" class="btn btn-secondary btn-md" href="{{ route('b.userlist') }}"
                        role="button">Back
                        to list</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
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
