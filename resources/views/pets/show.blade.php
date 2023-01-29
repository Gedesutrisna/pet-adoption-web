@extends('layouts.main')
@section('container')
<div class="container">
  <div class="back mb-3">
    <a href="/pets"><i   style="font-size: 2rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
  </div>
  <div class="row mb-4">
    <div class="col-lg-5">
    <div style="max-height: 350px; overflow: hidden; ">
      <div class="position-absolute px-4 py-4 text-white">
        {{ $pet->status }}
                </div>
      <img src="{{ asset('storage/' . $pet->image ) }}" alt="{{ $pet->category->name }}"
      class="img-fluid mt-2">
      
    </div>
      </div>
      <div class="col">
        <h1>{{ $pet->name}}</h1>
        <p class="mb-0">{{ $pet->category->name }}</p> 
        <p>Quantity {{ $pet->quantity }}</p> 
<article class="my-3 fs-6">
  {{ $pet->description }}
</article>
      </div>
  </div>
        @if ($pet->status == 'available')
        @if (auth()->check())
            
        <div class="row">
          <h1 class="mb-3">Form Adoption</h1>
          <a  name="rules" href="{{ asset('storage/files/file.pdf') }}" id="download-btn" style="text-decoration: none; margin-bottom:2rem" download required>Download Rules before input form<span style="color: red">*</span></a>
          <div class="col-lg-8">
          <form method="POST" action="/adoptions/create/{{ $pet->id }}" class="mb-5" enctype="multipart/form-data">
              @csrf
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
               <textarea name="reason" class="form-control @error('reason') is-invalid @enderror" id="reason" value="{{ old('reason') }}" rows="4" placeholder="Alasan anda menitipkan hewan kepada kami.." style="resize: none"></textarea>
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
                <div class="form-group mb-4">
                  <label for="confirm">Please confirm your data:</label>
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
        @else
            
        @endif
    </div>
  </div>

@endsection