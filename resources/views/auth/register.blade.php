<x-layout>
    <x-slot name="title">
        Register Page
    </x-slot>
    <form action="{{ route('auth.register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Username</label>
            <input type="text" name="name" class="form-control" required
            value="{{ old('name') }}" style="max-width: 500px;">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" required
            value="{{ old('email') }}" style="max-width: 500px;">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required
            value="{{ old('password') }}" style="max-width: 500px;">
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="confirm" class="form-label">Confirm Password</label>
            <input type="password" name="confirm" class="form-control" required
            value="{{ old('confirm') }}" style="max-width: 500px;">
            @error('confirm') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
</x-layout>