@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Campaign</h1>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>  
    @endif
    <form action="/dashboard/campaigns" method="get" style="display: inline-block;">
      <input type="text" name="search" placeholder="Search by Title" value="{{ request('search') }}">
      <button type="submit">search</button>
    </form>
    @foreach ($categories as $category)
    <div class="col" style="display: inline-block; ">

    <a href="/dashboard/campaigns?category={{ $category->slug }}" class="btn btn-secondary btn-sm">{{ $category->name }}</a>
  </div>

@endforeach

<div class="table-responsive">
  <a href="/dashboard/campaigns/create" class="btn btn-primary mb-3">Create new Campaign</a>
  @if ($campaigns->count())
  <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($campaigns as $campaign)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $campaign->title}}</td>
              <td>{{ $campaign->category->name }}</td>
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