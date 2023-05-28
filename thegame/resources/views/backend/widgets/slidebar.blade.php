

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('b.home')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">THE GAME</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('b.home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Overview</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->

   @if ($menus->isNotEmpty())
        @foreach ($menus as $menu)
        @php
        $subs = \App\Models\Func::_listmenuforuser($uid,$menu->id);
        @endphp
        <div class="sidebar-heading" style="color: #ecf0f1;">
            {{ $menu->name }}
        </div>
     @if ($subs)
        @foreach ($subs as $sub)
            @php
            $childs = \App\Models\Func::_listmenuforuser($uid,$sub->id)
            @endphp
            @if (!$childs->isNotEmpty())
                 <!-- Nav Item - Tables haven't child -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ $sub->route_name ? route($sub->route_name) : '' }}">
                        {!! $sub->icon !!}
                        <span>{{ $sub->name }}</span></a>
                </li>
            @else
            <!-- Nav Item - Tables have childs -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ $sub->route_name ? route($sub->route_name) : '' }}" data-toggle="collapse"
                    data-target="{{ '#collapseUtilities' . $sub->id }}" aria-expanded="true" aria-controls="collapseUtilities">
                    {!! $sub->icon !!}
                    <span>{{ $sub->name }}</span></a>
                </a>
                <div id="{{ 'collapseUtilities' . $sub->id }}" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @foreach ($childs as $child)
                        <a class="collapse-item" href="{{ $child->route_name ? route($child->route_name) : '' }}">{!! $child->icon !!} {{ $child->name }}</a>
                        @endforeach
                    </div>
                </div>
            </li>
            @endif
        @endforeach
    @endif
@endforeach
    @else
    <div class="sidebar-heading">
        <p>You are not authorized</p>
    </div>
    @endif


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
