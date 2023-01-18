@extends('layouts.main')
@section('container')
<div class="row">
    @foreach (Auth::user()->shelter as $shelter)
        
    <div class="col-sm-4 mb-3 mb-sm-0">
        <div class="card">
            <div class="card-body">
                      <p>{{ $shelter->status }}</p>
                <h5 class="card-title">{{ $shelter->name }}</h5>
                <h5 class="card-title">{{ $shelter->email }}</h5>
                <p class="card-text">{{ $shelter->reason }}</p>
            </div>
        </div>
    </div>
    @endforeach
  </div>
@endsection
