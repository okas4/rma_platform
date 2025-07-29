<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'dashboard')</title>


        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@4.0.0/dist/css/bootstrap.min.css">

  <style>
    .card-hover {
      transition: all 0.3s ease-in-out;
    }

    .card-hover:hover {
      transform: scale(1.03);
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .titre-carte {
      font-size: 1.1rem;
    }

    @media (min-width: 576px) {
      .titre-carte { font-size: 1.25rem; }
    }
    @media (min-width: 768px) {
      .titre-carte { font-size: 1.4rem; }
    }
    @media (min-width: 992px) {
      .titre-carte { font-size: 1.6rem; }
    }

    .texte-carte {
      font-size: 0.9rem;
    }
    @media (min-width: 768px) {
      .texte-carte { font-size: 1rem; }
    }

    .btn-carte {
      font-size: 0.9rem;
      padding: 0.5rem 1rem;
    }
    @media (min-width: 768px) {
      .btn-carte {
        font-size: 1rem;
        padding: 0.6rem 1.2rem;
      }
    }
  </style>
</head>
<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="R">Demandes</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="acceuil.html">Accueil</a></li>
          <li class="nav-item"><a class="nav-link" href="demande.html">Nouvelle Demande</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Suivre Mes Demandes</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Section demandes centrée verticalement -->
  @yield('content')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
