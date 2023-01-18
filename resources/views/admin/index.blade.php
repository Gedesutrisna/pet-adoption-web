@extends('admin.layouts.main')
@section('container')
    <div class="row">
        <div class="col">
            <h1>Welcome {{ Auth::guard('admin')->user()->name }}</h1>
        </div>
    </div>
@endsection