<x-layout>
    <x-slot name="title">
        Auctions
    </x-slot>
    <h1 class="mb-4">Auctions</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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