<div class="card text-center border border-dark" style="width: 300px; height:350px">
  <a href="{{ route('auction.show', $auction->id) }}" class="text-decoration-none">
  <img src="{{ $auction->image }}" class="card-img-top" alt="auction-image" style="width: 100%; height: 210px;">
  <div class="card-body border-top border-dark text-body"> 
    <h5 class="card-title">{{ $auction->name }}</h5>
    <p class="card-text">{{ number_format($auction->price, 2) }}$</p>
    <p class="card-text">{{\Carbon\Carbon::parse($auction->time)->format('H:i d-m-Y') }}</p>
  </div>
  </a>
</div>
