@extends('admin.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">


  <div class="back mt-3 mb-4">
    <a href="/dashboard/adoptions"><i   style="font-size: 2rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
  </div>
  <div class="status">
    @if($adoption->status === 'Inprogress')
    <button type="button" class="btn btn-success rounded-0 " data-bs-toggle="modal" data-bs-target="#exampleModal1">
     Approve
     </button>
    <button type="button" class="btn btn-danger rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal2">
     Decline
     </button>
     @endif
  </div>
</div>
<div class="container">
    <div class="row my-3 mb-3 justify-content-between" style="margin-right: 20px">
      <div class="col-4">
        <h1>User Details</h1>
        <hr>
        @if (!empty($adoption->user->image || $adoption->user->ktp))
            
        <img class="image rounded-circle" src="{{ asset('storage/' . $adoption->user->image ) }}" alt="" style="width: 100px;height: 100px; padding: 10px; margin: 0px; ">
        <br>
        <p class="mb-3">
        <a href="{{ asset('storage/' . $adoption->user->ktp ) }}" target="_blank"><i class="bi bi-file-earmark-arrow-down"></i>Photo KTP</a>
        </p>
        <p>Name : {{ $adoption->user->name }}</p>
        <p>Email : {{ $adoption->user->email }}</p>
        <p>Phone : {{ $adoption->user->phone }}</p>
        <p>Address : {{ $adoption->user->address }}</p>
        @else
        
        <p>Name : {{ $adoption->user->name }}</p>
        <p>Email : {{ $adoption->user->email }}</p>
        <p>Phone : {{ $adoption->user->phone }}</p>
        <p>Address : {{ $adoption->user->address }}</p>
        @endif
      </div>
      <div class="col-7">
        <h1>Submission Details</h1>
        <hr>
        <div class="mb-3" style="max-height: 300px;max-width:300px; overflow: hidden; ">
          <li>Pet Adoption Data</li>
          <h3>{{ $adoption->pet->name }}</h3>
          <img src="{{ asset('storage/' . $adoption->pet->image ) }}" alt="{{ $adoption->category->name }}"
          class="img-fluid mt-2">
        </div>
        <li class="mb-3">Quantity : {{ $adoption->quantity }}</li>
        <li class="mb-3">
          <a href="{{ asset('storage/' . $adoption->approval_file ) }}" target="_blank"><i class="bi bi-file-earmark-arrow-down"></i>Approval File</a>
        </li>
<li>Reason</li>
        <article style="  text-align: justify;
        ">{{ $adoption->reason }}</article>
      </div>
    </div>
    <div class="row mt-5 mb-3">
      <div class="col-4">
        <div class="d-flex justify-content-between">
                                                   <!-- Modal -->
                                                   <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header d-block">
                                                          <h5 class="modal-title" id="exampleModalLabel">Approved Submission {{ $adoption->user->name }}</h5>
                                                          <p class="text-muted">Are U Sure Approved This Submission ?</p>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-between">
                                                          <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
                                                          <a href="{{ route('adoptions.approve', $adoption->id) }}" class="btn btn-success rounded-0" id="approve-{{ $adoption->id }}">Approve</a>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                                                            <!-- Modal -->
                                                  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header d-block">
                                                          <h5 class="modal-title" id="exampleModalLabel">Declined Submission {{ $adoption->user->name }}</h5>
                                                          <p class="text-muted">Are U Sure Declined This Submission ?</p>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-between">
                                                          <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
                                                          <a href="{{ route('adoptions.decline', $adoption->id )}}" class="btn btn-danger rounded-0"  id="decline-{{ $adoption->id }}">Decline</a>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  

        </div>
      </div>
    </div>
  </div>
@endsection

