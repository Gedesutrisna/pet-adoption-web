@extends('admin.layouts.main')
@section('container')
<div class="container">
    <div class="row my-3">
      <div class="col-lg-8">
        <h1 class="mb-3">{{ $pet->name}}</h1>
    <a href="/dashboard/pets" class="btn btn-primary"><span data-feather="arrow-left"></span> Back To My pet</a>
    <a href="/dashboard/pets/{{ $pet->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
    <form action="/dashboard/pets/{{ $pet->slug }}" method="POST" class="d-inline">
      @method('delete')
      @csrf
      <button class="btn btn-danger" onclick="return confirm('Are U Sure ?')"><span data-feather="x-circle"></span> Delete</button>
      </form>
      
      <div style="max-height: 350px; overflow: hidden; ">
        <img src="{{ asset('storage/' . $pet->image ) }}" alt="{{ $pet->category->name }}"
        class="img-fluid mt-2">
      </div>


  <article class="my-3 fs-5">
    {!! $pet->description !!}
  </article>
        </div>
    </div>
  </div>
@endsection