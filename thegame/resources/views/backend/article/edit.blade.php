@extends('backend.layout')

@section('title')
Update Blog
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Update Blog</h1>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('b.home')}}"><i class="fas fa-fw fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="{{route('articles.index')}}">List</a></li>
        <li class="breadcrumb-item">Update</li>
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
            <form method="POST" action="{{ route('articles.update',$blog->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" value="{{ $blog->name }}" id="name" onkeyup="stralias('name','alias')" class="form-control" required name="name" aria-describedby="emailHelp">
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Alias</label>
                    <input type="text" value="{{ $blog->alias }}" name="alias" id="alias" class="form-control" placeholder="" aria-describedby="helpId">
                    @error('alias')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <img width="100" src="{{ $blog->image }}" alt=""/>
                    <input type="text" name="image" id="image" value="" class="form-control" placeholder="" aria-describedby="helpId">
                    <button type="button" onclick="openfile('image')">Choose File</button>
                    @error('image')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category</label>
                    <select type="text" class="form-control" name="category">
                        <option value="6" {{ $blog->grid == 6 ? 'selected' : '' }}>N/A</option>
                        <option value="1" {{ $blog->grid == 1 ? 'selected' : '' }}>PC/CONSOLE</option>
                        <option value="2" {{ $blog->grid == 2 ? 'selected' : '' }}>GAME ONLINE</option>
                        <option value="3" {{ $blog->grid == 3 ? 'selected' : '' }}>GAMING GEAR</option>
                        <option value="4" {{ $blog->grid == 4 ? 'selected' : '' }}>ESPORT</option>
                        <option value="5" {{ $blog->grid == 5 ? 'selected' : '' }}>GAME MOBILE</option>
                    </select>
                    @error('category')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Summary</label>
                    @error('summary')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <textarea type="text" name="summary" id="summary" class="form-control ckeditor" placeholder="" aria-describedby="helpId">{{ $blog->summary }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Content</label>
                    @error('content1')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <textarea type="text" name="content1" id="content1" class="form-control ckeditor" placeholder="" aria-describedby="helpId">{{ $blog->content }}</textarea>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="" value="-2" {{
                            $blog->status==-2 ? 'checked' : '' }}>
                        Block
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="" value="1" {{
                            $blog->status==1 ? 'checked' : '' }}>
                        Active
                    </label>
                </div>
                <a name="" id="" class="btn btn-secondary btn-md" href="{{ route('articles.index') }}" role="button">Back to
                    list</a>
                <button type="submit" class="btn btn-primary">Update</button>
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
