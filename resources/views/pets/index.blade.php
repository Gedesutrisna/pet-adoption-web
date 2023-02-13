@extends('layouts.main')
@section('container')
<div class="container mt-5" style="margin-bottom:2rem">
  @if (empty(Auth::user()->id))
      
  @else
      @if (empty(Auth::user()->ktp))
          
      <div class="alert alert-warning alert-dismissible fade show" style="font-size: 1.5rem" role="alert">
        <strong>Hai {{ Auth::user()->name }}</strong>   Tolong untuk Upload <a href="/profile" class="alert-link">Foto Ktp</a> Jika ingin Adopsi atau Shelter
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @else
          
      @endif
  @endif
  <h1 class="text-center" style="font-family: Playfair Display">Every Pet Deserves a Loving Home. <br> <span style="color:#e67e22">Adopt</span> a Pet Today </h1>
  <p class="text-center" style="font-family: Roboto;font-size:16px">Browse our available animals and learn more about the adoption process. Together, we can rescue, rehabilitate, and <br> rehome pets in need. Thank you for supporting our mission to bring joy to families through pet adoption.</p>
  </div>
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

@if ($pets->count())
<div class="container">
  <div class="row">
    @foreach ($pets as $pet)
    <div class="col-md-3 mb-3">
      <div class="card border-0" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <div class="position-absolute px-2 py-2 text-white">
          <p style="background-color: #193A6A; 
          color: white;
          padding: 5px 10px;
          border: none;
          font-size: 13px;
          cursor: pointer;">{{ $pet->status }}</p> 
        </div>
          <img src="{{ asset('storage/' . $pet->image ) }}" alt="{{ $pet->category->name }}"
          class="img-fluid rounded-top" style="max-width:400px; height:200px;">
        <div class="card-body"style="height:160px">
          <a href="/pets?category={{ $pet->category->slug }}" style="color: #193A6A;font-size:12px;color:#e67e22;" class="text-decoration-none">{{ $pet->category->name }}</a>

          <h5 class="card-title"style="font-size:18px">{{ $pet->name }}</h5>
          <p class="card-title"style="font-size:12px">Quantity {{ $pet->quantity }}</p>
          <p class="card-text mb-3"style="font-size:12px">{{ $pet->short_description }}</p>
          <a href="/pet/{{ $pet->slug }}" style="background-color: #193A6A; 
            color: white;
            padding: 8px 16px;
            border: none;
            font-size: 13px;
            cursor: pointer;" class="text-decoration-none mb-3"> See More <i class="bi bi-arrow-right"></i></a>
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
