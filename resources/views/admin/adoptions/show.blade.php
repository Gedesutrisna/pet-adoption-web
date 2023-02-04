@extends('admin.layouts.main')
@section('container')
<div class="back mt-3">
  <a href="/dashboard/adoptions"><i   style="font-size: 2rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
</div>
<div class="container">
    <div class="row my-3">
      <div class="col-lg-8">
        <h1 class="mb-3">{{ $adoption->user->name}}</h1>
       <p>{{ $adoption->user->email }}</p>
       <h1 class="mb-3">{{ $adoption->pet->name}}</h1>
      
       <div style="max-height: 350px; overflow: hidden; ">
         <img src="{{ asset('storage/' . $adoption->pet->image ) }}" alt="{{ $adoption->pet->category->name }}"
         class="img-fluid mt-2">
       </div>
  <article class="my-3 fs-5">
    {!! $adoption->reason !!}
  </article>
        </div>
    </div>
  </div>
@endsection