@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pet Page</h1>
    <form action="/dashboard/pets" method="get" style="display: inline-block;">
      @if (request('category'))
      <input type="hidden" name="category" value="{{ request('category') }}" >
  @endif
  <div class="input-group mb-3">
    <input type="text" name="search" style="      border: solid 1px #193A6A  ;
    " class="form-control rounded-0" placeholder="Search Pets" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ request('search') }}">
    <button class="input-group-text rounded-0" style="background-color: #193A6A; 
    color: white;
    padding: 10px 20px;
    border: none;
    font-size: 16px;
    cursor: pointer;"  type="submit"><i class="bi bi-search"></i></button>
  </div>
    </form>
    </div>
    <div class="col mb-3" style="display: inline-block; ">
      <select  style=" 
      color: #193A6A;
      padding: 5px 10px;
      border: solid 1px #193A6A  ;
      font-size: 13px;
      cursor: pointer;"  id="status-select">
        <option value="all">All</option>
        <option value="available">Available</option>
        <option value="unavailable">Unavailable</option>
  
    </select>
      @foreach ($categories as $category)
    <a href="/dashboard/pets?category={{ $category->slug }}" style=" 
      color: #193A6A;
      padding: 5px 10px;
      border: solid 1px #193A6A  ;
      font-size: 13px;
      cursor: pointer;"  class="text-decoration-none mb-3">{{ $category->name }}</a>
  @endforeach
  </div>

<div class="table-responsive">

  <a href="/dashboard/pets/create"  style="background-color: #193A6A; 
  color: white;
  padding: 10px 16px;
  border: none;
  font-size: 13px;
  cursor: pointer;" class="text-decoration-none mb-3">Create new Pet</a>
  @if ($pets->count())
    <table class="table table-striped table-sm mt-3">
      <thead style="background-color: #193A6A;color:white;">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Name</th>
          <th scope="col">Category</th>
          <th scope="col">Quantity</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pets as $pet)
        <tr class="pet-row" data-status="{{ $pet->status }}">
          <td>{{ $loop->iteration }}</td>
              <td>{{ $pet->name}}</td>
              <td>{{ $pet->category->name }}</td>
              <td>{{ $pet->quantity}}</td>
              <td>{{ $pet->status}}</td>
              <td>
                <a href="/dashboard/pets/{{ $pet->slug }}" class="btn btn-primary rounded-0"><i class="bi bi-eye"></i></a>
                <a href="/dashboard/pets/{{ $pet->slug }}/edit" class="btn btn-warning rounded-0"><i class="bi bi-pen"></i></a>
                
                <form action="/dashboard/pets/{{ $pet->slug }}" method="POST" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger rounded-0" onclick="return confirm('Are U Sure ?')"><i class="bi bi-trash"></i></button>
                </form>
              </td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <p class="text-center fs-4">No. Pet Found.</p>
@endif
<div class="col">
  <div class="justify-content-center">
    {{ $pets->links() }}
</div>
<script>
 
  let tabSelect = document.getElementById("status-select");
 let petRows = document.querySelectorAll('.pet-row');
 
 tabSelect.addEventListener('change', event => {
   let status = event.target.value;
 
   if (status === 'all') {
     petRows.forEach(row => {
       row.style.display = 'table-row';
     });
     return;
   }
   petRows.forEach(row => {
     if (row.dataset.status === status) {
       row.style.display = 'table-row';
     } else {
       row.style.display = 'none';
     }
   });
 });
 
 </script>
@endsection