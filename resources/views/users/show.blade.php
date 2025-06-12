<x-layout>
    <x-slot name="title">
        {{$user->name}} profile
    </x-slot>
    <div class="container text-center my-3">
        <h2>{{$user->name}}</h2>
        <h4>{{number_format($user->balance,2)}}$</h4>
        <a href="{{route('auction.personal', Auth::user()->id)}}">Auctions hosted by {{$user->name}}</a>
    </div>
</x-layout>