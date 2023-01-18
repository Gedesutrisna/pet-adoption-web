@extends('layouts.main')
@section('container')
<div class="row">
    @foreach (Auth::user()->donate as $donate)
        
    <div class="col-sm-4 mb-3 mb-sm-0">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $donate->amount }}</h5>
                <h5 class="card-title">{{ $donate->name }}</h5>
                <h5 class="card-title">{{ $donate->email }}</h5>
                <p class="card-text">{{ $donate->comment }}</p>
            </div>
        </div>
    </div>
    @endforeach
  </div>
@endsection
