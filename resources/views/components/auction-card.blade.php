<a href="your-link.html" class="text-decoration-none">
<div class="card text-center" style="width: 18rem; cursor: pointer;">
  <img src="{{ $auction->image }}" class="card-img-top" alt="auction-image">
  <div class="card-body">
    <h5 class="card-title">{{ $auction->name }}</h5>
    <p class="card-text">Current bid: {{ $auction->price }}$</p>
        <p class="card-text">End date: {{ $auction->time }}</p>
  </div>
</div>
</a>