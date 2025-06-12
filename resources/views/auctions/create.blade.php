<x-layout>
<x-slot name="title">
Create a new auction
</x-slot>


<h1 class="mb-4">Create a new auction</h1>
 <form method="POST" action="{{ route('auction.store') }}" enctype="multipart/form-data">
 @csrf
 <div class="mb-3">
 <label class="form-label">Name of item</label>
    <input type="text" name="name" class="form-control " value="{{ old('name') }}" style="max-width: 500px;">
 </div>
 <div class="mb-3">
 <label class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="5" style="max-width: 650px;">{{ old('description') }}</textarea>
 </div>
 <div class="mb-3">
 <label class="form-label">Starting price</label>
    <input type="number" step="0.01" name="price" class="form-control", value="{{ old('price') }}" style="max-width: 500px;">
 </div>
 <div class="mb-3">
 <label class="form-label">Image of item</label>
    <input type="file" name="image">
 </div>
 <div class="mb-3">
 <label class="form-label">End date</label>
    <input name="end" type="datetime-local" value="{{ old('end') }}">
 </div>

<button type="submit" class="btn btn-primary">Create auction</button>
</form>
</x-layout>