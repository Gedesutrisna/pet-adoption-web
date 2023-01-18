@extends('admin.layouts.main')
@section('container')
<div class="container">
    <div class="row my-3">
      <div class="col-lg-8">
        <h1 class="mb-3">{{ $donate->name}}</h1>
        <p>{{ $donate->email }}</p>
        <p>Rp{{ number_format($donate->amount, 0, ',', '.') }}</p>

  <article class="my-3 fs-5">
    {!! $donate->comment !!}
  </article>
        </div>
    </div>
  </div>
@endsection