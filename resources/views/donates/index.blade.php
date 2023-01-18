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
    <h1 class="h2">Donate</h1>
    </div>
  <div class="col-lg-8">
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
<br>
<button class="nominal" value="50000">Rp {{ number_format(50000, 0, ',', '.') }}</button>
<button class="nominal" value="100000">Rp {{ number_format(100000, 0, ',', '.') }}</button>
<button class="nominal" value="500000">Rp {{ number_format(500000, 0, ',', '.') }}</button>

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
          <label for="comment" class="form-label">comment</label>
          <input type="text" class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment"  value="{{ old('comment') }}">
          @error('comment')
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
</script>

@endsection