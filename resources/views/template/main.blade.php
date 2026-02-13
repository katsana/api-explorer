<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>KATSANA&trade; API</title>

    <!-- Vendor Styles -->
    <link href="{{ asset('vendors/prism/prism.css') }}" rel="stylesheet">

    <!-- Vite Styles -->
    @vite(['resources/assets/sass/app.scss'])
    <style>
      .site-header .navbar,
      .site-header.navbar-sm .navbar,
      .site-header.navbar-lg .navbar {
        padding-top: 20px !important;
        padding-bottom: 20px !important;
      }

      .site-header .navbar-brand > img,
      .site-header.navbar-sm .navbar-brand > img,
      .site-header.navbar-lg .navbar-brand > img {
        max-height: 36px !important;
      }
    </style>

    <!-- Favicons -->
  </head>

  <body>

    <header class="site-header sticky">

      <!-- Top navbar & branding -->
      <nav class="navbar navbar-default">
        <div class="container">

          <!-- Toggle buttons and brand -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="true" aria-controls="navbar">
              <span class="glyphicon glyphicon-option-vertical"></span>
            </button>

            <button type="button" class="navbar-toggle for-sidebar" data-toggle="offcanvas">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{ url('/') }}">
              <img src="{{ asset('images/katsana.png') }}" alt="logo"> API Documentation
            </a>
          </div>
          <!-- END Toggle buttons and brand -->

          <!-- Top navbar -->
          <div id="navbar" class="navbar-collapse collapse" aria-expanded="true" role="banner">
            <ul class="nav navbar-nav navbar-right">
            </ul>
          </div>
          <!-- END Top navbar -->

        </div>
      </nav>
      <!-- END Top navbar & branding -->

    </header>

    <main class="container" id="app" >
      <div class="row">

        <!-- Sidebar -->
        <aside class="col-md-3 col-sm-3 sidebar">
          @yield('sidebar')
        </aside>
        <!-- END Sidebar -->

        <!-- Main content -->
        <article class="col-md-9 col-sm-9 main-content" role="main">
          @yield('content')
        </article>
        <!-- END Main content -->
      </div>
    </main>

    <!-- Footer -->
    <footer class="site-footer">
      <div class="container">
        <a id="scroll-up" href="#"><i class="fa fa-angle-up"></i></a>

        <div class="row">
          <div class="col-md-6 col-sm-6">
            <p>Copyright &copy; 2017 KATSANA Advanced Telematics. All right reserved</p>
          </div>
          <div class="col-md-6 col-sm-6">
            <ul class="footer-menu">
              <li><a href="https://my.katsana.com">Platform</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <!-- END Footer -->

    <!-- Vendor Scripts -->
    <script src="{{ asset('vendors/clipboard.js/clipboard.js') }}"></script>
    <script src="{{ asset('vendors/prism/prism.js') }}"></script>
    <!-- Keep sidebar/navigation behavior in a standalone script (not Vite JS bundle). -->
    <script src="{{ asset('js/site.js') }}"></script>

  </body>
</html>
