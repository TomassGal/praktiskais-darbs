<x-layout>
    <x-slot name="title">
        {{$user->name}} profile
    </x-slot>
    <div class="container text-center my-3">
        <h2>{{$user->name}}</h2>
        <h4>{{number_format($user->balance,2)}}$</h4>
        @if($user->blocked)
        <h4 class="text-danger">This user has been blocked from creating auctions or placing bids</h4>
        @endif
        <a class = "btn btn-dark mt-3" href="{{route('auction.personal', $user->id)}}">Auctions hosted by {{$user->name}}</a>
    </div>
    @can('update', $user)
    <hr class="border border-3 border-dark">
    <div class="container d-flex justify-content-center my-3">
        <form action="{{ route('user.update', $user->id) }}" class = "d-flex" method="POST">
            @csrf
            @method('PUT')
            <input type="number" step="0.01" name="price" class="form-control mx-1" value="10.00" style="max-width: 100px;">
            <button type="submit" class="btn btn-success">Add Funds</button>
        </form>
        <br>
    </div>
    <div class="d-flex justify-content-center">
    <a class="btn btn-danger" href="{{route('auth.logout')}}">{{ __('Sign Out') }}</a>
    </div>
    @endcan
    @can('block', $user)
     <hr class="border border-3 border-dark">
     <div class="container text-center my-3">
        <form action="{{ route('user.block', $user->id) }}" class = "d-flex" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-danger">Block User</button>
        </form>
    @endcan
    @can('unBlock', $user)
     <hr class="border border-3 border-dark">
     <div class="container text-center my-3">
        <form action="{{ route('user.unBlock', $user->id) }}" class = "d-flex" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success">Unblock User</button>
        </form>
    @endcan
    @can('addAdmin', $user)
        @can('beAdmin', $user)
            <form action="{{ route('user.makeAdmin', $user->id) }}" class = "d-flex" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success">Make Admin</button>
            </form>
        @endcan
        @cannot('beAdmin', $user)
            <p>This user cannot be an admin while they have active bids or auctions. (or they already are an admin)</p>
        @endcan
    </div>
    @endcan
    <hr class="border border-3 border-dark">
    <div class="container text-center my-3">
        <h4>Auctions won</h4>
        @if ($user->sales->count())
        <div class="row">
            @foreach ($user->sales as $sale)
            <div class="col-md-6 col-lg-4">
                <x-auction-card :auction="$sale->auction" />
            </div>
            @endforeach
        </div>
        @else
        <div class="alert alert-info">No auctions won.</div>
        @endif
    </div>
</x-layout>