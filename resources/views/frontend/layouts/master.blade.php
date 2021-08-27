<!DOCTYPE html>
<html lang="en">
    @include('frontend.layouts.head')

    <body>
        @include('frontend.layouts.header')
        @yield('content-home')

        @include('frontend.layouts.footer')

    </body>
</html>
