@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Create New Bill</h1>
    
    @if ($errors->any())
    <div class="alert alert-danger mb-3">
        Please check the form for errors
    </div>
    @endif

    <form method="POST" action="{{ route('bills.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Bill Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div id="friends-container" class="mb-4">
            <h4 class="mb-3">Friends</h4>
            
            @php
                $friends = old('friends', [['name' => '', 'email' => '']]);
            @endphp
            
            @foreach($friends as $index => $friend)
            <div class="friend-group mb-3">
                <div class="row g-2">
                    <div class="col-md-5">
                        <input type="text" class="form-control @error("friends.$index.name") is-invalid @enderror" 
                               name="friends[{{ $index }}][name]" placeholder="Name" 
                               value="{{ $friend['name'] }}" required>
                        @error("friends.$index.name")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-5">
                        <input type="email" class="form-control @error("friends.$index.email") is-invalid @enderror" 
                               name="friends[{{ $index }}][email]" placeholder="Email (optional)"
                               value="{{ $friend['email'] }}">
                        @error("friends.$index.email")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger w-100 remove-friend">Remove</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="d-flex gap-2">
            <button type="button" id="add-friend" class="btn btn-secondary">Add Friend</button>
            <button type="submit" class="btn btn-primary">Create Bill</button>
        </div>
    </form>
</div>

<script>
    // [Keep your existing JavaScript exactly the same]
    document.getElementById('add-friend').addEventListener('click', function() {
        const container = document.getElementById('friends-container');
        const index = document.querySelectorAll('.friend-group').length;
        
        const div = document.createElement('div');
        div.className = 'friend-group mb-3';
        div.innerHTML = `
            <div class="row g-2">
                <div class="col-md-5">
                    <input type="text" class="form-control" name="friends[${index}][name]" placeholder="Name" required>
                </div>
                <div class="col-md-5">
                    <input type="email" class="form-control" name="friends[${index}][email]" placeholder="Email (optional)">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100 remove-friend">Remove</button>
                </div>
            </div>
        `;
        
        container.appendChild(div);
    });
    
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-friend')) {
            if (document.querySelectorAll('.friend-group').length > 1) {
                e.target.closest('.friend-group').remove();
            } else {
                alert('You need at least one friend for the bill.');
            }
        }
    });
</script>
@endsection