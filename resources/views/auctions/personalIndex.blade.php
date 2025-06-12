<x-layout>
    <x-slot name="title">
        Auctions
    </x-slot>
    <h3 class="mb-4">Auctions hosted by {{App\Models\User::find($id)->name}}</h3>

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