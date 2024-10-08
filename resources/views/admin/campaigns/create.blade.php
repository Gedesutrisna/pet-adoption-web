@extends('admin.layouts.main')
@section('container')
<div class="back mt-3">
  <a href="/dashboard/campaigns"><i   style="font-size: 2rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Campaign</h1>
    </div>
  <div class="col-lg-8">
    <form method="POST" action="/dashboard/campaigns" class="mb-5" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
        required autofocus value="{{ old('title') }}">
        @error('title')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>
      <div class="mb-3">
        <input type="hidden" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
        required value="{{ old('slug') }}">
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
          @if (old('category_id') == $category->id)
            <option value="{{ $category->id }}" selected>{{ $category->name}}</option>    
              @else
            <option value="{{ $category->id }}">{{ $category->name}}</option>
          @endif
          @endforeach
        </select>      
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <img class="img-preview img-fluid mb-3 col-sm-5">
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
        @error('image')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        @error('body')        
        <p class="text-danger">{{ $message }}</p>
        @enderror
          <input id="body" type="hidden" name="body" value="{{ old('body') }}">
          <trix-editor input="body"></trix-editor>
      </div>
      <div class="mb-3">
        <label for="donation_target" class="form-label">Donation Target</label>
        <input type="number" name="donation_target"  class="form-control @error('donation_target') is-invalid @enderror"  id="donation_target" min="50000" step="1000" value="{{ old('donation_target') }}">
        
        @error('donation_target')
        <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror

      </div>
      <div class="mb-3">
        <label for="date_target">Donation Date</label>
        <input type="date" name="date_target" value="{{ old('date_target', date('Y-m-d')) }}" class="form-control">
        @error('date_target')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    

      <button type="submit"style="background-color: #193A6A; 
      color: white;
      padding: 10px 16px;
      border: none;
      font-size: 13px;
      cursor: pointer;">Create Campaign</button>
    </form>
  </div>
  <script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function(){
      fetch('/dashboard/campaigns/checkSlug?title=' + title.value)
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