<x-layout>
    <x-slot name="title">
        {{$auction->name}}
    </x-slot>
    <div class="container text-center">
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <img src="{{ $auction->image }}" class="img-fluid" alt="item-image" style="max-height: 375px;">
                <h3 class="fw-bold">{{$auction->name}}</h3>
                <h5 class="mb-4"><a href="{{route('user.show', $auction->user->id)}}" class="text-body">{{$auction->user->name}}</a></h5>
                <p class="mb-4 mt-2">{{$auction->description}}</p>
                @if(\Carbon\Carbon::parse($auction->time)->isPast())
                <h4>Auction has ended</h4>
                @else
                <h4>Ends at</h4>
                <p class="card-text">{{\Carbon\Carbon::parse($auction->time)->format('H:i d-m-Y') }}</p>
                @can('createBid', $auction)
                <button type="button" class="btn btn-dark mb-3" onclick="loadDoc()">Bid on this item</button>
                @endcan
                @can('delete', $auction)
                <form action="{{ route('auction.destroy', $auction->id) }}" method="POST" class="mb-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Auction</button>
                </form>
                @endcan
                @endif
            </div>
            <div class="col-sm border border-3 overflow-auto" style="height: 500px;">
                <div id="fill">
                </div>
                @if ($auction->bids->count())
                <div class="row">
                    @foreach ($auction->bids as $bid)
                    @if ($loop->first)
                    <div class="border border-success border border-4 mt-3 mx-3" style="width: 95%">
                    @else
                    <div class="border border-dark mt-3 mx-3" style="width: 95%">
                    @endif
                        <ul class="nav nav-pills nav-fill mt-2">
                            <li class="nav-item">
                                <h5 class="text-body">{{number_format($bid->price, 2)}}$</h5>
                            </li>
                            <li class="nav-item">
                                <a class="text-body" href="{{route('user.show', $bid->user->id)}}">{{$bid->user->name}}</a>
                            </li>
                            <li class="nav-item">
                                <p>{{\Carbon\Carbon::parse($bid->time)->format('H:i d-m-Y') }}</p>
                            </li>
                        </ul>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="alert alert-info mt-5">No bids have been placed. The starting price of this auction is {{number_format($auction->price,2)}}$</div>
                @endif
            </div>
        </div>
    </div>
    </div>       
</x-layout>

<script>
function loadDoc() {
    var c = document.getElementById("fill");
    c.innerHTML =`<div class="border border-dark mt-3 mx-3" style="width: 95%">
                    <ul class="nav nav-pills nav-fill mt-2">
                        <form action="{{ route('auctions.bid.store', $auction) }}" class = "d-flex" method="POST">
                        @csrf
                            <li class="nav-item">
                                <input type="number" step="0.01" name="price" class="form-control mx-1", value="{{ $auction->price }}" style="max-width: 100px;">
                            </li>
                            <li class="nav-item">
                                <button type="submit" class="btn btn-success">Add</button>
                            </li>
                        </form>
                        <li class="nav-item">
                            <a class="text-body" href="#">{{auth()->user()->name}}</a>
                        </li>
                        <li class="nav-item">
                            <p>{{\Carbon\Carbon::parse(\Carbon\Carbon::now())->format('H:i d-m-Y') }}</p>
                        </li>
                    </ul></div>`;
}
</script>