<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Plateforme RMA</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
    }

    body {
      height: 100vh;
      background-color: #000;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      display: flex;
      flex-direction: row;
      gap: 40px;
    }

    .btn {
      background-color: #111;
      color: #fff;
      border: 2px solid #fff;
      padding: 15px 40px;
      font-size: 1.2rem;
      text-transform: uppercase;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .btn:hover {
      background-color: #fff;
      color: #000;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="{{ route('login') }}">
      <button class="btn">Login</button>
    </a>
    <a href="{{ route('register') }}">
      <button class="btn">Register</button>
    </a>
  </div>
</body>
</html>
