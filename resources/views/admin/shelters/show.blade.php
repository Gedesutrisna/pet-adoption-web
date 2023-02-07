@extends('admin.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">


  <div class="back mt-3 mb-4">
    <a href="/dashboard/shelters"><i   style="font-size: 2rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
  </div>
  <div class="status">
    @if($shelter->status === 'Inprogress')
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
        @if (!empty($shelter->user->image || $shelter->user->ktp))
            
        <img class="image rounded-circle" src="{{ asset('storage/' . $shelter->user->image ) }}" alt="" style="width: 100px;height: 100px; padding: 10px; margin: 0px; ">
        <br>
        <p class="mb-3">
        <a href="{{ asset('storage/' . $shelter->user->ktp ) }}" target="_blank"><i class="bi bi-file-earmark-arrow-down"></i>Photo KTP</a>
        </p>
        <p>Name : {{ $shelter->user->name }}</p>
        <p>Email : {{ $shelter->user->email }}</p>
        <p>Phone : {{ $shelter->user->phone }}</p>
        <p>Address : {{ $shelter->user->address }}</p>
        @else
        
        <p>Name : {{ $shelter->user->name }}</p>
        <p>Email : {{ $shelter->user->email }}</p>
        <p>Phone : {{ $shelter->user->phone }}</p>
        <p>Address : {{ $shelter->user->address }}</p>
        @endif
      </div>
      <div class="col-7">
        <h1>Submission Details</h1>
        <hr>
        <div class="mb-3" style="max-height: 200px;max-width:300px; overflow: hidden; ">
          <li>Pet Photo</li>
          <img src="{{ asset('storage/' . $shelter->image ) }}" alt="{{ $shelter->category->name }}"
          class="img-fluid mt-2">
        </div>
        <li class="mb-3">
          <a href="{{ asset('storage/' . $shelter->approval_file ) }}" target="_blank"><i class="bi bi-file-earmark-arrow-down"></i>Approval File</a>
        </li>
        <li class="mb-3">
          <a href="{{ asset('storage/' . $shelter->file ) }}" target="_blank"><i class="bi bi-file-earmark-arrow-down"></i>File Information</a>
        </li>
<li>Reason</li>
        <article style="  text-align: justify;
        ">{{ $shelter->reason }}</article>
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
                                                          <h5 class="modal-title" id="exampleModalLabel">Approved Submission {{ $shelter->user->name }}</h5>
                                                          <p class="text-muted">Are U Sure Approved This Submission ?</p>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-between">
                                                          <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
                                                          <form action="{{ route('shelters.approve', $shelter->id) }}" method="post">
                                                            @method('patch')
                                                            @csrf
                                                          <button class="btn btn-success rounded-0"  id="approve-{{ $shelter->id }}">Approve</button>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                                                            <!-- Modal -->
                                                  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header d-block">
                                                          <h5 class="modal-title" id="exampleModalLabel">Declined Submission {{ $shelter->user->name }}</h5>
                                                          <p class="text-muted">Are U Sure Declined This Submission ?</p>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-between">
                                                          <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
                                                          <form action="{{ route('shelters.decline', $shelter->id) }}" method="post">
                                                            @method('patch')
                                                            @csrf
                                                          <button class="btn btn-danger rounded-0"  id="decline-{{ $shelter->id }}">Decline</button>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  

        </div>
      </div>
    </div>
  </div>
@endsection

