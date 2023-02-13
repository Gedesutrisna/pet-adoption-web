@extends('layouts.main-single')
@section('container')
<style>
    .progress-container {
      display: flex;
      position: relative;
      align-items: center;
      width: 100%;
      height: 20px;
      background-color: #e0e0e0;
      margin-top: 10px;
    }
    
    .progress-bar {
      height: 100%;
      border-radius: 0px 10px 10px 0px;
      background-color: #157347;
      width: 0%;
    }
    
    .step {
      position: absolute;
      width: 33.33%;
      text-align: center;
      color: #ffffff;
      font-weight: bold;
    }

  </style>
<div class="back mt-3 mb-3">
  <a href="/data/adoptions"><i   style="font-size: 3rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
  </div>
  <div class="row justify-content-center" style="margin-bottom: 100px">        
    <div class="col-sm-4 mb-3 mb-sm-0">
      <div class="card rounded-0" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <div class="card-body">
                <div class="progress-container mb-3">
                    <div class="progress-bar" id="progress-bar"></div>
                    <div class="step text-white" id="step-1">In Progress</div>
                    <div class="step text-white" id="step-2">Approved</div>
                    <div class="step text-white" id="step-3">Completed</div>
                  </div>
                  <div class="row d-flex justify-content-center">
                    
                    <div class="col" style="font-size: 1.5rem">
                      <h3 class="text-center" style="font-size: 2rem">Submission Details</h3>
                      <hr>
                      <li>Pet Adoption Data</li>
                      <div class="mb-3 text-center" style="max-height: 200px; overflow: hidden; ">
                        <h3 class="text-center">Pet Name : {{ $adoption->pet->name }}</h3>
                        <img src="{{ asset('storage/' . $adoption->pet->image ) }}" alt="{{ $adoption->category->name }}"
                        class="img-fluid mt-2">
                      </div>
                      <li class="mb-3">Quantity : {{ $adoption->quantity }}</li>
                      <li class="mb-3">
                        <a href="{{ asset('storage/' . $adoption->approval_file ) }}" target="_blank"><i class="bi bi-file-earmark-arrow-down"></i>Approval File</a>
                      </li>
                      <li>Reason :
                        
                        {{ $adoption->reason }}
                      </li>
                      <hr>
                      <p class="mb-0 text-center">Code For Donation : {{ $adoption->code }}</p>
                    </div>
                  </div>
                  </div>
             @if ($adoption->status == 'Approved')      
            <!-- Button trigger modal -->
       <button type="button" style="background-color: #193A6A; 
       color: white;
       padding: 8px 36px;
       border-radius: .3rem;
       border: solid 1px #193A6A;
       font-size: 13px;
       cursor: pointer;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" class="btn rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
         Donate Now !
       </button>
       
       <!-- Modal -->
       <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
               <h1 class="modal-title" id="exampleModalLabel" style="font-size: 2rem">Donate</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body" style="font-size: 1.5rem">
               <form method="POST" action="/donates/create">
                 @csrf
                 <div class="mb-3">
                     <label for="amount" class="form-label">Amount</label>
                     <input type="number" name="amount"  class="form-control @error('amount') is-invalid @enderror"  id="amount" min="50000" step="10000" required value="{{ old('amount') }}">
                     
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
                       padding: 6px 20px;
                       border: solid 1px #193A6A;
                       font-size: 13px;
                       cursor: pointer; " class="nominal" value="250000" onclick="setAmount(250000); return false;">Rp {{ number_format(250000, 0, ',', '.') }}</button>
                       <button style=" 
                       color: #193A6A;
                       padding: 8px 36px;
                       border: solid 1px #193A6A;
                       font-size: 13px;
                       cursor: pointer;" class="nominal" value="500000" onclick="setAmount(500000); return false;">Rp {{ number_format(500000, 0, ',', '.') }}</button>
                   </div>
                   <div class="mb-3">
                     <label for="code" class="form-label">code <span style="color: red">*</span></label>
                     <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="code" value="{{ old('code') }}">
                     @error('code')
                         <div class="invalid-feedback">
                           {{ $message }}
                         </div>
                     @enderror
                   </div>
                   <div class="mb-3">
                     <label for="comment" class="form-label">Comment <span style="color: red">*</span></label>
                     <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" id="comment" value="{{ old('comment') }}" rows="4" placeholder="Type your comment" style="resize: none"></textarea>
                     @error('comment')
                         <div class="invalid-feedback">
                           {{ $message }}
                         </div>
                     @enderror
                   </div>
                   <div class="mb-3">
                     <input type="hidden" class="form-control @error('adoption_id') is-invalid @enderror" id="adoption_id" name="adoption_id"  value="{{ old('adoption_id', $adoption->id) }}">
                     @error('adoption_id')
                         <div class="invalid-feedback">
                           {{ $message }}
                         </div>
                     @enderror
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
             </div>
           </form>
        </div>
    </div>
    </div>

 
            @else
                
            @endif
        </div>
  </div>
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
    const progressBar = document.getElementById("progress-bar");
const step1 = document.getElementById("step-1");
const step2 = document.getElementById("step-2");
const step3 = document.getElementById("step-3");

function updateProgress(status) {
  switch (status) {
    case "Inprogress":
      progressBar.style.width = "33.33%";
      step1.style.left = "0%";
      step2.style.left = "33.33%";
      step3.style.left = "66.66%";
      break;
    case "Approved":
      progressBar.style.width = "66.66%";
      step1.style.left = "0%";
      step2.style.left = "33.33%";
      step3.style.left = "66.66%";
      break;
    case "Completed":
      progressBar.style.width = "100%";
      step1.style.left = "0%";
      step2.style.left = "33.33%";
      step3.style.left = "66.66%";
      break;
  }
}
updateProgress("{{ $adoption->status }}");


const resetBtn = document.getElementById("reset-btn");

resetBtn.addEventListener("click", function() {
  
  const textInputs = document.querySelectorAll("form input[type='text']");
  textInputs.forEach(input => {
    input.value = "";
  });
  
  const textAreas = document.querySelectorAll("form textarea");
  textAreas.forEach(textarea => {
    textarea.value = "";
  });
  

  const numberInputs = document.querySelectorAll("form input[type='number']");
numberInputs.forEach(input => {
  input.value = "";
});
  
});
  </script>
@endsection

