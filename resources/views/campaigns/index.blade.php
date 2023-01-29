@extends('layouts.main')
@section('container')
<div class="container">
  <div class="row">
    <div class="col">
      <img src="assets/main-campaign2.png" alt="" class="img-fluid w-50">
    </div>
    <div class="col-5">
      <p class="text-muted">What Is Campaign  <img src="assets/line.png" alt=""></p>
      <h1>Lorem ipsum dolor sit amet</h1>
      <p style="text-justify: auto">Lorem ipsum dolor sit amet, consectetur adipiscing 
        elit. Pellentesque id justo quis arcu egestas luctus 
        quis vitae massa. Pellentesque eget quam nisl. Morbi 
        faucibus nibh vitae aliquam cursus. Nunc tempus ac</p>
        <a href="#campaign" style="background-color: #193A6A; 
        color: white;
        padding: 10px 20px;
        border: none;
        font-size: 16px;
        cursor: pointer;" class="text-decoration-none">See More</a>
    </div>
  </div>
    <div class="row" style="margin-top: 5rem">
      <div class="col">
        <p class="text-muted">Donate For Campaign <img src="assets/line.png" alt=""></p>
        <h1>Lorem ipsum dolor sit amet, consetetur</h1>
        <p style="text-justify: auto"><strong>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
          nonumy tempor invidunt ut labore et dolore magna aliquyam
          erat, sed diam voluptua. At vero eos et accusam et justo.</strong></p>
          <div class="row justify-content-between">
            <div class="col-5 border" style="background-color : #EDF7F5;">
              <p class="text-center" style="color: #193A6A">Our mission</p>
              <p style="font-size: .7rem">Lorem ipsum dolor sit amet,
consetetur sadipscing elitr,
sed diam</p>
            </div>
            <div class="col-5 border" style="background-color : #EDF7F5;">
              <p class="text-center" style="color: #193A6A">Our Visison</p>
              <p style="font-size: .7rem">Lorem ipsum dolor sit amet,
consetetur sadipscing elitr,
sed diam</p>
            </div>
          </div>
        </div>
      <div class="col offset-3">
        <img src="assets/campaign2.png" alt="" class="img-fluid w-55">
      </div>
    </div>
    <div class="row"  style="margin-top: 5rem">
      <p class="text-muted">All Campaigns <img src="assets/line.png" alt=""></p>
      <div class="row">
        <div class="col-5">
          <h1>Find the popular cause
            and donate them</h1>
        </div>
        <div class="col">
          <div class="d-flex justify-content-end">
            {{ $campaigns->links() }}
        </div>
        </div>
      </div>
@if ($campaigns->count())
<div class="container">
  <div class="row" id="campaign">
    @foreach ($campaigns as $campaign)
    <div class="col-md-3 mb-3">
      <div class="card border-0 rounded-0" style="box-shadow: 3px 3px 10px #ccc;">
        <div class="position-absolute px-3 py-2 text-white">
          {{ $campaign->status }}
        </div>
        <img src="{{ asset('storage/' . $campaign->image ) }}" alt="{{ $campaign->category->name }}"
        class="img-fluid" style="width:300px; height:220px;">
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
