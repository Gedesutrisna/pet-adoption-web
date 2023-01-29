@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Adoptions</h1>
  </div>
  <div class="col">
    <form action="/dashboard/adoptions" method="get" style="display: inline-block;">
  <div class="input-group mb-3">
    <input type="text" name="search" class="form-control rounded-0" placeholder="Search Adoptions" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ request('search') }}">
    <button class="input-group-text rounded-0" style="background-color: #193A6A; 
    color: white;
    padding: 10px 20px;
    border: none;
    font-size: 16px;
    cursor: pointer;"  type="submit"><i class="bi bi-search"></i></button>
  </div>
    </form>
  </div>
  @foreach ($categories as $category)
    <div class="col mb-3" style="display: inline-block; ">

    <a href="/dashboard/adoptions?category={{ $category->slug }}" style=" 
      color: #193A6A;
      padding: 5px 10px;
      border: solid 1px #193A6A  ;
      font-size: 13px;
      cursor: pointer;"  class="text-decoration-none mb-3">{{ $category->name }}</a>
  </div>

@endforeach
<div class="table-responsive">
    <select  style=" 
      color: #193A6A;
      padding: 5px 10px;
      border: solid 1px #193A6A  ;
      font-size: 13px;
      cursor: pointer;"  id="status-select">
        <option value="all">All</option>
        <option value="pending">Pending</option>
        <option value="inprogress">Inprogress</option>
        <option value="approved">Approved</option>
        <option value="declined">Declined</option>
        <option value="completed">Complete</option>
    </select>
</div>
@if ($adoptions->count())

      <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Pet Category</th>
          <th scope="col">Pet Name</th>
          <th scope="col">Quantity</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($adoptions as $adoption)
        <tr class="adoption-row" data-status="{{ $adoption->status }}">
          <td>{{ $loop->iteration }}</td>
              <td>{{ $adoption->user->name}}</td>
              <td>{{ $adoption->user->email }}
              <td>{{ $adoption->category->name }}</td>
              <td>{{ $adoption->pet->name }}</td>
              <td>{{ $adoption->quantity }}</td>
              <td>{{ $adoption->status }}</td>

              <td>

                                
                <a href="/dashboard/adoption/{{ $adoption->id }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                {{-- <form action="/dashboard/adoptions/{{ $adoptions->id }}" method="POST" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="btn btn-danger" onclick="return confirm('Are U Sure ?')"><span data-feather="x-circle"></span> Delete</button>
                  </form> --}}

     
                @if($adoption->status === 'pending')
                <a href="{{ route('adoptions.approve', $adoption->id) }}" class="btn btn-success" id="approve-{{ $adoption->id }}">Approve</a>
                <a href="{{ route('adoptions.decline', $adoption->id )}}" class="btn btn-danger" id="decline-{{ $adoption->id }}">Decline</a>
              @endif
            </td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <p class="text-center fs-4">No. Adoption Found.</p>
@endif
  <script>

// window.addEventListener('load', () => {
//     let adoptionRows = document.querySelectorAll('.adoption-row');
  
//     adoptionRows.forEach(row => {
//       if (row.dataset.status !== 'pending') {
//         row.style.display = 'none';
//       }
//     });
//   });
let tabSelect = document.getElementById("status-select");
let adoptionRows = document.querySelectorAll('.adoption-row');

tabSelect.addEventListener('change', event => {
  let status = event.target.value;

  if (status === 'all') {
    adoptionRows.forEach(row => {
      row.style.display = 'table-row';
    });
    return;
  }
  adoptionRows.forEach(row => {
    if (row.dataset.status === status) {
      row.style.display = 'table-row';
    } else {
      row.style.display = 'none';
    }
  });
});

  </script>
@endsection
