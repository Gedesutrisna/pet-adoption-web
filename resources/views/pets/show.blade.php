@extends('layouts.main')
@section('container')
<div class="container">
  <div class="back">
    <a href="/pets" class="btn btn-primary">Back</a>
  </div>
    <div class="row my-3">
      @if (session('success'))
      <div class="alert alert-success" role="alert">
         {{session('success')}}
         </div> 
      @endif
      @if (session('error'))
      <div class="alert alert-danger" role="alert">
         {{session('error')}}
         </div> 
      @endif
      <div class="col-lg-8">
        <h1 class="mb-3">{{ $pet->name}}</h1>
      
      <div style="max-height: 350px; overflow: hidden; ">
        <div class="position-absolute px-3 py-2 text-white">
          {{ $pet->status }}
                  </div>
        <img src="{{ asset('storage/' . $pet->image ) }}" alt="{{ $pet->category->name }}"
        class="img-fluid mt-2">
      </div>

  <article class="my-3 fs-5">
    {!! $pet->description !!}
  </article>

        </div>
        @if ($pet->status == 'available')
            
        <div class="col-lg-8">
          <form method="POST" action="/adoptions/create/{{ $pet->id }}" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="quantity" class="form-label">quantity</label>
              <input type="number" name="quantity" min="1" max="{{ $pet->quantity }}" value="1" required value="{{ old('quantity',$pet->quantity) }}">
              @error('quantity')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
              required autofocus value="{{ old('name') }}">
              @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
              required  value="{{ old('email') }}">
              @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="ktp" class="form-label">Ktp</label>
              <img class="img-preview img-fluid mb-3 col-sm-5">
              <input class="form-control @error('ktp') is-invalid @enderror" type="file" id="image" name="ktp" onchange="previewImage()">
              @error('ktp')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
              <div class="mb-3">
                <label for="reason" class="form-label">Reason</label>
                <input type="text" class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason"  value="{{ old('reason') }}">
                @error('reason')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="mb-3">
                <input type="hidden" class="form-control @error('pet_id') is-invalid @enderror" id="pet_id" name="pet_id"  value="{{ old('pet_id', $pet->id) }}">
                @error('pet_id')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="mb-3">
                <input type="hidden" class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id"  value="{{ old('category_id', $pet->id) }}">
                @error('category_id')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
              </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        @else
            
        @endif
    </div>
  </div>
  <script>
    function previewImage(){
       const image = document.querySelector('#image');
       const imgPreview = document.querySelector('.img-preview');
 
       imgPreview.style.display = 'block';
 
       const blob = URL.createObjectURL(image.files[0]);
 imgPreview.src = blob;
       }
     
 
     
   </script>
@endsection