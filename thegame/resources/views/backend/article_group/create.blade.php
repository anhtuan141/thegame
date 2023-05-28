@extends('backend.layout')

@section('title')
Create Category Article
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create Category Article</h1>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('b.home')}}"><i class="fas fa-fw fa-tachometer-alt"></i></a></li>
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
            <form method="POST" action="{{ route('articlegroups.store') }}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" value="{{old('name','')}}" id="name" onkeyup="stralias('name','alias')"
                        class="form-control" required name="name" aria-describedby="emailHelp">
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Alias</label>
                    <input type="text" value="{{old('alias','')}}" name="alias" id="alias" class="form-control" placeholder="" aria-describedby="helpId">
                    @error('alias')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Parent ID</label>
                    <input type="text" id="parent_id" class="form-control" required name="parent_id" aria-describedby="emailHelp">
                    @error('parent_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <a name="" id="" class="btn btn-secondary btn-md" href="{{ route('b.home') }}" role="button">Back to
                    home</a>
                <button type="submit" class="btn btn-primary">Create</button>
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
