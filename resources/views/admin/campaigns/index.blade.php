@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Campaign</h1>
    </div>
    <div class="col">
      <form action="/dashboard/campaigns" method="get" style="display: inline-block;">
        @if (request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}" >
    @endif
    <div class="input-group mb-3">
      <input type="text" name="search" class="form-control rounded-0" placeholder="Search campaigns" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ request('search') }}">
      <button class="input-group-text rounded-0" style="background-color: #193A6A; 
      color: white;
      padding: 10px 20px;
      border: none;
      font-size: 16px;
      cursor: pointer;"  type="submit">search</button>
    </div>
      </form>
    </div>
    @foreach ($categories as $category)
    <div class="col mb-3" style="display: inline-block; ">

    <a href="/dashboard/campaigns?category={{ $category->slug }}"style=" 
      color: #193A6A;
      padding: 5px 10px;
      border: solid 1px #193A6A  ;
      font-size: 13px;
      cursor: pointer;"  class="text-decoration-none mb-3">{{ $category->name }}</a>
  </div>

@endforeach

<div class="table-responsive">
  <a href="/dashboard/campaigns/create"  style="background-color: #193A6A; 
  color: white;
  padding: 8px 16px;
  border: none;
  font-size: 13px;
  cursor: pointer;" class="text-decoration-none mb-3">Create new Campaign</a>
  @if ($campaigns->count())
  <table class="table table-striped table-sm mt-3">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($campaigns as $campaign)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $campaign->title}}</td>
              <td>{{ $campaign->category->name }}</td>
              <td>{{ $campaign->status }}</td>
              <td>
                <a href="/dashboard/campaigns/{{ $campaign->slug }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                <a href="/dashboard/campaigns/{{ $campaign->slug }}/edit" class="btn btn-warning"><i class="bi bi-pen"></i></a>
                <form action="/dashboard/campaigns/{{ $campaign->slug }}" method="POST" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger border-0" onclick="return confirm('Are U Sure ?')"><i class="bi bi-trash"></i></button>
                </form>
              </td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <p class="text-center fs-4">No. Campaign Found.</p>
@endif
@endsection