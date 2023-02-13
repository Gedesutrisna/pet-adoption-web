@extends('layouts.main-single')
@section('container')
  <div class="back mt-5 mb-3">
    <a href="/pets"><i   style="font-size: 3rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
  </div>
  <div class="row mb-4">
    <div class="col-lg-5">
    <div class="mb-3">
      <div class="position-absolute px-2 py-2 text-white">
        <p style="background-color: #193A6A; 
        color: white;
        padding: 5px 10px;
        border: none;
        font-size: 13px;
        cursor: pointer;">{{ $pet->status }}</p> 
      </div>
      <div class="mb-3">
        <img src="{{ asset('storage/' . $pet->image ) }}" alt="{{ $pet->category->name }}"
        class="img-fluid" style="width:800px; height:300px;">
      </div>
      
    </div>
      </div>
      <div class="col">
        <h1 style="font-size: 4rem">{{ $pet->name}}</h1>
        <p style="font-size: 14px;color:#e67e22" class="mb-0">{{ $pet->category->name }}</p> 
        <p style="font-size: 14px">Quantity {{ $pet->quantity }}</p> 
        <article style="font-size: 16px" class="my-3 ">
          {{ $pet->description }}
        </article>
  @if ($pet->status == 'Available')
  @if (auth()->check())
    <!-- Button trigger modal -->
  <button type="button" style="background-color: #193A6A; 
  color: white;
  padding: 8px 16px;
  border-radius: .3rem;
  border: solid 1px #193A6A;
  font-size: 13px;
  cursor: pointer;" class="btn rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Adoption Now
  </button>
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel" style="font-size: 2rem">Form Adoption</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="font-size: 1.5rem">
        <a name="rules" href="{{ asset('storage/files/file.pdf') }}" id="download-btn" style="text-decoration: none; margin-bottom:2rem" download required>Download Rules before input form<span style="color: red">*</span></a>
        <form class="mt-3" method="POST" action="/adoptions/create" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label for="approval_file" class="form-label">File Approval <span style="color: red">*</span></label>
            <input class="form-control @error('approval_file') is-invalid @enderror" type="file" id="file-input" name="approval_file">
            @error('approval_file')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="quantity" class="form-label">Quantity <span style="color: red">*</span></label>
            <input type="number" name="quantity" min="1" max="{{ $pet->quantity }}" value="1" required value="{{ old('quantity') }}">
            @error('quantity')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
          </div>
          <div class="mb-3">
           <label for="reason" class="form-label">Reason <span style="color: red">*</span></label>
           <textarea name="reason" class="form-control @error('reason') is-invalid @enderror" id="reason" value="{{ old('reason') }}" rows="4" placeholder="Give us your reasons..." style="resize: none"></textarea>
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
            <div class="form-group">
              <label for="confirm">Please confirm your data:</label>
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
        padding: 8px 16px;
        border-radius: .3rem;
        border: solid 1px #193A6A;
        font-size: 13px;
        cursor: pointer;"  onclick="alert('Please log in.'); return false;" class="btn rounded-0">Adoption Now</a>
        @endif

            
        @endif
      </div>
  </div>
 
<script>
  const resetBtn = document.getElementById("reset-btn");

resetBtn.addEventListener("click", function() {
  const fileInputs = document.querySelectorAll("form input[type='file']");
  fileInputs.forEach(input => {
    input.value = "";
  });

  const textAreas = document.querySelectorAll("form textarea");
  textAreas.forEach(textarea => {
    textarea.value = "";
  });
  
  const numberInputs = document.querySelectorAll("form input[type='number']");
numberInputs.forEach(input => {
  input.value = 1;
});

});

</script>
@endsection