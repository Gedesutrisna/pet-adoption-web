@extends('layouts.main')
@section('container')
<div class="row">
    @foreach (Auth::user()->shelter as $shelter)
        
    <div class="col-sm-4 mb-3 mb-sm-0">
        <div class="card">
            <div class="card-body">
                      <p>{{ $shelter->status }}</p>
                      <p>Kode untuk doante : {{ $shelter->code }}</p>
                <p class="card-text">{{ $shelter->reason }}</p>
                
            </div>
            <a href="/data/shelter/{{ $shelter->id }}" style="background-color: #193A6A; 
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
