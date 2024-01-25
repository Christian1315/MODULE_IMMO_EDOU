<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('images/edou_logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('fichiers/icon-font.min.css')}}">
    <link rel="stylesheet" href="{{asset('fichiers/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('fichiers/base.css')}}">
    <link rel="stylesheet" href="{{asset('fichiers/animate.min.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Réinitialisation</title>

    @livewireStyles
</head>

<body>
    <div class="main">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-0 mx-0">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg">
                        <a class="navbar-brand" href="index.html"><img src="images/edou_logo.png" width="60px" alt="" srcset=""></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">EDOU-SERVICES <span class="sr-only">(current)</span></a>
                                </li>
                            </ul>
                            <form class="form-inline my-2 my-lg-0">
                                <p style="font-size: 20px;font-weight: bold;">L'Agence immobilière qu'il vous faut!</p>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <div class="container">
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
        </div>

        <!-- content -->
        <div class="container-fluid" id="login-page">
            <div class="row">
                <div class="col-md-4">
                    <marquee direction="down" width="250" height="200" behavior="alternate">
                        <marquee behavior="alternate" style="font-size: 20px;font-weight: bold;text-shadow: 2px 3px #fff;">EDOU-SERVICES</marquee>
                    </marquee>
                </div>
                <div class="col-md-4">
                    <livewire:reinitialisation />
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

        <div class="container-fluid fixed-bottom shadow-lg py-3 bg-white">
            <div class="row">
                <div class="col-md-12 px-0 mx-0">
                    <p class="text-center">© Copyright 2024 - Réalisé par HSMC</p>
                </div>
            </div>
        </div>
    </div>

    <script src="fichiers/jquery.min.js"></script>
    <script src="fichiers/bootstrap.min.js"></script>
    <script src="fichiers/popper.min.js"></script>

    @livewireScripts
</body>

</html>