<!DOCTYPE html>
<html lang="it">
  <head>
    <title>@yield('titolo')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--css-->
    <link href="{{ url('/') }}/css/style.css" rel="stylesheet"> <!-- nell'head va messo il collegamento al foglio di stile-->
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">


    <!-- jQuery e plugin JavaScript  -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>

    <script src="{{ url('/') }}/js/bootstrap.bundle.min.js"></script>




    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom jQuery and Javascript scripts -->
    @yield('script')

  </head>

  <body class="bg-white">

    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="{{ route('home') }}">Zenzero Holidays</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link @yield('active_home') me-2" aria-current="page" href="{{ route('home') }}">Home</a> <!--me-2 allarga i margini-->
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('active_casa') me-2" href="{{ route('casaVacanze') }}">{{ trans('button.casa') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('active_luoghi') me-2" href="{{ route('luoghiDiInteresse') }}">{{ trans('button.luoghi') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('active_contatti') me-2" href="{{ route('contatti') }}">{{ trans('button.contact') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('active_prenota') me-2" href="{{ route('calendario') }}">
                @if(session('logged') && session('role') == 'admin')
                    {{ trans('button.calendarioHome') }}
                @else
                    {{ trans('button.book') }}
                @endif
              </a>
            </li>
            @if((session('logged')) && (session('role') == 'registered_user'))
              <li class="nav-item">
                <a class="nav-link  @yield('active_prenotazioniUtente') me-2" href="{{ route('prenotazioniUtente.index') }}">{{ trans('button.prenotazioni') }}</a>
              </li>
            @elseif((session('logged')) && (session('role') == 'admin'))
              <li class="nav-item">
                <a class="nav-link  @yield('active_prenotazioniAdmin') me-2" href="{{ route('prenotazioniAdmin.index') }}">{{ trans('button.prenotazioni') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  @yield('active_tariffe') me-2" href="{{ route('tariffeAdmin.index') }}">{{ trans('button.tariffe') }}</a>
              </li>
            @endif
            </ul>
            @if(session('logged'))
            <ul class="navbar-nav">
            <li class="nav-item" id="welcomeUser">
                @if(session('logged') && session('role') == 'admin')
                    {{ trans('messages.admin') }}
                @else
                    {{ trans('messages.welcome') }}
                @endif
             {{ session('loggedName') }} </li>
            </ul>
            @endif
            <ul class="navbar-nav">
              <li class="nav-item"><a href="{{ route('setLang', ['lang' => 'en']) }}" class="nav-link"><img src="{{ url('/') }}/img/flags/en.png" width="28" alt="UK flag"/></a></li>
              <li class="nav-item"><a href="{{ route('setLang', ['lang' => 'it']) }}" class="nav-link"><img src="{{ url('/') }}/img/flags/it.png" width="22"  alt="Italian flag"/></a></li>
              @if(session('logged'))
                <li class="nav-item">
                    <a href="{{ route('user.logout') }}" id="logout" class="nav-link">{{ trans('button.logout') }} <i class="bi bi-box-arrow-right"></i> </a>
                </li>
              @else
                <li class="nav-item">
                    <a href="{{ route('user.login') }}" id="login" class="nav-link"><i class="bi bi-person-fill"></i> {{ trans('button.login') }} </a>
                </li>
              @endif
            </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid d-flex justify-content-end">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          @yield('breadcrumb')
        </ol>
      </nav>
    </div>

    <div class="container-fluid ">

          @yield('corpo')

    </div>

    <!-- Footer -->
    <footer class="text-lg-start text-white">
      <!-- Grid container -->
      <div class="container p-4 footer">
        <!-- Section: Links -->
        <section>
          <!--Grid row-->
          <div class="row">
            <!-- Grid column for logo and slogan -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-center">
              <a class="navbar-brand fw-bold fs-3 h-font" href="{{ route('home') }}">Zenzero Holidays</a>
              <p class="footer-slogan mt-2">{{ trans('messages.carosello') }}</p>
            </div>
        
            <hr class="w-100 clearfix d-md-none" />

            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
              <h6 class="text-uppercase font-weight-bold">{{ trans('messages.position') }}</h6>
              <hr
                class="mt-0 d-inline-block mx-auto"
                style="width: 100px; background-color: #cececebc; height: 2px"
                />
              <p><a href="https://maps.app.goo.gl/4W9M2on2tefVwz1a7" class="text-white"><i class="bi bi-geo-alt-fill"></i>Via Mantovana, 58b, 37014 Cavalcaselle, VR, Italia</a></p>
            </div>

            <hr class="w-100 clearfix d-md-none" />

            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
              <h6 class="text-uppercase font-weight-bold">{{ trans('messages.contact') }}</h6>
              <hr
                class="mt-0 d-inline-block mx-auto"
                style="width: 77px; background-color: #cececebc; height: 2px"
                />
              <p><a href="mailto:dina.colpani@gmail.com" class="text-white"><i class="bi bi-envelope-fill"></i>dina.colpani@gmail.com</a></p>
              <p><a href="tel:+393334142902" class="text-white"><i class="bi bi-telephone-fill"></i>+39 333 414 2902</a></p>
            </div>

            <hr class="w-100 clearfix d-md-none" />

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
              <h6 class="text-uppercase font-weight-bold">Social</h6>
              <hr
                class="mt-0 d-inline-block mx-auto"
                style="width: 57px; background-color: #cececebc; height: 2px"
                />
              <!-- Facebook -->
              <p><a href="https://m.facebook.com/people/ZenZero-Holiday/100072790333341/" class="text-white"><i class="bi bi-facebook"></i>Facebook</a></p>
        </a></p>
            </div>

            <hr class="w-100 clearfix d-md-none" />

          </div>
          <!--Grid row-->
        </section>
        <!-- Section: Links -->
      </div>
      <!-- Grid container -->

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
      © 2024 Zenzero Holidays. All rights reserved.
      </div>
      <!-- Copyright -->
    </footer>




  </body>

</html>
