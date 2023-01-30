@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Donate</h1>
    </div>
    <div class="col">
      <form action="/dashboard/donates" method="get" style="display: inline-block;">
    <div class="input-group mb-3">
      <input type="text" name="search" class="form-control rounded-0" placeholder="Search donates" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ request('search') }}">
      <button class="input-group-text rounded-0" style="background-color: #193A6A; 
      color: white;
      padding: 10px 20px;
      border: none;
      font-size: 16px;
      cursor: pointer;"  type="submit">search</button>
    </div>
      </form>
    </div>
  <div class="table-responsive mb-3"> 
    <div id="donate" style="display:block">
      <table class="table table-striped table-sm">
        <thead>
    <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Amount</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($donates as $donate)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $donate->user->name}}</td>
            <td>{{ $donate->user->email}}</td>
            <td>Rp{{ number_format($donate->amount, 0, ',', '.') }}
            </td>
            <td>{{ $donate->status }}</td>
            <td>
              <a href="/dashboard/donates/{{ $donate->id }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
              <form action="/dashboard/donates/{{ $donate->id }}" method="POST" class="d-inline">
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
  
  </div>


@endsection