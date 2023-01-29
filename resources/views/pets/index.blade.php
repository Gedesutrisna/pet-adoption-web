@extends('layouts.main')
@section('container')

@if (empty(Auth::user()->id))
    
@else
    @if (empty(Auth::user()->ktp))
        
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Hai {{ Auth::user()->name }}</strong>   Tolong untuk Upload <a href="/profile" class="alert-link">Foto Ktp</a> Jika ingin Adopsi atau Shelter
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @else
        
    @endif
@endif
<h1 class="mb-3" style="text-align: center">Pets</h1>
<div class="row justify-content-center mb-3">
  <div class="col text-center">
    <form action="/pets" method="get" style="display: inline-block;">
      @if (request('category'))
      <input type="hidden" name="category" value="{{ request('category') }}" >
  @endif
  <div class="input-group mb-3">
    <input type="text" name="search" class="form-control" placeholder="Search Pets" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ request('search') }}">
    <button class="input-group-text" style="background-color: #193A6A; 
    color: white;
    padding: 10px 20px;
    border: none;
    font-size: 16px;
    cursor: pointer;"  type="submit">search</button>
  </div>
    </form>
  </div>
</div>


<div class="d-flex justify-content-end">
  {{ $pets->links() }}
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
          class="img-fluid rounded-top" style="max-width:400px; height:300px;">
        <div class="card-body">
          <a href="/pets?category={{ $pet->category->slug }}" style="color: #193A6A" class="text-decoration-none">{{ $pet->category->name }}</a>

          <h5 class="card-title">{{ $pet->name }}</h5>
          <p class="card-title">Quantity {{ $pet->quantity }}</p>
          <p class="card-text">{{ $pet->short_description }}</p>
          <a href="/pet/{{ $pet->slug }}" style="background-color: #193A6A; 
            color: white;
            padding: 8px 16px;
            border: none;
            font-size: 13px;
            cursor: pointer;" class="text-decoration-none"> See More</a>
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
