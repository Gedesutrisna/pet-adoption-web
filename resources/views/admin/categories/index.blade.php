@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Category Page</h1>
    <form action="/dashboard/categories" method="get" style="display: inline-block;">
      @if (request('category'))
      <input type="hidden" name="category" value="{{ request('category') }}" >
  @endif
  <div class="input-group mb-3">
    <input type="text" name="search" id="search-category" style="      border: solid 1px #193A6A  ;
    " class="form-control rounded-0" placeholder="Search Categories" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ request('search') }}">
    <button class="input-group-text rounded-0" style="background-color: #193A6A; 
    color: white;
    padding: 10px 20px;
    border: none;
    font-size: 16px;
    cursor: pointer;"  type="submit"><i class="bi bi-search"></i></button>
  </div>
    </form>
  </div>
  <!-- Button trigger modal -->
<div class="popup">
    <button type="button"style="background-color: #193A6A; 
  color: white;
  padding: 8px 16px;
  border: none;
  font-size: 13px;
  cursor: pointer;" class="btn rounded-0 btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal1">
    Create New Category 
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
        </div>
        <div class="modal-body">
          <form method="POST" action="/dashboard/categories">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
              required autofocus value="{{ old('name') }}">
              @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <input type="hidden" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
              required value="{{ old('slug') }}">
              @error('slug')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="button d-flex justify-content-between">

              <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
              <button type="submit" style="background-color: #193A6A; 
              color: white;
              padding: 8px 16px;
              border: none;
              font-size: 13px;
              cursor: pointer;">Create new Category</button>
              </div>
          </form>
        </div>
 </div>
     </div>
   </div>
 </div>

 <div  id="search_container" >

<div class="table-responsive">
@if ($categories->count())
  <table class="table table-striped table-sm">
    <thead style="background-color: #193A6A;color:white;">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Name</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categories as $category)
      <tr class="category-row" data-status="{{ $category->status }}">
        <td>{{ $loop->iteration }}</td>
        <td>{{ $category->name}}</td>
        <td>
          <button type="button" class="btn btn-warning rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal2">
          <i class="bi bi-pen"></i>
          </button>
                  <!-- Modal -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
        </div>
        <div class="modal-body">
          <form method="POST" action="/dashboard/categories/{{ $category->slug }}">
            @method('put')
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
               autofocus value="{{ old('name', $category->name) }}">
              @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <input type="hidden" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
               value="{{ old('slug', $category->slug) }}">
              @error('slug')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="button d-flex justify-content-between">

            <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
            <button type="submit" style="background-color: #193A6A; 
            color: white;
            padding: 8px 16px;
            border: none;
            font-size: 13px;
            cursor: pointer;">Update Category</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
                  <!-- Modal -->
  <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
          <p class="text-muted">Are You Sure Delete This Category ?</p>
        </div>
        <div class="modal-body d-flex justify-content-between">
          <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>

          <form action="/dashboard/categories/{{ $category->slug }}" method="POST" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger rounded-0"><i class="bi bi-trash"></i></button>
            </form>
        </div>
      </div>
    </div>
  </div>

 <button type="button" class="btn btn-danger rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal3">
  <i class="bi bi-trash"></i>
  </button>

          </td>
        </tr>
    @endforeach
    </tbody>
  </table>
</div>
</div>
  @else
  <p class="text-center fs-4">No. category Found.</p>
@endif
<div class="col">
  <div class="justify-content-center">
    {{ $categories->links() }}
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>
      const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function(){
      fetch('/dashboard/categories/checkSlug?name=' + name.value)
      .then(response => response.json())
      .then(data => slug.value = data.slug)
    });


  $('#search-category').on('keyup',function(){
  $value=$(this).val();
  $.ajax({
  type : 'get',
  url : '{{URL::to('/categories/search')}}',
  data:{'search':$value},
  success:function(data){
  $('tbody').html(data);
  }
  });

  })
</script>
@endsection
