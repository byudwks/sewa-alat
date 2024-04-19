<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- boostrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">

    <!-- css login-->
    <link href="/css/all.css" rel="stylesheet">
    <link href="/css/home.css" rel="stylesheet">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,700;1,500&family=Roboto:wght@300;400;700&family=Sofia+Sans:wght@300;500;700&display=swap" rel="stylesheet">

    <!-- logo title atas -->
    <link href="img/bumk.png" rel="icon" type = "image/x-icon">

    <script src="https://unpkg.com/scrollreveal"></script>

  </head>
    <title>BUMK Karya Mandiri | {{ $title }}</title>
  </head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container mx-auto">
      <a class="navbar-brand" href="/home">
        <img src="/img/bumk.png" alt="Logo" width="60" height="50" class="d-inline-block align-text-top">
      </a>
      <h3 class="text-light fw-bold "></h3>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ ($active === "home") ? 'active' : '' }} fw-semibold" href="/home">BERANDA</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link {{ ($active === "beranda") ? 'active' : '' }} fw-semibold" href="/post">SEWA ALAT</a>
          </li>
          @auth
          <li class="nav-item">
            <a class="nav-link {{ ($active === "cekout") ? 'active' : '' }} fw-semibold" href="/cekout">PESANAN</a>
          </li> 

          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">{{ auth()->user()->nama }} </a></li>
                  <li><hr class="dropdown-divider"></li>
                <li>
              <form action= "/logout" method="post">
                @csrf
                <button type="submit" class="dropdown-item text-danger"></i> Logout <i class="bi bi-arrow-bar-right"></i></button>
              </form>
            </li>
          </li>
          </ul>
          @else
          <a class="nav-link {{ ($active === "login") ? 'active' : '' }}" href="/login">
          <i class="bi bi-person-circle"></i>
          </a>
          @endauth
          
        </ul>
      </div>
    </div>
  </nav>


@yield('container')

@include('layouts.footer')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/main.js"></script>
</body>
</html>