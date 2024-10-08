@extends('admin.layouts.main')
@section('container')
<div class="back mt-3 d-flex justify-content-between align-items-center">
  <a href="/dashboard/pets"><i   style="font-size: 2rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
</div>
<h1 class="h2">Single Page</h1>
<hr>
<div class="container">
    <div class="row my-3">
      <div class="col-lg-8">
        <h1 class="mb-3">{{ $pet->name}}</h1>

      <div style="max-height: 350px; overflow: hidden; ">
        <img src="{{ asset('storage/' . $pet->image ) }}" alt="{{ $pet->category->name }}"
        class="img-fluid mt-2">
      </div>
<p>Quantity : {{ $pet->quantity }}</p>

  <article class="my-3 fs-5">
    {!! $pet->description !!}
  </article>
        </div>
    </div>
  </div>
@endsection