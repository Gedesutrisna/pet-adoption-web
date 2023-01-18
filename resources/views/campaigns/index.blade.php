@extends('layouts.main')
@section('container')
<h1 class="mb-3" style="text-align: center">Campaigns</h1>

<div class="row justify-content-center mb-3">
  <div class="col-md-6">
  </div>
</div>



@if ($campaigns->count())
<div class="container">
  <div class="row">
    @foreach ($campaigns as $campaign)
    <div class="col-md-4 mb-3">
      <div class="card border-0">
        <div class="position-absolute px-3 py-2 text-white">
          {{ $campaign->status }}
                  </div>
          <img src="{{ asset('storage/' . $campaign->image ) }}" alt="{{ $campaign->category->name }}"
          class="img-fluid" style="border-radius: 15px; width:300px; height:250px;">
        <div class="card-body">
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $campaign->percentage() }}%" aria-valuenow="{{ $campaign->percentage() }}" aria-valuemin="0" aria-valuemax="100"></div>
            <span class="progress-bar-label position-absolute">{{ $campaign->percentage() }}%</span>
          </div>
          <p>Date Target : {{ $campaign->date_target }}</p>
          <p>Remaining Donate : {{ $campaign->remaining() }}</p>
          
          <a href="/campaigns?category={{ $campaign->category->slug }}" class="text-decoration-none">{{ $campaign->category->name }}</a>

          <h5 class="card-title">{{ $campaign->title }}</h5>
          <p class="card-text">{{ $campaign->short_body }}</p>
          <p class="card-text"><small class="text-muted">{{ $campaign->created_at->diffForHumans() }}</small></p>
          <a href="/campaign/{{ $campaign->slug }}" class="text-decoration-none "><i class="bi bi-arrow-right"></i> Read More</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<div class="d-flex justify-content-center mb-3">
  {{ $campaigns->links() }}
</div>

@else
    <p class="text-center fs-4">No. Post Found.</p>
@endif



@endsection
