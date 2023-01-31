@extends('layouts.main')
@section('container')

<div class="row">
    @foreach (Auth::user()->adoption as $adoption)
        
    <div class="col-sm-4 mb-3 mb-sm-0">
        <div class="card">
            <div class="card-body">
              
                <div style="max-height: 350px; overflow: hidden; ">
                    <div class="position-absolute px-3 py-2 text-white">
                      {{ $adoption->status }}
                    </div>
                    <img src="{{ asset('storage/' . $adoption->pet->image ) }}" alt="{{ $adoption->pet->category->name }}"
                    class="img-fluid mt-2">
                  </div>
                  <p> kode untuk donasi : {{ $adoption->code }}</p>
                <p class="card-text">{{ $adoption->reason }}</p>
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
