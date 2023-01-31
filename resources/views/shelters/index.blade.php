@extends('layouts.main')
@section('container')
<div class="container">
  <div class="row">
    @if (empty(Auth::user()->id))
@else
    @if (empty(Auth::user()->ktp))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Hai {{ Auth::user()->name }}</strong>   Tolong untuk Upload <a href="/profile" class="alert-link">Foto Ktp</a> Jika ingin Adopsi atau Shelter
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @else
    @endif
@endif
    <div class="col">
      <img src="assets/main-campaign2.png" alt="" class="img-fluid w-50">
    </div>
    <div class="col-5">
      <p class="text-muted">What Is Shelter <img src="assets/line.png" alt=""></p>
      <h1>Lorem ipsum dolor sit amet, consectetur​</h1>
      <p style="text-justify: auto">Lorem ipsum dolor sit amet, consectetur adipiscing 
        elit. Pellentesque id justo quis arcu egestas luctus 
        quis vitae massa. Pellentesque eget quam nisl. Morbi 
        faucibus nibh vitae aliquam cursus. Nunc tempus ac</p>
        <a href="#shelter" style="background-color: #193A6A; 
        color: white;
        padding: 10px 20px;
        border: none;
        font-size: 16px;
        cursor: pointer;" class="text-decoration-none">See More</a>
    </div>
  </div>
  @if (auth()->check())
  <div class="row" id="shelter" style="margin-top: 10rem">
    <h1 class="mb-3">Form Shelter</h1> 
    <a  name="rules" href="{{ asset('storage/files/file.pdf') }}" id="download-btn" style="text-decoration: none; margin-bottom:2rem" download required>Download Rules before input form<span style="color: red">*</span></a>
<div class="col-lg-8">
  <form method="POST" action="/shelters/create" class="mb-5" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="approval_file" class="form-label">File Aproval <span style="color: red">*</span></label>
      <input class="form-control @error('approval_file') is-invalid @enderror" type="file" id="file-input" name="approval_file">
      @error('approval_file')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
      <div class="mb-3">
        <label for="category" class="form-label">Category <span style="color: red">*</span></label>
        <select class="form-select" name="category_id">
          @foreach ($categories as $category)
          @if (old('category_id') == $category->id)
            <option value="{{ $category->id }}" selected >{{ $category->name}}</option>    
              @else
            <option value="{{ $category->id }}" >{{ $category->name}}</option>
          @endif
          @endforeach
        </select>      
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Photo <span style="color: red">*</span></label>
        <img class="img-preview img-fluid mb-3 col-sm-5">
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
        @error('image')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="file" class="form-label">File Data hewan <span style="color: red">*</span></label>
        <div id="file-preview"></div>
        <input class="form-control @error('file') is-invalid @enderror" type="file" id="file-input" name="file">
        @error('file')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
        <div class="mb-3">
          <label for="reason" class="form-label">Reason <span style="color: red">*</span></label>
          <textarea name="reason" class="form-control @error('reason') is-invalid @enderror" id="reason" value="{{ old('reason') }}" rows="4" placeholder="Alasan anda menitipkan hewan kepada kami.." style="resize: none"></textarea>
          @error('reason')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        <div class="form-group mb-4">
          <label for="confirm">Please confirm your data: </label>
          <input type="checkbox" name="confirm" id="confirm" required><span style="color: red">*</span>
      </div>
      <div class="row justify-content-between">
        <div class="col-auto">
          <button type="button" id="reset-btn" style=" 
          color: #193A6A;
          padding: 8px 36px;
          border-radius: .3rem;
          border: solid 1px #193A6A;
          font-size: 13px;
          cursor: pointer;">Cancel</button>
        </div>
        <div class="col-auto">
      <button type="submit" id="submit-btn"  style="background-color: #193A6A; 
      color: white;
      padding: 8px 36px;
      border-radius: .3rem;
      border: solid 1px #193A6A;
      font-size: 13px;
      cursor: pointer;">Submit</button>
        </div>
      </div>    
    </form>
  </div>
</div>   
  @else
      
  @endif
  <script>
   function previewImage(){
      const image = document.querySelector('#image');
      const imgPreview = document.querySelector('.img-preview');
      imgPreview.style.display = 'block';
      const blob = URL.createObjectURL(image.files[0]);
      imgPreview.src = blob;
   }

//       let submitBtn = document.getElementById("submit-btn");
//       let downloadBtn = document.getElementById("download-btn");

//       submitBtn.disabled = true;

//       if(localStorage.getItem("isDownloaded") === "true") {
//         submitBtn.disabled = false;
//       }
      

//reset button
const resetBtn = document.getElementById("reset-btn");

resetBtn.addEventListener("click", function() {
  const inputs = document.querySelectorAll("form input[type='file']");
  inputs.forEach(input => {
    input.value = "";
  });
  const preview = document.querySelector(".img-preview");
  preview.src = "";
});





</script>
@endsection