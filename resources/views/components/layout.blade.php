<!DOCTYPE html>
<html lang="en" style="min-height: 100%">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title }}</title>
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
rel="stylesheet">
</head>
<body class="bg-secondary bg-gradient">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-center">
  
<ul class="navbar-nav mb-2">
        <li class="nav-item me-3">
          <a class="nav-link" href="/">{{ __('Auctions') }}</a>
        </li>
        @auth
        @can('create', App\Models\Auction::class)
        <li class="nav-item me-3">
          <a class="nav-link" href="{{route('auction.create')}}">{{ __('Create Auction') }}</a>
        </li>
        @endcan
        <li class="nav-item me-3">
          <a class="nav-link" href="{{route('user.show', Auth::user()->id)}}">{{ __('msg.profile') }}</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link" >{{ __('Balance') }}: {{Auth::user()->balance}}$</a>
        </li>
        @endauth
        @guest
        <li class="nav-item me-3">
          <a class="nav-link" href="{{route('auth.login')}}">{{ __('Log In') }}</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link" href="{{route('auth.register')}}">{{ __('Register') }}</a>
        </li>
        @endguest

</ul> 
</nav>
    @if (session('success'))
        <div class="alert alert-success mx-5 my-5">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mx-5 my-5">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger mx-5 my-5">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
<main class="container mt-4">
{{ $slot }}
</main>
</body>
</html>