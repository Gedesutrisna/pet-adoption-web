@extends('layouts.main-single')
@section('container')
<div class="back mt-3 mb-3">
  <a href="/data/donations"><i   style="font-size: 3rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
</div>
<div class="row justify-content-center" style="margin-bottom: 100px">        
  <div class="col-sm-4 mb-3 mb-sm-0">
        <div class="card  rounded-0" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <div class="card-body">
              <h1 class="text-center">Details Payment</h1>
              <hr>
              <p class="text-muted mb-0 text-center" style="font-size: 16px">---User Datails---</p>
              <p class="mb-0" style="font-size: 14px">Name  : {{auth()->user()->name}}</p>
              <p class="mb-0" style="font-size: 14px">Email : {{auth()->user()->email}}</p>
              <p class="mb-0" style="font-size: 14px">Phone : {{auth()->user()->phone}}</p>
              <p class="mb-2" style="font-size: 14px">Address : {{auth()->user()->address}}</p>
              <p class="text-muted mb-0 text-center" style="font-size: 16px">---Donate Datails---</p>
              <p class="mb-0" style="font-size: 14px">Amount : Rp{{ number_format($donate->amount, 0, ',', '.') }}</p>
              @if ($donate->status == null)
              <p class="mb-0" style="font-size: 14px">Status : {{$donate->status}}</p>
              @else
              <p class="mb-0" style="font-size: 14px">Status : -</p>
                  
              @endif
              <p class="mb-0" style="font-size: 14px">Comment : {{$donate->comment}}</p>
            </div>
                <button style="background-color: #193A6A; 
                color: white;
                padding: 10px 20px;
                border: solid 1px #193A6A;
                font-size: 16px;
                cursor: pointer;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;"  id="pay-button">Pay Now !</button>
        </div>
    </div>
  </div>
  <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
          /* You may add your own implementation here */
          window.location.href = '/data/donations'
          alert("payment success!"); console.log(result);
        },
        onPending: function(result){
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function(result){
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      })
    });
  </script>
@endsection
