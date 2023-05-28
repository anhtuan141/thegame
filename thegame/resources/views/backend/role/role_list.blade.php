@extends('backend.layout')
@section('title')
User Permission
@endsection
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Permission for
        <strong>{{$user->name}} (<strong>{{$user->username}}</strong>)</strong>
    </h1>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-fw fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="{{route('roles.index')}}">List</a></li>
        <li class="breadcrumb-item">Permission for
            <strong>{{$user->name}}</strong> (<strong>{{$user->username}}</strong>)
        </li>
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
            <h5>Choose function</h5>
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <ul style="list-style: none;">
                    @foreach ($parentlist as $parent)
                    @php
                    //check child
                    $childs = \App\Models\Func::_listfunction($parent->id);
                    @endphp
                    <li>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="funcs[]" id=""
                                    value="{{ $parent->id }}"
                                    {{ $role->_checked($parent->id,$user->id) ? 'checked' : '' }}>
                                <h5>{{ $parent->name }}</h5>
                            </label>
                        </div>
                        <!--show childs-->
                        @if ($childs->isNotEmpty())
                        <ul style="list-style: none;">
                            @foreach ($childs as $child)
                            @php
                            //check child
                            $child2s = \App\Models\Func::_listfunction($child->id);
                            @endphp
                            <li>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="funcs[]" id=""
                                            value="{{ $child->id }}"
                                            {{ $role->_checked($child->id,$user->id) ? 'checked' : '' }} >
                                        {{ $child->name }}
                                    </label>
                                </div>
                                <!--show child2s-->
                                @if ($child2s->isNotEmpty())
                                <ul style="list-style: none;">
                                    @foreach ($child2s as $child2)
                                    @php
                                    //check child3s
                                    $child3s = \App\Models\Func::_listfunction($child2->id);
                                    @endphp
                                    <li>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="funcs[]" id=""
                                                    value="{{ $child2->id }}" {{$role->_checked($child2->id,$user->id) ? 'checked' : '' }} >
                                                {{ $child2->name }}
                                            </label>
                                        </div>
                                        <!--show child3s-->
                                @if ($child3s->isNotEmpty())
                                <ul style="list-style: none;">
                                    @foreach ($child3s as $child3)
                                    @php
                                    //check child4s
                                    $child4s = \App\Models\Func::_listfunction($child3->id);
                                    @endphp
                                    <li>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="funcs[]" id=""
                                                    value="{{ $child3->id }}" {{$role->_checked($child3->id,$user->id) ? 'checked' : '' }} >
                                                {{ $child3->name }}
                                            </label>
                                        </div>
                                                <!--show child4s-->
                                @if ($child4s->isNotEmpty())
                                <ul style="list-style: none;">
                                    @foreach ($child4s as $child4)
                                    @php
                                    // //check child5s
                                    // $child5s = \App\Models\Func::_listfunction($child4->id);
                                    @endphp
                                    <li>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="funcs[]" id=""
                                                    value="{{ $child4->id }}" {{$role->_checked($child4->id,$user->id) ? 'checked' : '' }} >
                                                {{ $child4->name }}
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
                <div>
                    <a name="" id="" class="btn btn-secondary btn-md" href="{{route('roles.index')}}"
                        role="button">Back to
                        list</a>
                    <input type="hidden" name="user_id" value="{{ $user->id }}" />
                    <button class="btn btn-primary btn-md">Update</button>
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
@endpush
