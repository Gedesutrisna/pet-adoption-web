@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Shelter Page</h1>
    <form action="/dashboard/shelters" method="get" style="display: inline-block;">
      <div class="input-group mb-3">
        <input type="text" style="      border: solid 1px #193A6A  ;
        " name="search" id="search-shelter" class="form-control rounded-0" placeholder="Search Shelters" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ request('search') }}">
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

    <a href="/dashboard/shelters?category={{ $category->slug }}" style=" 
      color: #193A6A;
      padding: 5px 10px;
      border: solid 1px #193A6A  ;
      font-size: 13px;
      cursor: pointer;"  class="text-decoration-none mb-3">{{ $category->name }}</a>
  </div>

@endforeach
<div  id="search_container" >

<div class="table-responsive">
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
    @if ($shelters->count())
    <table class="table table-striped table-sm mt-3">
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
        @foreach ($shelters as $shelter)
              <tr class="shelter-row" data-status="{{ $shelter->status }}">

              <td>{{ $loop->iteration }}</td>
              <td>{{ $shelter->user->name}}</td>
              <td>{{ $shelter->user->email }}
              <td>{{ $shelter->category->name }}</td>
              <td>{{ $shelter->status }}</td>

              <td>

                                
                <a href="/dashboard/shelter/{{ $shelter->id }}" class="btn btn-primary rounded-0"><i class="bi bi-eye"></i></a>
                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header d-block">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Shelter</h5>
                        <p class="text-muted">Are You Sure Delete This Submission ?</p>
                      </div>
                      <div class="modal-body d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
              
                        <form action="/dashboard/shelter/{{ $shelter->id }}" method="POST" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="btn btn-danger rounded-0"><i class="bi bi-trash"></i></button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              
               <button type="button" class="btn btn-danger rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                <i class="bi bi-trash"></i>
                </button>
              
 
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

    $('#search-shelter').on('keyup',function(){
    $value=$(this).val();
    $.ajax({
    type : 'get',
    url : '{{URL::to('/shelters/search')}}',
    data:{'search':$value},
    success:function(data){
    $('tbody').html(data);
    }
    });

    })
</script>
@endsection