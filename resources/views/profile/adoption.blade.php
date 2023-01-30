@extends('layouts.main')
@section('container')
<style>
    .progress-container {
      display: flex;
      align-items: center;
      width: 100%;
      height: 20px;
      background-color: #e0e0e0;
      border-radius: 10px;
      margin-top: 30px;
    }
    
    .progress-bar {
      height: 100%;
      border-radius: 10px;
      background-color: #4CAF50;
      width: 0%;
    }
    
    .step {
      flex-grow: 1;
      text-align: center;
      color: #ffffff;
      font-weight: bold;
    }
  </style>
<div class="row">        
    <div class="col-sm-4 mb-3 mb-sm-0">
        <div class="card">
            <div class="card-body">
                <div class="progress-container">
                    <div class="progress-bar" id="progress-bar"></div>
                    <div class="step" id="step-1">In Progress</div>
                    <div class="step" id="step-2">Approved</div>
                    <div class="step" id="step-3">Completed</div>
                  </div>
  
                <div style="max-height: 350px; overflow: hidden; ">
                    <div class="position-absolute px-3 py-2 text-white">
                      {{ $adoption->status }}
                    </div>
                    <img src="{{ asset('storage/' . $adoption->pet->image ) }}" alt="{{ $adoption->pet->category->name }}"
                    class="img-fluid mt-2">
                  </div>
                  <p> kode untuk donasi : {{ $adoption->code }}</p>
                  @if ($adoption->status == 'pending')              
                  <a href="{{ asset($adoption->approval_file) }}" download>Download File</a>
                  @else
                  @endif
                <p class="card-text">{{ $adoption->reason }}</p>
                @if ($adoption->status == 'approved')      
                <form method="POST" action="/donates/create" class="mb-5">
                  @csrf
                  
                  <div class="mb-3" style="display: none">
                    <label for="method" class="form-label">Method <span style="color: red">*</span></label>
                    <select class="form-select" name="method">
                      <option value="adoption">Adoption</option>
                    </select>      
                  </div>                  
                  <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" name="amount"  class="form-control rounded-0 @error('amount') is-invalid @enderror"  id="amount" min="50000" step="1000" required value="{{ old('amount') }}">
                    
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
                  <div class="mb-3" id="adoption-input">
                    <label for="code" class="form-label">Code</label>
                    <input type="text" class="form-control rounded-0 @error('code') is-invalid @enderror" id="code" name="code"  value="{{ old('code') }}" required>
                    @error('code')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="comment" class="form-label">comment</label>
                    <textarea class="form-control rounded-0 @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3"value="{{ old('comment') }}" style="resize: none"></textarea>
                    @error('comment')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                    @enderror
                  </div>   
             </div>
             <div class="modal-footer">
               <button type="submit" style=" 
               color: #193A6A;
               padding: 8px 36px;
               border: solid 1px #193A6A;
               font-size: 13px;
               cursor: pointer;" class="rounded-0">Donate Now</button>
                @else
                    
                @endif
            </div>
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

const progressBar = document.getElementById("progress-bar");
const step1 = document.getElementById("step-1");
const step2 = document.getElementById("step-2");
const step3 = document.getElementById("step-3");

function updateProgress(status) {
  switch (status) {
    case "inprogress":
      progressBar.style.width = "33.33%";
      step1.style.color = "black";
      break;
    case "approved":
      progressBar.style.width = "66.66%";
      step1.style.color = "black";
      step2.style.color = "black";
      break;
    case "completed":
      progressBar.style.width = "100%";
      step1.style.color = "black";
      step2.style.color = "black";
      step3.style.color = "black";
      break;
  }
}

updateProgress("{{ $adoption->status }}");

  </script>
@endsection
