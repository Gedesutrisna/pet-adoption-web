@extends('layouts.main-single')
@section('container')
<div class="back mt-5 mb-3 d-flex justify-content-between align-items-center">
  <a href="/profile"><i   style="font-size: 3rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
  <select  style=" 
  color: #193A6A;
  padding: 5px 10px;
  border: solid 1px #193A6A  ;
  font-size: 13px;
  cursor: pointer;"  id="status-select">
    <option value="all">All</option>
    <option value="Inprogress">Inprogress</option>
    <option value="Approved">Approved</option>
    <option value="Declined">Declined</option>
    <option value="Completed">Complete</option>
  </select>
</div>

<div  id="search_container" style="height: 300px">

<div class="table-responsive">
    @if ($shelters->count())
    <table class="table table-striped table-sm mt-3" style="font-size: 1.5rem">
      <thead style="background-color: #193A6A;color:white;">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Pet Category</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach (Auth::user()->shelter as $shelter)
        <tr class="shelter-row" data-status="{{ $shelter->status }}">

              <td>{{ $loop->iteration }}</td>
              <td>{{ $shelter->user->name}}</td>
              <td>{{ $shelter->user->email }}
              <td>{{ $shelter->category->name }}</td>
              <td>{{ $shelter->status }}</td>

              <td>

                                
                <a href="/data/shelter/{{ $shelter->id }}" class="btn btn-primary rounded-0"><i class="bi bi-eye"></i></a>

        
            </td>         
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <p class="text-center fs-4">No. Shelter Found.</p>
@endif
<div class="col">
  <div class="justify-content-center">
    {{ $shelters->links() }}
</div>
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

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