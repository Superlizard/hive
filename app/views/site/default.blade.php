<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
            @section('title')
            Administration
            @show
        </title>
        <meta name="token" content="{{ Session::token() }}">
        <meta name="keywords" content="@yield('keywords')" />
        <meta name="author" content="@yield('author')" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <!-- css includes -->
        {{ HTML::style('assets/css/animate.min.css'); }}
        {{ HTML::style('assets/css/style.min.css'); }}
        @yield('styles')
        <!--
              ___         ___         ___         ___                  ___         ___     
             /\__\       /\  \       /\__\       /\__\                /\  \       /\__\    
            /:/  /      /::\  \     /:/ _/_     /:/ _/_     ___       \:\  \     /:/ _/_   
           /:/  /      /:/\:\  \   /:/ /\  \   /:/ /\  \   /\__\       \:\  \   /:/ /\  \  
          /:/  /  ___ /:/ /::\  \ /:/ /::\  \ /:/ /::\  \ /:/__/   ___  \:\  \ /:/ /::\  \ 
         /:/__/  /\__/:/_/:/\:\__/:/_/:/\:\__/:/_/:/\:\__/::\  \  /\  \  \:\__/:/_/:/\:\__\
         \:\  \ /:/  \:\/:/  \/__\:\/:/ /:/  \:\/:/ /:/  \/\:\  \_\:\  \ /:/  \:\/:/ /:/  /
          \:\  /:/  / \::/__/     \::/ /:/  / \::/ /:/  / ~~\:\/\__\:\  /:/  / \::/ /:/  / 
           \:\/:/  /   \:\  \      \/_/:/  /   \/_/:/  /     \::/  /\:\/:/  /   \/_/:/  /  
            \::/  /     \:\__\       /:/  /      /:/  /      /:/  /  \::/  /      /:/  /   
             \/__/       \/__/       \/__/       \/__/       \/__/    \/__/       \/__/      
        -->  
    </head>
    <body>
        <!-- nav -->
        @yield('nav')
        <!-- ./ nav -->

        <!-- content -->
        @yield('content')
        <!-- ./ content -->

        <!-- footer -->
        <footer>
            @yield('footer')
        </footer>
        <!-- ./footer -->

        <!-- js includes -->
        {{ HTML::script('assets/js/vendor/jquery-2.1.1.min.js'); }}
        {{ HTML::script('assets/js/vendor/bootstrap.min.js'); }}
        {{ HTML::script('assets/js/vendor/modernizr.js'); }}

        @yield('scripts')
    </body>
    <!-- ./body -->
</html>
<!-- ./html -->