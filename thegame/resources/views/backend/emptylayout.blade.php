<!DOCTYPE html>
<html lang="en">

<head>

    @include('backend.widgets.head')

</head>

<body class="bg-gradient-primary">

    <div class="container">

        @yield('content')

    </div>

    @stack('jscustom')

</body>

</html>
