@extends('layouts.main')
@section('container')
<div class="row">        
    <div class="col-sm-4 mb-3 mb-sm-0">
        <div class="card  rounded-0">
            <div class="card-body">
              <h1 class="text-center">Details Payment</h1>
              <hr>
                <h5 class="card-title">Amount : {{ $adoptionDonate->amount }}</h5>
                <h5 class="card-title">Status : {{ $adoptionDonate->status }}</h5>
                <h5 class="card-title">Name : {{ Auth::user()->name }}</h5>
                <h5 class="card-title">Email : {{ Auth::user()->email }}</h5>
                <p class="card-text">Comment : {{ $adoptionDonate->comment }}</p>
            </div>
                <button style="background-color: #193A6A; 
                color: white;
                padding: 10px 20px;
                border: solid 1px #193A6A;
                font-size: 16px;
                cursor: pointer;"  id="pay-button">Pay Now !</button>
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
          window.location.href = '/data/adoptions'
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
