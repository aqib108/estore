<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Halqa E Noor</title>
  <!-- Favicon -->
  <link rel="icon" href="{{asset('storage/front/img/core-img/favicon.ico')}}">
  <!-- Style CSS -->
  <link rel="stylesheet" href="{{asset('storage/front/style.css')}}">

  @stack('header-scripts')

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="preload-content">
            <div id="original-load"></div>
        </div>
    </div>

    @include('home.sections.header')
    @yield('content') 
    @include('home.sections.footer')
  

  @stack('footer-scripts')

</body>
</html>
