@extends('layouts.main')
@section('container')
<div class="container">
  <div class="back mb-3">
    <a href="/campaigns"><i   style="font-size: 2rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
  </div>
    <div class="row my-3">
      <h1>{{ $campaign->title}}</h1>
      <p class="mb-3">{{ $campaign->category->name}}</p>
      <div class="col-lg-6">
        <div class="position-absolute px-2 py-2 text-white">
          <p style="background-color: #193A6A; 
          color: white;
          padding: 8px 20px;
          border: none;
          font-size: 18px;
          cursor: pointer;">{{ $campaign->status }}</p> 
          </div>
      <div class="mb-3">
        <img src="{{ asset('storage/' . $campaign->image ) }}" alt="{{ $campaign->category->name }}"
        class="img-fluid" style="width:800px; height:350px;">
      </div>
      <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {{ $campaign->percentage() }}%" aria-valuenow="{{ $campaign->percentage() }}" aria-valuemin="0" aria-valuemax="100"></div>
        <span class="progress-bar-label position-absolute">{{ $campaign->percentage() }}%</span>
      </div>
      <div class="row justify-content-between">
        <div class="col-5">
          <p style="font-size: .8rem; text-align:left;">Raised:
            @if($campaign->donations)
            Rp{{ number_format($campaign->donations->sum('amount'), 0, ',', '.') }}
            @else
            Rp0
            @endif
          </p>
        </div>
        <div class="col">
          <p style="font-size: .8rem; text-align:right;"> 
            Goal:Rp{{ number_format($campaign->donation_target, 0, ',', '.') }}</p>
        </div>
      </div>
    </div>
    <div class="col">

      <article class="my-3 fs-6">
        {!! $campaign->body !!}
      </article>
    </div>
    
    </div>
  @if ($campaign->status !== 'completed')
  @if (auth()->check())
      
  <div class="row">
   <div class="col-5">

     <form method="POST" action="/donates/create" class="mb-5">
       @csrf
       <div class="mb-3">
           <label for="amount" class="form-label">Amount</label>
           <input type="number" name="amount"  class="form-control @error('amount') is-invalid @enderror"  id="amount" min="50000" max="{{ $campaign->donate_target }}" step="1000" required value="{{ old('amount') }}">
           
           @error('amount')
           <div class="invalid-feedback">
               {{ $message }}
             </div>
             @enderror
             <br>
             <button style=" 
             color: #193A6A;
             padding: 8px 36px;
             border: solid 1px #193A6A;
             font-size: 13px;
             cursor: pointer;" class="nominal" value="50000" onclick="setAmount(50000); return false;">Rp {{ number_format(50000, 0, ',', '.') }}</button>
             <button style=" 
             color: #193A6A;
             padding: 8px 36px;
             border: solid 1px #193A6A;
             font-size: 13px;
             cursor: pointer;" class="nominal" value="100000" onclick="setAmount(100000); return false;">Rp {{ number_format(100000, 0, ',', '.') }}</button>
             <button style=" 
             color: #193A6A;
             padding: 8px 36px;
             border: solid 1px #193A6A;
             font-size: 13px;
             cursor: pointer;" class="nominal" value="500000" onclick="setAmount(500000); return false;">Rp {{ number_format(500000, 0, ',', '.') }}</button>
         </div>
         <div class="mb-3">
           <label for="comment" class="form-label">Comment <span style="color: red">*</span></label>
           <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" id="comment" value="{{ old('comment') }}" rows="4" placeholder="Alasan anda menitipkan hewan kepada kami.." style="resize: none"></textarea>
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
     </form>
   </div>
 </div> 
  @else
      
  @endif
  @else
      
  @endif

</div>
<script>
  let nominal = document.querySelectorAll('.nominal');
  let amount = document.getElementById('amount');
  function setAmount(amount) {
        document.getElementById("amount").value = amount;
    }
  nominal.forEach(function(el) {
      el.addEventListener('click', function() {
          amount.value = this.value;
      });
  });
</script>
@endsection