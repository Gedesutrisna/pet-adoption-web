@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Campaign Page</h1>
    {{-- <form action="/dashboard/campaigns" method="get" style="display: inline-block;">
      @if (request('category'))
      <input type="hidden" name="category" value="{{ request('category') }}" >
  @endif --}}
  {{-- <div class="input-group mb-3"> --}}
    <input type="text" name="search" id="search" style="      border: solid 1px #193A6A  ;" class="form-control rounded-0" placeholder="Search Campaigns" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ request('search') }}">
    {{-- <button class="input-group-text rounded-0" style="background-color: #193A6A; 
    color: white;
    padding: 10px 20px;
    border: none;
    font-size: 16px;
    cursor: pointer;"  type="submit"><i class="bi bi-search"></i></button>
  </div>
    </form> --}}
    </div>
    <div class="col mb-3" style="display: inline-block; ">
      <select  style=" 
      color: #193A6A;
      padding: 5px 10px;
      border: solid 1px #193A6A  ;
      font-size: 13px;
      cursor: pointer;"  id="status-select">
        <option value="all">All</option>
        <option value="Ongoing">Ongoing</option>
        <option value="Completed">Completed</option>
        
      </select>
      @foreach ($categories as $category)
    <a href="/dashboard/campaigns?category={{ $category->slug }}"style=" 
      color: #193A6A;
      padding: 5px 10px;
      border: solid 1px #193A6A  ;
      font-size: 13px;
      cursor: pointer;"  class="text-decoration-none mb-3">{{ $category->name }}</a>
  @endforeach
  </div>

<div  id="search_container" >
<div class="table-responsive" >
  <a href="/dashboard/campaigns/create"  style="background-color: #193A6A; 
  color: white;
  padding: 10px 16px;
  border: none;
  font-size: 13px;
  cursor: pointer;" class="text-decoration-none mb-3">Create new Campaign</a>
  @if ($campaigns->count())
  <table class="table table-striped table-sm mt-3">
    <thead style="background-color: #193A6A;color:white;">
      <tr>
          <th scope="col">No</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($campaigns as $campaign)
        <tr class="campaign-row" data-status="{{ $campaign->status }}">
          <td>{{ $loop->iteration }}</td>
              <td>{{ $campaign->title}}</td>
              <td>{{ $campaign->category->name }}</td>
              <td>{{ $campaign->status }}</td>
              <td>
                <a href="/dashboard/campaigns/{{ $campaign->slug }}" class="btn btn-primary rounded-0"><i class="bi bi-eye"></i></a>
                <a href="/dashboard/campaigns/{{ $campaign->slug }}/edit" class="btn btn-warning rounded-0"><i class="bi bi-pen"></i></a>
                                           <!-- Modal -->
  <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="exampleModalLabel">Delete Campaign</h5>
          <p class="text-muted">Are U Sure Delete This Campaign ?</p>
        </div>
        <div class="modal-body d-flex justify-content-between">
          <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
          <form action="/dashboard/campaigns/{{ $campaign->slug }}" method="POST" class="d-inline">
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
  <p class="text-center fs-4">No. Campaign Found.</p>
@endif
<div class="col">
  <div class="justify-content-center">
    {{ $campaigns->links() }}
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>
 
  let tabSelect = document.getElementById("status-select");
 let campaignRows = document.querySelectorAll('.campaign-row');
 
 tabSelect.addEventListener('change', event => {
   let status = event.target.value;
 
   if (status === 'all') {
     campaignRows.forEach(row => {
       row.style.display = 'table-row';
     });
     return;
   }
   campaignRows.forEach(row => {
     if (row.dataset.status === status) {
       row.style.display = 'table-row';
     } else {
       row.style.display = 'none';
     }
   });
 });
 
 $('#search').on('keyup',function(){
$value=$(this).val();
$.ajax({
type : 'get',
url : '{{URL::to('/campaigns/search')}}',
data:{'search':$value},
success:function(data){
$('tbody').html(data);
}
});

})

</script>


@endsection