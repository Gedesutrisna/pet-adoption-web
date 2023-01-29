@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Shelters</h1>
  </div>
  <div class="col">
    <form action="/dashboard/shelters" method="get" style="display: inline-block;">
  <div class="input-group mb-3">
    <input type="text" name="search" class="form-control rounded-0" placeholder="Search Shelters" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ request('search') }}">
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

    <a href="/dashboard/shelters?category={{ $category->slug }}" style=" 
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
  font-size: 16px;
  cursor: pointer;"  id="status-select">
    <option value="all">All</option>
    <option value="pending">Pending</option>
    <option value="inprogress">Inprogress</option>
    <option value="approved">Approved</option>
    <option value="declined">Declined</option>
    <option value="completed">Complete</option>
</select>
    @if ($shelters->count())
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Pet Category</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($shelters as $shelter)
              <tr class="shelter-row" data-status="{{ $shelter->status }}">

              <td>{{ $loop->iteration }}</td>
              <td>{{ $shelter->user->name}}</td>
              <td>{{ $shelter->user->email }}
              <td>{{ $shelter->category->name }}</td>
              <td>{{ $shelter->status }}</td>

              <td>

                                
                <a href="/dashboard/shelters/{{ $shelter->id }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                {{-- <form action="/dashboard/shelters/{{ $shelters->id }}" method="POST" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="btn btn-danger" onclick="return confirm('Are U Sure ?')"><span data-feather="x-circle"></span> Delete</button>
                  </form> --}}
     
                @if($shelter->status === 'pending')
                <a href="{{ route('shelters.approve', $shelter->id) }}" class="btn btn-success" id="approve-{{ $shelter->id }}">Approve</a>
                <a href="{{ route('shelters.decline', $shelter->id )}}" class="btn btn-danger" id="decline-{{ $shelter->id }}">Decline</a>
              @endif
            </td>
            
            
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <p class="text-center fs-4">No. Shelter Found.</p>
@endif
<script>
 
 let tabSelect = document.getElementById("status-select");
let shelterRows = document.querySelectorAll('.shelter-row');

tabSelect.addEventListener('change', event => {
  let status = event.target.value;

  if (status === 'all') {
    shelterRows.forEach(row => {
      row.style.display = 'table-row';
    });
    return;
  }
  shelterRows.forEach(row => {
    if (row.dataset.status === status) {
      row.style.display = 'table-row';
    } else {
      row.style.display = 'none';
    }
  });
});

</script>
@endsection