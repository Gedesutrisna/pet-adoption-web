@extends('layouts.main')
@section('container')
<h1 class="mb-3" style="text-align: center">Pets</h1>

<div class="row justify-content-center mb-3">
  <div class="col-md-6">
    {{-- <form action="/posts">
      @if (request('category'))
          <input type="hidden" name="category" value="{{ request('category') }}" >
      @endif
      @if (request('author'))
          <input type="hidden" name="author" value="{{ request('author') }}" >
      @endif
      <div class="input-group mb-3">
        <span class="input-group-text" id="addon-wrapping" style="background: white;"><i class="bi bi-search"></i></span>
        <input type="text" class="form-control" placeholder="Search" name="search"
        value="{{ request('search')}}">
      </div>
    </form> --}}
  </div>
</div>



@if ($pets->count())
<div class="container">
  <div class="row">
    @foreach ($pets as $pet)
    <div class="col-md-4 mb-3">
      <div class="card border-0">
        <div class="position-absolute px-3 py-2 text-white">
{{ $pet->status }}
        </div>
          <img src="{{ asset('storage/' . $pet->image ) }}" alt="{{ $pet->category->name }}"
          class="img-fluid" style="border-radius: 15px; width:300px; height:250px;">
        <div class="card-body">
          <a href="/pets?category={{ $pet->category->slug }}" class="text-decoration-none">{{ $pet->category->name }}</a>

          <h5 class="card-title">{{ $pet->name }}</h5>
          <h5 class="card-title">{{ $pet->quantity }}</h5>
          <p class="card-text">{{ $pet->short_description }}</p>
          <p class="card-text"><small class="text-muted">{{ $pet->created_at->diffForHumans() }}</small></p>
          <a href="/pet/{{ $pet->slug }}" class="text-decoration-none "><i class="bi bi-arrow-right"></i> See More</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<div class="d-flex justify-content-center mb-3">
  {{ $pets->links() }}
</div>

@else
    <p class="text-center fs-4">No. Post Found.</p>
@endif
@endsection
