@extends('layouts.main')
@section('container')
  <div class="row mt-5">
    @if (empty(Auth::user()->id))
@else
    @if (empty(Auth::user()->ktp))
    <div class="alert alert-warning alert-dismissible fade show" style="font-size: 1.5rem" role="alert">
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
      <p class="text-muted" style="font-size: 14px">What Is Shelter <img src="assets/line.png" alt=""></p>
      <h1>Lorem ipsum dolor sit amet, consectetur​</h1>
      <p style="text-justify: auto;font-size:14px;margin-bottom:20px">Lorem ipsum dolor sit amet, consectetur adipiscing 
        elit. Pellentesque id justo quis arcu egestas luctus 
        quis vitae massa. Pellentesque eget quam nisl. Morbi 
        faucibus nibh vitae aliquam cursus. Nunc tempus ac</p>
        @if (auth()->check())
        <!-- Button trigger modal -->
<button type="button" style="background-color: #193A6A; 
color: white;
padding: 8px 16px;
border: none;
font-size: 16px;
cursor: pointer;"  class="rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Shelter
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title " id="exampleModalLabel" style="font-size: 2rem">Form Shelter</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="font-size: 1.5rem">
        <a  name="rules" href="{{ asset('storage/files/file.pdf') }}" id="download-btn" style="text-decoration: none; margin-bottom:2rem" download required>Download Rules before input form<span style="color: red">*</span></a>
        <form method="POST" action="/shelters/create" class="mt-3" enctype="multipart/form-data">

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
              <label for="file" class="form-label">Animal data files <span style="color: red">*</span></label>
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
                <textarea name="reason" class="form-control @error('reason') is-invalid @enderror" id="reason" value="{{ old('reason') }}" rows="4" placeholder="Give us your reasons" style="resize: none"></textarea>
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
          </div>
          <div class="modal-footer justify-content-between">
                <button type="button" id="reset-btn" style=" 
                color: #193A6A;
                padding: 8px 36px;
                border-radius: .3rem;
                border: solid 1px #193A6A;
                font-size: 13px;
                cursor: pointer;">Cancel</button>
            <button type="submit" id="submit-btn"  style="background-color: #193A6A; 
            color: white;
            padding: 8px 36px;
            border-radius: .3rem;
            border: solid 1px #193A6A;
            font-size: 13px;
            cursor: pointer;">Submit</button>
          </form>
      </div>
    </div>
  </div>
</div>
    
@else
<a href="#" style="background-color: #193A6A; 
color: white;
padding: 10px 20px;
border: none;
font-size: 16px;
cursor: pointer;" onclick="alert('Please log in.'); return false;" class="text-decoration-none rounded-0">Shelter</a>

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

//       let submitBtn = document.getElementById("submit-btn");
//       let downloadBtn = document.getElementById("download-btn");

//       submitBtn.disabled = true;

//       if(localStorage.getItem("isDownloaded") === "true") {
//         submitBtn.disabled = false;
//       }
      

//reset button
const resetBtn = document.getElementById("reset-btn");

resetBtn.addEventListener("click", function() {
  const fileInputs = document.querySelectorAll("form input[type='file']");
  fileInputs.forEach(input => {
    input.value = "";
  });
  const preview = document.querySelector(".img-preview");
  preview.src = "";
  
  const textAreas = document.querySelectorAll("form textarea");
  textAreas.forEach(textarea => {
    textarea.value = "";
  });
  
  const selectInputs = document.querySelectorAll("form select");
  selectInputs.forEach(select => {
    select.selectedIndex = 0;
  });
});


</script>
@endsection