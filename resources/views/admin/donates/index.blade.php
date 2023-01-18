@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Donate</h1>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>  
    @endif
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Amount</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($donates as $donate)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $donate->name}}</td>
              <td>Rp{{ number_format($donate->amount, 0, ',', '.') }}
              </td>
              <td>
                <a href="/dashboard/donates/{{ $donate->id }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                <a href="/dashboard/donates/{{ $donate->id }}/delete" class="btn btn-danger"><i class="bi bi-trash"></i></a>

              </td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection