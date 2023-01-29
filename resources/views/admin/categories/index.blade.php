@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data categories</h1>
  </div>
    <a href="/dashboard/categories/create"  style="background-color: #193A6A; 
    color: white;
    padding: 8px 16px;
    border: none;
    font-size: 13px;
    cursor: pointer;" class="text-decoration-none mb-3">Create new Category</a>
<div class="table-responsive">
@if ($categories->count())

      <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
        <tr class="category-row" data-status="{{ $category->status }}">
          <td>{{ $loop->iteration }}</td>
              <td>{{ $category->name}}</td>
              <td>
                <a href="/dashboard/categories/{{ $category->slug }}/edit" class="btn btn-warning"><i class="bi bi-pen"></i></a>
                <form action="/dashboard/categories/{{ $category->slug }}" method="POST" class="d-inline">
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
  <p class="text-center fs-4">No. category Found.</p>
@endif
@endsection
