@extends('layouts.main')
@section('container')
<div class="container" style="margin-bottom:2rem">
  <h1 class="text-center" style="font-family: Playfair Display">Campaigns </h1>
  <p class="text-center" style="font-family: Roboto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br> sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
  </div>

@if ($campaigns->count())
<div class="container">
  <div class="row" id="campaign">
    @foreach ($campaigns as $campaign)
    <div class="col-md-3 mb-3">
      <div class="card border-0 rounded-0" style="box-shadow: 3px 3px 10px #ccc;">
        <div class="position-absolute px-2 py-2 text-white">
         <p style="background-color: #193A6A; 
         color: white;
         padding: 5px 10px;
         border: none;
         font-size: 13px;
         cursor: pointer;">{{ $campaign->status }}</p> 
        </div>
        <img src="{{ asset('storage/' . $campaign->image ) }}" alt="{{ $campaign->category->name }}"
        class="img-fluid" style="width:300px; height:210px;">
        <div class="card-body">
          <a href="/campaigns?category={{ $campaign->category->slug }}" class="text-decoration-none">{{ $campaign->category->name }}</a>
          <h5 class="card-title">{{ $campaign->title }}</h5>
          <p class="card-text">{{ $campaign->short_body }}</p>
          <p class="mb-0" style="font-size: .8rem;">Donate</p>
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
          {{-- <p style="font-size: .8rem">{{ $campaign->date_target }} Remaining: Rp{{ $campaign->remaining() }}</p> --}}
          <a href="/campaign/{{ $campaign->slug }}" style="background-color: #193A6A; 
          color: white;
          padding: 8px 16px;
          border: none;
          font-size: 13px;
          cursor: pointer;" class="text-decoration-none">Donate Now</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@else
    <p class="text-center fs-4">No. Campaign Found.</p>
@endif
    </div>
</div>

@endsection
