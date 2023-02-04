@extends('layouts.main')
@section('container')
<div class="back mt-3 mb-3">
  <a href="/profile"><i   style="font-size: 2rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
</div>
<div class="row">
  <p>campaign</p>
    @foreach (Auth::user()->campaignDonate as $campaignDonate)    
    <div class="col-sm-4 mb-3 mb-sm-0">
        <div class="card  rounded-0">
            <div class="card-body">
              <h1 class="text-center">Details Payment</h1>
              <hr>
                <h5 class="card-title">Amount : {{ $campaignDonate->amount }}</h5>
                <h5 class="card-title">Status : {{ $campaignDonate->status }}</h5>
                <h5 class="card-title">Name : {{ Auth::user()->name }}</h5>
                <h5 class="card-title">Email : {{ Auth::user()->email }}</h5>

                <p class="card-text">Comment : {{ $campaignDonate->comment }}</p>
        </div>
            @if ($campaignDonate->status == 'paid')
                
            @else
            <a style="background-color: #193A6A; 
            color: white;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            cursor: pointer;"  href="/transaction/{{ $campaignDonate->id }}/campaign" class="text-decoration-none text-center">Pay !</a>
            @endif
        </div>
    </div>
    @endforeach
    <p>Adoption</p>
    @foreach (Auth::user()->adoptionDonate as $adoptionDonate)    
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
            @if ($adoptionDonate->status == 'paid')
                
            @else
            <a style="background-color: #193A6A; 
            color: white;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            cursor: pointer;"  href="/transaction/{{ $adoptionDonate->id }}/adoption" class="text-decoration-none text-center">Pay !</a>
            @endif
        </div>
    </div>
    @endforeach
    <p>Shelter</p>
    @foreach (Auth::user()->donateshelter as $donateshelter)    
    <div class="col-sm-4 mb-3 mb-sm-0">
        <div class="card  rounded-0">
            <div class="card-body">
              <h1 class="text-center">Details Payment</h1>
              <hr>
                <h5 class="card-title">Amount : {{ $donateshelter->amount }}</h5>
                <h5 class="card-title">Status : {{ $donateshelter->status }}</h5>
                <h5 class="card-title">Name : {{ Auth::user()->name }}</h5>
                <h5 class="card-title">Email : {{ Auth::user()->email }}</h5>

                <p class="card-text">Comment : {{ $donateshelter->comment }}</p>
        </div>
            @if ($donateshelter->status == 'paid')
                
            @else
            <a style="background-color: #193A6A; 
            color: white;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            cursor: pointer;"  href="/transaction/{{ $donateshelter->id }}/shelter" class="text-decoration-none text-center">Pay !</a>
            @endif
        </div>
    </div>
    @endforeach
    
  </div>
@endsection
