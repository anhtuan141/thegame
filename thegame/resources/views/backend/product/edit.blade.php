@extends('backend.layout')

@section('title')
Update Product
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Update Product</h1>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('b.home') }}"><i class="fas fa-fw fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href=" route('products.index') ">List</a></li>
        <li class="breadcrumb-item">Update for
                <strong>{{ $prod->name }}</strong></li>
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
            <form method="POST" action="{{route('products.update',$prod->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" value="{{ $prod->name }}" id="name" onkeyup="stralias('name','alias')"
                        class="form-control" required name="name" aria-describedby="emailHelp">
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Alias</label>
                    <input type="text" value="{{ $prod->alias }}" name="alias" id="alias" class="form-control"
                        placeholder="" aria-describedby="helpId">
                    @error('alias')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <img width="100" src="{{ $prod->image }}" alt=""/>
                    <input type="text" value="" name="image" id="image" class="form-control"
                        placeholder="" aria-describedby="helpId">
                    <button type="button" onclick="openfile('image')">Choose File</button>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Supplier</label>
                    <select type="text" class="form-control" name="supplier">
                        <option value="21" {{ $prod->supplier_id == 21 ? 'selected' : '' }}>N/A</option>
                        <option value="1" {{ $prod->supplier_id == 1 ? 'selected' : '' }}>Sony Interactive Entertainment
                        </option>
                        <option value="2" {{ $prod->supplier_id == 2 ? 'selected' : '' }}>Microsoft</option>
                        <option value="3" {{ $prod->supplier_id == 3 ? 'selected' : '' }}>Nintendo</option>
                        <option value="4" {{ $prod->supplier_id == 4 ? 'selected' : '' }}>Blizzard Entertainment
                        </option>
                        <option value="5" {{ $prod->supplier_id == 5 ? 'selected' : '' }}>Electronic Arts Inc.</option>
                        <option value="6" {{ $prod->supplier_id == 6 ? 'selected' : '' }}>Take-Two Interactive</option>
                        <option value="7" {{ $prod->supplier_id == 7 ? 'selected' : '' }}>Ubisoft</option>
                        <option value="8" {{ $prod->supplier_id == 8 ? 'selected' : '' }}>Square Enix</option>
                        <option value="9" {{ $prod->supplier_id == 9 ? 'selected' : '' }}>Capcom</option>
                        <option value="10" {{ $prod->supplier_id == 10 ? 'selected' : '' }}>Rockstar Games</option>
                        <option value="11" {{ $prod->supplier_id == 11 ? 'selected' : '' }}>CD PROJEKT RED</option>
                        <option value="12" {{ $prod->supplier_id == 12 ? 'selected' : '' }}>Naughty Dog</option>
                        <option value="13" {{ $prod->supplier_id == 13 ? 'selected' : '' }}>Bethesda Softworks</option>
                    </select>
                    @error('supplier')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category</label>
                    <select type="text" class="form-control" name="category">
                        <option value="5" {{ $prod->category_id == 5 ? 'selected' : '' }}>PS5 Console</option>
                        <option value="6" {{ $prod->category_id == 6 ? 'selected' : '' }}>PS5 Game</option>
                        <option value="7" {{ $prod->category_id == 7 ? 'selected' : '' }}>PS5 Game Comming</option>
                        <option value="8" {{ $prod->category_id == 8 ? 'selected' : '' }}>PS5 Game 2nd</option>
                        <option value="9" {{ $prod->category_id == 9 ? 'selected' : '' }}>PS4 Console</option>
                        <option value="10" {{ $prod->category_id == 10 ? 'selected' : '' }}>PS4 Game</option>
                        <option value="11" {{ $prod->category_id == 11 ? 'selected' : '' }}>PS4 Game 2nd</option>
                        <option value="12" {{ $prod->category_id == 12 ? 'selected' : '' }}>Xbox Series X|S Console
                        </option>
                        <option value="13" {{ $prod->category_id == 13 ? 'selected' : '' }}>Xbox Series Game</option>
                        <option value="14" {{ $prod->category_id == 14 ? 'selected' : '' }}>Xbox Series Game 2nd
                        </option>
                        <option value="15" {{ $prod->category_id == 15 ? 'selected' : '' }}>Nintendo Switch OLED
                        </option>
                        <option value="16" {{ $prod->category_id == 16 ? 'selected' : '' }}>Nintendo Switch Lite
                        </option>
                        <option value="17" {{ $prod->category_id == 17 ? 'selected' : '' }}>Nintendo Switch Used
                        </option>
                        <option value="18" {{ $prod->category_id == 18 ? 'selected' : '' }}>Nintendo Switch Lite
                        </option>
                        <option value="19" {{ $prod->category_id == 19 ? 'selected' : '' }}>Nintendo Switch Lite
                        </option>
                    </select>
                    @error('category')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Platforms</label>
                    <select type="text" class="form-control" name="platforms">
                        <option value="ps5" {{ $prod->platforms == 'ps5' ? 'selected' : '' }}>Playstation 5</option>
                        <option value="ps5_console" {{ $prod->platforms == 'ps5_console' ? 'selected' : ''
                            }}>Playstation 5 Console</option>
                        <option value="ps4" {{ $prod->platforms == 'ps4' ? 'selected' : '' }}>Playstation 4</option>
                        <option value="ps4_console" {{ $prod->platforms == 'ps4_console' ? 'selected' : ''
                            }}>Playstation 4 Console</option>
                        <option value="switch" {{ $prod->platforms == 'switch' ? 'selected' : '' }}>Nintendo Switch
                        </option>
                        <option value="switch_console" {{ $prod->platforms == 'switch_console' ? 'selected' : ''
                            }}>Nintendo Switch Console</option>
                        <option value="xbox" {{ $prod->platforms == 'xbox' ? 'selected' : '' }}>Xbox Series X|S</option>
                        <option value="xbox_console" {{ $prod->platforms == 'xbox_console' ? 'selected' : '' }}>Xbox
                            Series X|S Console</option>
                    </select>
                    @error('platforms')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Kind</label>
                    <select type="text" class="form-control" name="kind">
                        <option value="game" {{ $prod->kind == 'game' ? 'selected' : '' }}>Game</option>
                        <option value="console" {{ $prod->kind == 'console' ? 'selected' : '' }}>Console</option>
                    </select>
                    @error('add_kind')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="text" value="{{ $prod->price }}" class="form-control" required name="price"
                        aria-describedby="emailHelp">
                    @error('price')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Qty</label>
                    <input type="text" value="{{ $prod->qty  }}" class="form-control" required name="qty"
                        id="exampleInputPassword1">
                    @error('qty')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea type="text" name="description" id="description" class="form-control ckeditor"
                        placeholder="" aria-describedby="helpId">{{ $prod->desc }}</textarea>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="" value="-2" {{
                            $prod->status==-2 ? 'checked' : '' }}>
                        Block
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="" value="1" {{
                            $prod->status==1 ? 'checked' : '' }}>
                        Active
                    </label>
                </div>
                <a name="" id="" class="btn btn-secondary btn-md" href="{{ route('products.index') }}" role="button">Back to
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
