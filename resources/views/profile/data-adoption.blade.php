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
@if ($adoptions->count())

      <table class="table table-striped table-sm mt-3" style="font-size: 1.5rem">
        <thead style="background-color: #193A6A;color:white;">
        <tr>
          <th scope="col">No</th>
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
        @foreach (Auth::user()->adoption as $adoption)
        <tr class="adoption-row" data-status="{{ $adoption->status }}">
          <td>{{ $loop->iteration }}</td>
              <td>{{ $adoption->user->name}}</td>
              <td>{{ $adoption->user->email }}
              <td>{{ $adoption->category->name }}</td>
              <td>{{ $adoption->pet->name }}</td>
              <td>{{ $adoption->quantity }}</td>
              <td>{{ $adoption->status }}</td>

              <td>

                                
                <a href="/data/adoption/{{ $adoption->id }}" class="btn btn-primary rounded-0"><i class="bi bi-eye"></i></a>
               
            </td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <p class="text-center fs-4">No. Adoption Found.</p>
@endif
<div class="col">
  <div class="justify-content-center">
    {{ $adoptions->links() }}
</div>
  </div>
  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script>
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
