@extends('admin.layouts.main')
@section('container')
    <div class="row">
        <h1 class="mb-3">Welcome {{ Auth::guard('admin')->user()->name }}</h1>
        <div class="col">
            <div class="card mb-3" style="width: 18rem;">
                <div class="card-body rounded-0" style="border: solid 1px #193A6A">
                  <h5 class="card-title">Total Pets : {{ $pets->count() }} </h5>
                </div>
              </div>
            <div class="card mb-3" style="width: 18rem;">
                <div class="card-body rounded-0" style="border: solid 1px #193A6A">
                  <h5 class="card-title">Total Campaigns : {{ $campaigns->count() }} </h5>
                </div>
              </div>
            <div class="card mb-3" style="width: 18rem;">
                <div class="card-body rounded-0" style="border: solid 1px #193A6A">
                  <h5 class="card-title">Total Adoptions : {{ $adoptions->count() }} </h5>
                </div>
              </div>
            <div class="card mb-3" style="width: 18rem;">
                <div class="card-body rounded-0" style="border: solid 1px #193A6A">
                  <h5 class="card-title">Total Donate Shelters : {{ $shelters->count() }} </h5>
                </div>
              </div>       
        </div>
    </div>
@endsection


