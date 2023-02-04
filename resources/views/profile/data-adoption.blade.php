@extends('layouts.main')
@section('container')
<div class="back mt-3 mb-3">
  <a href="/profile"><i   style="font-size: 2rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
</div>
<div class="row">
    @foreach (Auth::user()->adoption as $adoption)
        
    <div class="col-sm-3 mb-3">
        <div class="card" style="max-height: 400px; overflow: hidden; ">
            <div class="card-body">     
                <div style="max-height: 300px; overflow: hidden; " class="mb-3">
                    <div class="position-absolute px-3 py-2 text-white">
                      {{ $adoption->status }}
                    </div>
                    <img src="{{ asset('storage/' . $adoption->pet->image ) }}" alt="{{ $adoption->pet->category->name }}"
                    class="img-fluid mt-2">
                  </div>
                <p class="card-text">Alasan : {{ $adoption->reason }}</p>
            </div>
            <a href="/data/adoption/{{ $adoption->id }}" style="background-color: #193A6A; 
              color: white;
              padding: 8px 16px;
              border: none;
              font-size: 13px;
              cursor: pointer;" class="text-decoration-none">See</a>
        </div>
    </div>
    @endforeach
  </div>

 
@endsection
