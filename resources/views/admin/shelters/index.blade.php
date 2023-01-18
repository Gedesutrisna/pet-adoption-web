@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Shelters</h1>
  </div>
  <form action="/dashboard/shelters" method="get" style="display: inline-block;">
    <input type="text" name="search" placeholder="Search by name" value="{{ request('search') }}">
    <button type="submit">search</button>
  </form>
  @foreach ($categories as $category)
  <div class="col" style="display: inline-block; ">

  <a href="/dashboard/shelters?category={{ $category->slug }}" class="btn btn-secondary btn-sm">{{ $category->name }}</a>
</div>

@endforeach
@if ($shelters->count())

  <div class="table-responsive">
    <div class="tab-container">
      <button class="tab-button" data-status="pending">Pending</button>
      <button class="tab-button" data-status="approved">Approved</button>
      <button class="tab-button" data-status="declined">Declined</button>
    </div>
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
              <td>{{ $shelter->name}}</td>
              <td>{{ $shelter->email }}
              <td>{{ $shelter->category->name }}</td>
              <td>{{ $shelter->status }}</td>

              <td>

                                
                <a href="/dashboard/shelters/{{ $shelter->id }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                {{-- <a href="/dashboard/shelters/{{ $shelter->id }}/delete" class="btn btn-danger"><i class="bi bi-trash"></i></a> --}}

     
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
  window.addEventListener('load', () => {
  let shelterRows = document.querySelectorAll('.shelter-row');

  shelterRows.forEach(row => {
    if (row.dataset.status !== 'pending') {
      row.style.display = 'none';
    }
  });
});

  let tabButtons = document.querySelectorAll('.tab-button');
let shelterRows = document.querySelectorAll('.shelter-row');

tabButtons.forEach(button => {
  button.addEventListener('click', event => {
    let status = event.target.dataset.status;

    shelterRows.forEach(row => {
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