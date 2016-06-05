<!DOCTYPE html>
<html lang="pt-br">
    <head>
       @include('layout/_head')

       @yield('styles')
    </head>
    <body>
        @yield('body')

        @include('layout/_scripts')

        @yield('scripts')
    </body>
</html>