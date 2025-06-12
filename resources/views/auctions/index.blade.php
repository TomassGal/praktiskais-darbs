<x-layout>
    <x-slot name="title">
        Auctions
    </x-slot>
    <h3 class="mb-4">Active auctions</h3>
    <form method="GET" action="{{ route('auction.sort') }}" class="mb-3">
        <label for="sort" class="me-2 my-2">Sort By: </label>

        <select name="sort" id="sort" onchange="this.form.submit()">
        <option value="pop" @selected(request('sort') === 'pop')>Popularity (most bids)</option>
        <option value="asc" @selected(request('sort') === 'asc')>Price: Low to High</option>
        <option value="desc" @selected(request('sort') === 'desc')>Price: High to Low</option>
        </select>
    </form>

    @if ($auctions->count())
        <div class="row">
            @foreach ($auctions as $auction)
            <div class="col-md-6 col-lg-4">
                <x-auction-card :auction="$auction" />
            </div>
            @endforeach
        </div>
    @else
    <div class="alert alert-info">No auctions available.</div>
    @endif
</x-layout>