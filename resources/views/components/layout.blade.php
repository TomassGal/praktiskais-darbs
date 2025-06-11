<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title }}</title>
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
rel="stylesheet">
</head>
<body>

<ul class="nav border-bottom border-4 justify-content-center">
  <li class="nav-item">
    <a class="nav-link" href="/">{{ __('View Auctions') }}</a>
  </li>
  @auth
  @can('create', App\Models\Auction::class)
 <li class="nav-item">
    <a class="nav-link" href="{{route('auction.create')}}">{{ __('Create Auction') }}</a>
  </li>
  @endcan
  <li class="nav-item">
    <a class="nav-link" href="{{route('auth.logout')}}">{{ __('My Profile') }}</a>
  </li>
  @endauth
  @guest
  <li class="nav-item">
    <a class="nav-link" href="{{route('auth.login')}}">{{ __('Log In') }}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{route('auth.register')}}">{{ __('Register') }}</a>
  </li>
  @endguest
</ul>
<main class="container">
{{ $slot }}
</main>
</body>
</html>