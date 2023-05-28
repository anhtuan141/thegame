<!DOCTYPE html>
<html lang="zxx">

@include('frontend.widgets.head')

<body>

    @include('frontend.widgets.header')

    @include('frontend.widgets.nav')

    @yield('content')

    @include('frontend.widgets.footer')

    @stack('jscustom')



</body>

</html>
