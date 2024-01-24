<div>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="{{asset('images/edou_logo.png')}}" type="image/x-icon">
        <link rel="stylesheet" href="{{asset('fichiers/icon-font.min.css')}}">
        <link rel="stylesheet" href="{{asset('fichiers/animate.min.css')}}" />
        <title>{{$title}}</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/dashboard/">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- Bootstrap core CSS -->
        <link href="{{asset('fichiers/bootstrap.css')}}" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{asset('fichiers/dashbord.css')}}" rel="stylesheet">
        <link href="{{asset('fichiers/base.css')}}" rel="stylesheet">

        @livewireStyles
    </head>

    <body>
        <nav class="navbar navbar-dark fixed-top bg-red flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0 justify-content-between" href="#">
                <button class="navbar-toggler" type="button" id="open-moblie-sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                &nbsp;
                <span>EDOU-SERVICES</span> </a>

            <input class="form-control form-control-dark w-100 bg-light search--bar" type="text" placeholder="Recherche" aria-label="searh">
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap text-center">
                    <a class="nav-link text-center" href="logout">SE DECONNECTER</a>
                </li>
            </ul>
        </nav>


        <div class="container-fluid">
            <div class="row">
                <!-- SUR LES DESKTOP -->
                <nav class="col-md-2 d-none d-md-block bg-light sidebar shadow-lg">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                @if($active=="dashbord")
                                <a class="nav-link active" href="/dashbord">
                                    <i class="bi bi-house-add-fill"></i>
                                    Tableau de board <span class="sr-only">(current)</span>
                                </a>
                                @else
                                <a class="nav-link" href="/dashbord">
                                    <i class="bi bi-house-add-fill"></i>
                                    Tableau de board <span class="sr-only">(current)</span>
                                </a>
                                @endif
                            </li>

                            @if($active=="proprietor")
                            <li class="nav-item">
                                <a class="nav-link active" href="/proprietor">
                                    <i class="bi bi-person-fill-gear"></i>
                                    Propriétaires
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/proprietor">
                                    <i class="bi bi-person-fill-gear"></i>
                                    Propriétaires
                                </a>
                            </li>
                            @endif


                            @if($active=="house")
                            <li class="nav-item">
                                <a class="nav-link active" href="/house">
                                    <i class="bi bi-house-add-fill"></i>
                                    Maisons
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/house">
                                    <i class="bi bi-house-add-fill"></i>
                                    Maisons
                                </a>
                            </li>
                            @endif

                            @if($active=="client")
                            <li class="nav-item">
                                <a class="nav-link active" href="/client">
                                    <i class="bi bi-people-fill"></i>
                                    Clients
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/client">
                                    <i class="bi bi-people-fill"></i>
                                    Clients
                                </a>
                            </li>
                            @endif

                            @if($active=="room")
                            <li class="nav-item active">
                                <a class="nav-link" href="/room">
                                    <i class="bi bi-hospital-fill"></i>
                                    Chambres
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/room">
                                    <i class="bi bi-hospital-fill"></i>
                                    Chambres
                                </a>
                            </li>
                            @endif

                            @if($active=="locataire")
                            <li class="nav-item">
                                <a class="nav-link active" href="/locator">
                                    <i class="bi bi-person-fill-gear"></i>
                                    Locataires
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/locator">
                                    <i class="bi bi-person-fill-gear"></i>
                                    Locataires
                                </a>
                            </li>
                            @endif


                            @if($active=="location")
                            <li class="nav-item">
                                <a class="nav-link active" href="/location">
                                    <i class="bi bi-person-fill-gear"></i>
                                    Locations
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/location">
                                    <i class="bi bi-person-fill-gear"></i>
                                    Locations
                                </a>
                            </li>
                            @endif

                            @if($active=="count")
                            <li class="nav-item">
                                <a class="nav-link active" href="/count">
                                    <i class="bi bi-person-fill-add"></i>
                                    Comptes & Soldes
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/count">
                                    <i class="bi bi-person-fill-add"></i>
                                    Comptes & Soldes
                                </a>
                            </li>
                            @endif


                            @if($active=="initiation")
                            <li class="nav-item">
                                <a class="nav-link active" href="/initiation">
                                    <i class="bi bi-currency-exchange"></i>
                                    Initiations de paiements
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/initiation">
                                    <i class="bi bi-currency-exchange"></i>
                                    Initiations de paiements
                                </a>
                            </li>
                            @endif

                            @if($active=="paiement")
                            <li class="nav-item">
                                <a class="nav-link active" href="/paiement">
                                    <i class="bi bi-currency-exchange"></i>
                                    Paiements
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/paiement">
                                    <i class="bi bi-currency-exchange"></i>
                                    Paiements
                                </a>
                            </li>
                            @endif

                        </ul>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Paramètres & Statistiques</span>
                            <a class="d-flex align-items-center text-muted" href="#">
                                <span data-feather="plus-circle"></span>
                            </a>
                        </h6>
                        @if(session()->get("userId") ==1 || session()->get("userId") ==2 || session()->get("userId") ==3)
                        <ul class="nav flex-column mb-2">

                            @if($active=="setting")
                            <li class="nav-item">
                                <a class="nav-link active" href="/setting">
                                    <i class="bi bi-gear-fill"></i>
                                    Paramètres
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/setting">
                                    <i class="bi bi-gear-fill"></i>
                                    Paramètres
                                </a>
                            </li>
                            @endif

                            @if($active=="statistique")
                            <li class="nav-item">
                                <a class="nav-link active" href="/statistique">
                                    <i class="bi bi-flag-fill"></i>
                                    Statistiques
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/statistique">
                                    <i class="bi bi-flag-fill"></i>
                                    Statistiques
                                </a>
                            </li>
                            @endif

                        </ul>
                        @endif
                    </div>
                </nav>

                <!-- SUR LES MOBILES -->
                <nav class="col-md-2 bg-light shadow-lg" id="sidebar_mobile">
                    <div class="">
                        <ul class="nav flex-column">
                            <i class="bi bi-x-circle" id="close-moblie-sidebar"></i>
                            <li class="nav-item">
                                @if($active=="dashbord")
                                <a class="nav-link active" href="/dashbord">
                                    <i class="bi bi-house-add-fill"></i>
                                    Tableau de board <span class="sr-only">(current)</span>
                                </a>
                                @else
                                <a class="nav-link active" href="/dashbord">
                                    <i class="bi bi-house-add-fill"></i>
                                    Tableau de board <span class="sr-only">(current)</span>
                                </a>
                                @endif
                            </li>

                            @if($active=="proprietor")
                            <li class="nav-item">
                                <a class="nav-link active" href="/proprietor">
                                    <i class="bi bi-person-fill-gear"></i>
                                    Propriétaires
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/proprietor">
                                    <i class="bi bi-person-fill-gear"></i>
                                    Propriétaires
                                </a>
                            </li>
                            @endif


                            @if($active=="house")
                            <li class="nav-item">
                                <a class="nav-link active" href="/house">
                                    <i class="bi bi-house-add-fill"></i>
                                    Maisons
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/house">
                                    <i class="bi bi-house-add-fill"></i>
                                    Maisons
                                </a>
                            </li>
                            @endif

                            @if($active=="client")
                            <li class="nav-item">
                                <a class="nav-link active" href="/client">
                                    <i class="bi bi-people-fill"></i>
                                    Clients
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/client">
                                    <i class="bi bi-people-fill"></i>
                                    Clients
                                </a>
                            </li>
                            @endif

                            @if($active=="room")
                            <li class="nav-item active">
                                <a class="nav-link" href="/room">
                                    <i class="bi bi-hospital-fill"></i>
                                    Chambres
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/room">
                                    <i class="bi bi-hospital-fill"></i>
                                    Chambres
                                </a>
                            </li>
                            @endif

                            @if($active=="locataire")
                            <li class="nav-item">
                                <a class="nav-link active" href="/locator">
                                    <i class="bi bi-person-fill-gear"></i>
                                    Locataires
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/locator">
                                    <i class="bi bi-person-fill-gear"></i>
                                    Locataires
                                </a>
                            </li>
                            @endif


                            @if($active=="location")
                            <li class="nav-item">
                                <a class="nav-link active" href="/location">
                                    <i class="bi bi-person-fill-gear"></i>
                                    Locations
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/location">
                                    <i class="bi bi-person-fill-gear"></i>
                                    Locations
                                </a>
                            </li>
                            @endif

                            @if($active=="count")
                            <li class="nav-item">
                                <a class="nav-link active" href="/count">
                                    <i class="bi bi-person-fill-add"></i>
                                    Comptes & Soldes
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/count">
                                    <i class="bi bi-person-fill-add"></i>
                                    Comptes & Soldes
                                </a>
                            </li>
                            @endif


                            @if($active=="initiation")
                            <li class="nav-item">
                                <a class="nav-link activate" href="/initiation">
                                    <i class="bi bi-currency-exchange"></i>
                                    Initiations de paiements
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/initiation">
                                    <i class="bi bi-currency-exchange"></i>
                                    Initiations de paiements
                                </a>
                            </li>
                            @endif

                            @if($active=="paiement")
                            <li class="nav-item">
                                <a class="nav-link active" href="/paiement">
                                    <i class="bi bi-currency-exchange"></i>
                                    Paiements
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/paiement">
                                    <i class="bi bi-currency-exchange"></i>
                                    Paiements
                                </a>
                            </li>
                            @endif
                        </ul>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Paramètres & Statistiques</span>
                            <a class="d-flex align-items-center text-muted" href="#">
                                <span data-feather="plus-circle"></span>
                            </a>
                        </h6>
                        <ul class="nav flex-column mb-2">

                            @if($active=="setting")
                            <li class="nav-item">
                                <a class="nav-link active" href="/setting">
                                    <i class="bi bi-gear-fill"></i>
                                    Paramètres
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/setting">
                                    <i class="bi bi-gear-fill"></i>
                                    Paramètres
                                </a>
                            </li>
                            @endif

                            @if($active=="statistique")
                            <li class="nav-item">
                                <a class="nav-link active" href="/statistique">
                                    <i class="bi bi-flag-fill"></i>
                                    Statistiques
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/statistique">
                                    <i class="bi bi-flag-fill"></i>
                                    Statistiques
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </nav>

                <!-- =============== LE BODY DU DASHBORD ========= -->

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <!-- MESSAGE FLASH -->
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            @if (session()->has('success'))
                            <div class="alert bg-dark text-white text-center">
                                {{ session()->get('success')}}
                            </div>
                            @endif
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <!-- MESSAGE FLASH -->
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            @if (session()->has('error'))
                            <div class="alert bg-red text-white text-center">
                                {{ session()->get('error')}}
                            </div>
                            @endif
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    {{$slot}}

                    <div class="container-fluid bg-white shadow py-3">
                        <div class="row">
                            <div class="col-md-12 px-0 mx-0">
                                <p class="text-center">© Copyright 2024 - Réalisé par HSMC</p>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="fichiers/jquery.min.js"></script>
        <script src="fichiers/popper.min.js"></script>
        <script src="fichiers/bootstrap.min.js"></script>

        <livewire:graph />

        @livewireScripts
    </body>

    </html>
</div>