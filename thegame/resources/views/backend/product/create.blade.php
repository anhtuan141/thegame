@extends('backend.layout')

@section('title')
Create Product
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create Product</h1>
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
            <form method="POST" action="{{route('products.store')}}">
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
                    <label for="">Image</label>
                    <img witdh="100"/>
                    <input type="text" name="image" id="image" class="form-control" placeholder="" aria-describedby="helpId">
                    <button type="button" onclick="openfile('image')">Choose File</button>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Supplier</label>
                    <select type="text" class="form-control" name="supplier">
                        <option value="21">N/A</option>
                        <option value="1">Sony Interactive Entertainment</option>
                        <option value="2">Microsoft</option>
                        <option value="3">Nintendo</option>
                        <option value="4">Blizzard Entertainment</option>
                        <option value="5">Electronic Arts Inc.</option>
                        <option value="6">Take-Two Interactive</option>
                        <option value="7">Ubisoft</option>
                        <option value="8">Square Enix</option>
                        <option value="9">Capcom</option>
                        <option value="10">Rockstar Games</option>
                        <option value="11">CD PROJEKT RED</option>
                        <option value="12">Naughty Dog</option>
                        <option value="13">Bethesda Softworks</option>
                    </select>
                    @error('supplier')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category</label>
                    <select type="text" class="form-control" name="category">
                        <option value="5">PS5 Console</option>
                        <option value="6">PS5 Game</option>
                        <option value="7">PS5 Game Comming</option>
                        <option value="8">PS5 Game 2nd</option>
                        <option value="9">PS4 Console</option>
                        <option value="10">PS4 Game</option>
                        <option value="11">PS4 Game 2nd</option>
                        <option value="12">Xbox Series X|S Console</option>
                        <option value="13">Xbox Series Game</option>
                        <option value="14">Xbox Series Game 2nd</option>
                        <option value="15">Nintendo Switch OLED</option>
                        <option value="16">Nintendo Switch Lite</option>
                        <option value="17">Nintendo Switch Used</option>
                        <option value="18">Nintendo Switch Lite</option>
                        <option value="19">Nintendo Switch Lite</option>
                    </select>
                    @error('category')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Platforms</label>
                    <select type="text" class="form-control" name="platforms">
                        <option value="ps5">Playstation 5</option>
                        <option value="ps5_console">Playstation 5 Console</option>
                        <option value="ps4">Playstation 4</option>
                        <option value="ps4_console">Playstation 4 Console</option>
                        <option value="switch">Nintendo Switch</option>
                        <option value="switch_console">Nintendo Switch Console</option>
                        <option value="xbox">Xbox Series X|S</option>
                        <option value="xbox_console">Xbox Series X|S Console</option>
                    </select>
                    @error('platforms')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Kind</label>
                    <select type="text" class="form-control" name="kind">
                        <option value="game">Game</option>
                        <option value="console">Console</option>
                    </select>
                    @error('add_kind')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="text" value="{{old('price','')}}" class="form-control" required name="price"
                        aria-describedby="emailHelp">
                    @error('price')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Qty</label>
                    <input type="text" value="{{old('qty','')}}" class="form-control" required name="qty"
                        id="exampleInputPassword1">
                    @error('qty')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea type="text" name="description" id="description" class="form-control ckeditor" placeholder="" aria-describedby="helpId"></textarea>
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
