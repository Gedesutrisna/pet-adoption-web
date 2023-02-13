@extends('admin.layouts.main')
@section('container')
<div class="back mt-3">
  <a href="/dashboard/pets" ><i   style="font-size: 2rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Pet</h1>

    </div>
  <div class="col-lg-8">
    <form method="POST" action="/dashboard/pets/{{ $pet->slug }}" class="mb-5" enctype="multipart/form-data">
      @method('put')
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        required autofocus value="{{ old('name', $pet->name) }}">
        @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>
      <div class="mb-3">
        <input type="hidden" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
        required value="{{ old('slug', $pet->slug) }}">
        @error('slug')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" name="category_id">
          @foreach ($categories as $category)
          @if (old('category_id', $pet->category_id) == $category->id)
            <option value="{{ $category->id }}" selected>{{ $category->name}}</option>    
              @else
            <option value="{{ $category->id }}">{{ $category->name}}</option>
          @endif
          @endforeach
        </select>      
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Pet Image</label>

        @if ($pet->image)
        <img src="{{ asset('storage/' . $pet->image ) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
        @else
        <img class="img-preview img-fluid mb-3 col-sm-5">
        @endif
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
        @error('image')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        @error('description')        
        <p class="text-danger">{{ $message }}</p>
        @enderror
          <input id="description" type="hidden" name="description" value="{{ old('description', $pet->description) }}">
          <trix-editor input="description"></trix-editor>
      </div>
      <div class="mb-3">
        <label for="quantity" class="form-label">quantity</label>
        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity"
        required value="{{ old('quantity', $pet->quantity) }}">
        @error('quantity')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>


      <button type="submit" style="background-color: #193A6A; 
      color: white;
      padding: 10px 16px;
      border: none;
      font-size: 13px;
      cursor: pointer;">Update Post</button>
    </form>
  </div>
  <script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function(){
      fetch('/dashboard/pets/checkSlug?name=' + name.value)
      .then(response => response.json())
      .then(data => slug.value = data.slug)
    });
    document.addEventListener('trix-fileaccept', function(e){
      e.preventDefault();
    })

    function previewImage(){
      const image = document.querySelector('#image');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const blob = URL.createObjectURL(image.files[0]);
imgPreview.src = blob;
      }
    

    
  </script>
@endsection