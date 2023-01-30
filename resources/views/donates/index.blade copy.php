@extends('layouts.main')
@section('container')
<div class="container">
  @foreach ( $campaigns as $campaign)
  <h1 class="mb-3">{{ $campaign->title}}</h1>
  <div style="max-height: 350px; overflow: hidden; ">
    <img src="{{ asset('storage/' . $campaign->image ) }}" alt="{{ $campaign->category->name }}"
    class="img-fluid mt-2">
  </div>
  @endforeach 
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  @if (session('error'))
  <div class="alert alert-danger" role="alert">
     {{session('error')}}
     </div> 
  @endif
    <h1 class="h2">Donate</h1>
    <div class="mb-3">
      <label for="input-type" class="form-label"> <span style="color: red">*</span> Donate Untuk</label>
      <select class="form-control @error('input-type') is-invalid @enderror" id="input-type" name="input-type">
        <option value="back">Default</option>
        <option value="adoption">Adoption</option>
        <option value="shelter">Shelter</option>
      </select>
      @error('input-type')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
      @enderror
    </div>
    
    </div>
  <div class="col-lg-8">
<button class="nominal" value="50000">Rp {{ number_format(50000, 0, ',', '.') }}</button>
<button class="nominal" value="100000">Rp {{ number_format(100000, 0, ',', '.') }}</button>
<button class="nominal" value="500000">Rp {{ number_format(500000, 0, ',', '.') }}</button>
    <form method="POST" action="/donates/create" class="mb-5">
      @csrf
      <div class="mb-3">
          <label for="amount" class="form-label">Amount</label>
          <input type="number" name="amount"  class="form-control @error('amount') is-invalid @enderror"  id="amount" min="50000" step="1000" required value="{{ old('amount') }}">
          
          @error('amount')
          <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="comment" class="form-label">comment</label>
          <input type="text" class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment"  value="{{ old('comment') }}">
          @error('comment')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>   
        <div class="mb-3" id="adoption-input" style="display: none;">
          <label for="adoption_id" class="form-label">Code Adoption</label>
          <input type="text" class="form-control @error('adoption_id') is-invalid @enderror" id="adoption_id" name="adoption_id"  value="{{ old('adoption_id') }}">
          @error('adoption_id')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        
        <div class="mb-3" id="shelter-input" style="display: none;">
          <label for="shelter_id" class="form-label">Code Shelter</label>
          <input type="text" class="form-control @error('shelter_id') is-invalid @enderror" id="shelter_id" name="shelter_id"  value="{{ old('shelter_id') }}">
          @error('shelter_id')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
     
      <button type="submit" class="btn btn-primary">Donate Now</button>
    </form>
  </div>
  <script>
    let nominal = document.querySelectorAll('.nominal');
    let amount = document.getElementById('amount');

    nominal.forEach(function(el) {
        el.addEventListener('click', function() {
            amount.value = this.value;
        });
    });


    let inputType = document.getElementById("input-type");
let adoptionInput = document.getElementById("adoption-input");
let shelterInput = document.getElementById("shelter-input");

inputType.addEventListener("change", function() {
    if(inputType.value === 'adoption') {
        adoptionInput.style.display = "block";
        shelterInput.style.display = "none";
    } else if (inputType.value === 'shelter'){
        adoptionInput.style.display = "none";
        shelterInput.style.display = "block";
    } else if (inputType.value === 'back') {
        adoptionInput.style.display = "none";
        shelterInput.style.display = "none";
    }
});


</script>

@endsection