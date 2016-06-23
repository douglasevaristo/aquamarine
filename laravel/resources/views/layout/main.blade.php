<!DOCTYPE html>
<html lang="pt-br">
    <head>
        @include('layout/_head')

        @yield('styles')
    </head>
    <body>
        @include('layout/_navbar')

        <div class="body">
            @yield('body')
        </div>

        <footer class="footer qypgj-footer">
            <div class="footer-container">
                <div class="footer-content">
                    {{ utils::data_str(null, 'Y, d \d\e m') }}
                    <div class="title">#7FFFD4</div>
                </div>
            </div>
        </footer>

        @include('layout/_scripts')

        @yield('scripts')
    </body>
</html>