@extends('layouts.main')
@section('container')
<div class="row">
    @foreach (Auth::user()->donate as $donate)  
    <div class="col-sm-4 mb-3 mb-sm-0">
        <div class="card  rounded-0">
            <div class="card-body">
              <h1 class="text-center">Details Payment</h1>
              <hr>
                <h5 class="card-title">Amount : {{ $donate->amount }}</h5>
                <h5 class="card-title">Status : {{ $donate->status }}</h5>
                <h5 class="card-title">Name : {{ Auth::user()->name }}</h5>
                <h5 class="card-title">Email : {{ Auth::user()->email }}</h5>
                <h5 class="card-title"> Jenis Donate :
                  @if($donate->adoption_id)
                      Adopsi {{ $donate->adoption_id }}
                      @elseif($donate->shelter_id)
                      Shelter {{ $donate->shelter_id }}
                      @elseif($donate->campaign_id)
                      Campaign {{ $donate->campaign_id }}
                  @elseif(!$donate->adoption_id && !$donate->shelter_id && !$donate->campaign_id)
                      Default
                  @endif
              </h5>
                <p class="card-text">Comment : {{ $donate->comment }}</p>
        </div>
            @if ($donate->status == 'paid')
                
            @else
            <a style="background-color: #193A6A; 
            color: white;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            cursor: pointer;"  href="/transaction/{{ $donate->id }}" class="text-decoration-none text-center">Pay !</a>
            @endif
        </div>
    </div>
    @endforeach
  </div>
@endsection
