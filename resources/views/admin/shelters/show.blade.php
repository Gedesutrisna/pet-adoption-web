@extends('admin.layouts.main')
@section('container')
<div class="container">
    <div class="row my-3">
      <div class="col-lg-8">
        <h1 class="mb-3">{{ $shelter->user->name}}</h1>
        <h1 class="mb-3">{{ $user->phone}}</h1>
        <p>{{ $shelter->user->email }}</p>
        
        <a href="{{ asset('storage/' . $shelter->file ) }}" target="_blank"><i class="bi bi-file-earmark-arrow-down"></i> Download File</a>
              
      <div style="max-height: 350px; overflow: hidden; ">
        <img src="{{ asset('storage/' . $shelter->image ) }}" alt="{{ $shelter->category->name }}"
        class="img-fluid mt-2">
      </div>

  <article class="my-3 fs-5">
    {!! $shelter->reason !!}
  </article>
        </div>
    </div>
  </div>
@endsection