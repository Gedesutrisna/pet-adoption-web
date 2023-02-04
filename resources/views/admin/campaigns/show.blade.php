@extends('admin.layouts.main')
@section('container')
<div class="back mt-3">
  <a href="/dashboard/campaigns"><i   style="font-size: 2rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
</div>
<div class="container">
    <div class="row my-3">
      <div class="col-lg-8">
        <h1 class="mb-3">{{ $campaign->title}}</h1>
      <div style="max-height: 350px; overflow: hidden; ">
        <img src="{{ asset('storage/' . $campaign->image ) }}" alt="{{ $campaign->category->name }}"
        class="img-fluid mt-2">
      </div>

  <article class="my-3 fs-5">
    {!! $campaign->body !!}
  </article>
        </div>
    </div>
  </div>
@endsection