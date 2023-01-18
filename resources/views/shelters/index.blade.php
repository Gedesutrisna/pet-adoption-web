@extends('layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Form Shelter</h1>
    
    </div>
  <div class="col-lg-8">
    <form method="POST" action="/shelters/create" class="mb-5" enctype="multipart/form-data">
      @csrf
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
        <label for="category" class="form-label">Category</label>
        <select class="form-select" name="category_id">
          @foreach ($categories as $category)
          @if (old('category_id') == $category->id)
            <option value="{{ $category->id }}" selected>{{ $category->name}}</option>    
              @else
            <option value="{{ $category->id }}">{{ $category->name}}</option>
          @endif
          @endforeach
        </select>      
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Photo</label>
        <img class="img-preview img-fluid mb-3 col-sm-5">
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
        @error('image')
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
        <label for="file" class="form-label">File Data hewa</label>
        <input class="form-control @error('file') is-invalid @enderror" type="file" id="image" name="file" onchange="previewImage()">
        @error('file')
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
     
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
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