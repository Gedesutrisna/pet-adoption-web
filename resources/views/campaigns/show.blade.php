@extends('layouts.main')
@section('container')
<div class="container">
    <div class="row my-3">
      <div class="col-lg-8">
        <h1 class="mb-3">{{ $campaign->title}}</h1>
      <div style="max-height: 350px; overflow: hidden; ">
        <img src="{{ asset('storage/' . $campaign->image ) }}" alt="{{ $campaign->category->name }}"
        class="img-fluid mt-2">
      </div>

  <article class="my-3 fs-5">
    {!! $campaign->body !!}
  </article>

  @if ($campaign->status !== 'completed')
      
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
      <div class="mb-3">
        <input type="hidden" class="form-control @error('campaign_id') is-invalid @enderror" id="campaign_id" name="campaign_id"  value="{{ old('campaign_id', $campaign->id) }}">
        @error('campaign_id')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>
   
    <button type="submit" class="btn btn-primary">Donate Now</button>
  </form>
  @else
      
  @endif
</div>
</div>
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