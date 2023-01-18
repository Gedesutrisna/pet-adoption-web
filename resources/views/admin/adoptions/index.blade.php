@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Adoptions</h1>
  </div>
  <form action="/dashboard/adoptions" method="get" style="display: inline-block;">
    <input type="text" name="search" placeholder="Search by name" value="{{ request('search') }}">
    <button type="submit">search</button>
  </form>
  @foreach ($categories as $category)
  <div class="col" style="display: inline-block; ">

  <a href="/dashboard/adoptions?category={{ $category->slug }}" class="btn btn-secondary btn-sm">{{ $category->name }}</a>
</div>

@endforeach
<div class="table-responsive">
  <div class="tab-container">
    <button class="tab-button" data-status="pending">Pending</button>
    <button class="tab-button" data-status="approved">Approved</button>
    <button class="tab-button" data-status="declined">Declined</button>
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
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($adoptions as $adoption)
        <tr class="adoption-row" data-status="{{ $adoption->status }}">
          <td>{{ $loop->iteration }}</td>
              <td>{{ $adoption->name}}</td>
              <td>{{ $adoption->email }}
              <td>{{ $adoption->category->name }}</td>
              <td>{{ $adoption->pet->name }}</td>
              <td>{{ $adoption->status }}</td>

              <td>

                                
                <a href="/dashboard/adoption/{{ $adoption->id }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                {{-- <a href="/dashboard/adoption/{{ $adoption->id }}/delete" class="btn btn-danger"><i class="bi bi-trash"></i></a> --}}

     
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
    window.addEventListener('load', () => {
    let adoptionRows = document.querySelectorAll('.adoption-row');
  
    adoptionRows.forEach(row => {
      if (row.dataset.status !== 'pending') {
        row.style.display = 'none';
      }
    });
  });
  
    let tabButtons = document.querySelectorAll('.tab-button');
  let adoptionRows = document.querySelectorAll('.adoption-row');
  
  tabButtons.forEach(button => {
    button.addEventListener('click', event => {
      let status = event.target.dataset.status;
  
      adoptionRows.forEach(row => {
        if (row.dataset.status === status) {
          row.style.display = 'table-row';
        } else {
          row.style.display = 'none';
        }
      });
    });
  });
  
  </script>
@endsection