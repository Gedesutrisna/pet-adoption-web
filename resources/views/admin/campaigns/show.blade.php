@extends('admin.layouts.main')
@section('container')
<div class="back mt-3">
  <a href="/dashboard/campaigns"><i   style="font-size: 2rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
</div>
<div class="container">
    <div class="row my-3">
      <div class="col-lg-8">
        <h1 class="mb-3">{{ $campaign->title}}</h1>
      <div style="max-height: 350px; max-width:350px; overflow: hidden; ">
        <img src="{{ asset('storage/' . $campaign->image ) }}" alt="{{ $campaign->category->name }}"
        class="img-fluid mt-2">
      </div>
      <div class="progress mt-3" style="width: 350px">
        <div class="progress-bar" role="progressbar" style="width: {{ $campaign->percentage() }}%" aria-valuenow="{{ $campaign->percentage() }}" aria-valuemin="0" aria-valuemax="100"></div>
        <span class="progress-bar-label position-absolute">{{ $campaign->percentage() }}%</span>
      </div>
      <div class="row justify-content-between" style="width: 360px">
        <div class="col-5">
          <p style="font-size: .8rem; text-align:left;">Raised:
            @if($campaign->donations)
            Rp{{ number_format($campaign->donations->sum('amount'), 0, ',', '.') }}
            @else
            Rp0
            @endif
          </p>
        </div>
        <div class="col px-0">
          <p style="font-size: .8rem; text-align:right;"> 
            Goal:Rp{{ number_format($campaign->donation_target, 0, ',', '.') }}</p>
        </div>
      </div>
  <article class="my-3 fs-5">
    {!! $campaign->body !!}
  </article>
        </div>
    </div>
  </div>
@endsection