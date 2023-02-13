@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Donate Page</h1>
    <form action="/dashboard/donates" method="get" style="display: inline-block;">
  <div class="input-group mb-3">
    <input type="text" name="search" id="search-donates" style="      border: solid 1px #193A6A  ;
    " class="form-control rounded-0" placeholder="Search Donates" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ request('search') }}">
    <button class="input-group-text rounded-0" style="background-color: #193A6A; 
    color: white;
    padding: 10px 20px;
    border: none;
    font-size: 16px;
    cursor: pointer;"  type="submit"><i class="bi bi-search"></i></button>
  </div>
    </form>
    </div>
  <div class="table-responsive mb-3"> 
    <select  style=" 
    color: #193A6A;
    padding: 5px 10px;
    border: solid 1px #193A6A  ;
    font-size: 13px;
    cursor: pointer;"  id="status-select">
      <option value="all">All</option>
      <option value="Unpaid">Unpaid</option>
      <option value="Paid">Paid</option>
  </select>
  <select style=" 
  color: #193A6A;
  padding: 5px 10px;
  border: solid 1px #193A6A  ;
  font-size: 13px;
  cursor: pointer;" id="selectDonateType">
    <option value="campaignDonate">Campaign Donate</option>
    <option value="adoptionDonate">Adoption Donate</option>
    <option value="donateShelter">Donate Shelter</option>
  </select>
   
    <div class="mt-3" id="adoptionDonate" style="display:none">
      @if ($adoptionDonates->count())

      <table class="table table-striped table-sm" >
        <thead style="background-color: #193A6A;color:white;">
          <tr>
          <th scope="col">No</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Amount</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($adoptionDonates as $adoptionDonate)
            <tr class="donate-row" data-status="{{$adoptionDonate->status }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{$adoptionDonate->user->name}}</td>
            <td>{{$adoptionDonate->user->email}}</td>
            <td>Rp{{ number_format($adoptionDonate->amount, 0, ',', '.') }}
            </td>
            <td>{{$adoptionDonate->status }}</td>
            <td>
              <button type="button"class="btn btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                <i class="bi bi-eye"></i>
              </button>
            
              <!-- Modal -->
              <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Payment Details</h5>
                    </div>
                    <div class="modal-body">
                      <p class="text-muted mb-0 text-center" style="font-size: 13px">---User Datails---</p>
                      <p class="mb-0">Name  : {{$adoptionDonate->user->name}}</p>
                      <p class="mb-0">Email : {{$adoptionDonate->user->email}}</p>
                      <p class="mb-0">Phone : {{$adoptionDonate->user->phone}}</p>
                      <p class="mb-0">Address : {{$adoptionDonate->user->address}}</p>
                      <p class="text-muted mb-0 text-center" style="font-size: 13px">---Donate Datails---</p>
                      <p class="mb-0">Amount : Rp{{ number_format($adoptionDonate->amount, 0, ',', '.') }}</p>
                      <p class="mb-0">Code : {{$adoptionDonate->code}}</p>
                      <p class="mb-0">Status : {{$adoptionDonate->status}}</p>
                      <p class="mb-0">Comment : {{$adoptionDonate->comment}}</p>
                    </div>
                    <div class="modal-footer">
                      <div class="button d-flex justify-content-between">        
                        <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>          
              <!-- Modal -->
              <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                 <div class="modal-content">
                   <div class="modal-header d-block">
                     <h5 class="modal-title" id="exampleModalLabel">Delete Donate</h5>
                     <p class="text-muted">Are You Sure Delete This Donate ?</p>
                   </div>
                   <div class="modal-body d-flex justify-content-between">
                     <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
                     <form action="{{ route('adoption.destroy', $adoptionDonate->id) }}" method="post">
                      @csrf
                      @method('delete')
                      <button class="btn btn-danger rounded-0"><i class="bi bi-trash"></i></button>
                    </form>
                   </div>
                 </div>
               </div>
              </div>
                                        
              <button type="button" class="btn btn-danger rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal4">
              <i class="bi bi-trash"></i>
              </button>                            
             
           
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="col">
        <div class="justify-content-center">
          {{ $adoptionDonates->links() }}
      </div>
      </div>
      @else
      <p class="text-center fs-4">No. Donate Found.</p>
    @endif
  </div>
  <div  id="search_container" >

    <div class="mt-3" id="campaignDonate" style="display:block">
      @if ($campaignDonates->count())
      <table class="table table-striped table-sm">
        <thead style="background-color: #193A6A;color:white;">
          <tr>
          <th scope="col">No</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Amount</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($campaignDonates as $campaignDonate)
            <tr class="donate-row" data-status="{{$campaignDonate->status }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{$campaignDonate->user->name}}</td>
            <td>{{$campaignDonate->user->email}}</td>
            <td>Rp{{ number_format($campaignDonate->amount, 0, ',', '.') }}
            </td>
            <td>{{$campaignDonate->status }}</td>
            <td>
              <button type="button"class="btn btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                <i class="bi bi-eye"></i>
              </button>
            
              <!-- Modal -->
              <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Payment Details</h5>
                    </div>
                    <div class="modal-body">
                      <p class="text-muted mb-0 text-center" style="font-size: 13px">---User Datails---</p>
                      <p class="mb-0">Name  : {{$campaignDonate->user->name}}</p>
                      <p class="mb-0">Email : {{$campaignDonate->user->email}}</p>
                      <p class="mb-0">Phone : {{$campaignDonate->user->phone}}</p>
                      <p class="mb-0">Address : {{$campaignDonate->user->address}}</p>
                      <p class="text-muted mb-0 text-center" style="font-size: 13px">---Donate Datails---</p>
                      <p class="mb-0">Amount : Rp{{ number_format($campaignDonate->amount, 0, ',', '.') }}</p>
                      <p class="mb-0">Status : {{$campaignDonate->status}}</p>
                      <p class="mb-0">Comment : {{$campaignDonate->comment}}</p>
                    </div>
                    <div class="modal-footer">
                      <div class="button d-flex justify-content-between">        
                        <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>    
                <!-- Modal -->
                <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header d-block">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Donate</h5>
                        <p class="text-muted">Are You Sure Delete This Donate ?</p>
                      </div>
                      <div class="modal-body d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
                        <form action="{{ route('campaign.destroy', $campaignDonate->id) }}" method="post">
                          @csrf
                          @method('delete')
                         <button class="btn btn-danger rounded-0"><i class="bi bi-trash"></i></button>
                       </form>
                      </div>
                    </div>
                  </div>
                 </div>
                                           
                 <button type="button" class="btn btn-danger rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal5">
                 <i class="bi bi-trash"></i>
                 </button>     
            
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="col">
        <div class="justify-content-center">
          {{ $campaignDonates->links() }}
      </div>
      </div>
      @else
      <p class="text-center fs-4">No. Donate Found.</p>
    @endif
  </div>
  </div>
  <div class="mt-3" id="donateShelter" style="display:none">
    @if ($donateShelters->count())
      <table class="table table-striped table-sm">
        <thead style="background-color: #193A6A;color:white;">
          <tr>
          <th scope="col">No</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Amount</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($donateShelters as $donateShelter)
            <tr class="donate-row" data-status="{{$donateShelter->status }}" >
            <td>{{ $loop->iteration }}</td>
            <td>{{$donateShelter->user->name}}</td>
            <td>{{$donateShelter->user->email}}</td>
            <td>Rp{{ number_format($donateShelter->amount, 0, ',', '.') }}
            </td>
            <td>{{$donateShelter->status }}</td>
            <td>
              <button type="button"class="btn btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                <i class="bi bi-eye"></i>
              </button>
            
              <!-- Modal -->
              <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Payment Details</h5>
                    </div>
                    <div class="modal-body">
                      <p class="text-muted mb-0 text-center" style="font-size: 13px">---User Datails---</p>
                      <p class="mb-0">Name  : {{$donateShelter->user->name}}</p>
                      <p class="mb-0">Email : {{$donateShelter->user->email}}</p>
                      <p class="mb-0">Phone : {{$donateShelter->user->phone}}</p>
                      <p class="mb-0">Address : {{$donateShelter->user->address}}</p>
                      <p class="text-muted mb-0 text-center" style="font-size: 13px">---Donate Datails---</p>
                      <p class="mb-0">Amount : Rp{{ number_format($donateShelter->amount, 0, ',', '.') }}</p>
                      <p class="mb-0">Code : {{$donateShelter->code}}</p>
                      <p class="mb-0">Status : {{$donateShelter->status}}</p>
                      <p class="mb-0">Comment : {{$donateShelter->comment}}</p>
                    </div>
                    <div class="modal-footer">
                      <div class="button d-flex justify-content-between">        
                        <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>   
                <!-- Modal -->
                <div class="modal fade" id="exampleModal6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header d-block">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Donate</h5>
                        <p class="text-muted">Are You Sure Delete This Donate ?</p>
                      </div>
                      <div class="modal-body d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
                        <form action="{{ route('shelter.destroy', $donateShelter->id) }}" method="post">
                          @csrf
                          @method('delete')
                         <button class="btn btn-danger rounded-0"><i class="bi bi-trash"></i></button>
                       </form>
                      </div>
                    </div>
                  </div>
                 </div>
                                           
                 <button type="button" class="btn btn-danger rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal6">
                 <i class="bi bi-trash"></i>
                 </button>     
            
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="col">
        <div class="justify-content-center">
          {{ $donateShelters->links() }}
      </div>
      </div>
      @else
      <p class="text-center fs-4">No. Donate Found.</p>
    @endif
  </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

  <script>

const selectDonateType = document.getElementById("selectDonateType");
const campaignDonate = document.getElementById("campaignDonate");
const adoptionDonate = document.getElementById("adoptionDonate");
const donateShelter = document.getElementById("donateShelter");
let statusSelect = document.getElementById("status-select");
let donateRows = document.querySelectorAll('.donate-row');

statusSelect.addEventListener('change', event => {
  let status = event.target.value;
  
  if (status === 'all') {
    donateRows.forEach(row => {
      row.style.display = 'table-row';
    });
    return;
  }
  
  donateRows.forEach(row => {
    if (row.dataset.status === status) {
      row.style.display = 'table-row';
    } else {
      row.style.display = 'none';
    }
  });
});

selectDonateType.addEventListener("change", function() {
  const selectedValue = this.value;
  if (selectedValue === "campaignDonate") {
    adoptionDonate.style.display = "none";
    campaignDonate.style.display = "block";
    donateShelter.style.display = "none";
  } else if (selectedValue === "adoptionDonate") {
    adoptionDonate.style.display = "block";
    campaignDonate.style.display = "none";
    donateShelter.style.display = "none";
  } else if (selectedValue === "donateShelter") {
    adoptionDonate.style.display = "none";
    campaignDonate.style.display = "none";
    donateShelter.style.display = "block";
  }
});


$('#search-donates').on('keyup',function(){
  $value=$(this).val();
  $.ajax({
  type : 'get',
  url : '{{URL::to('/donates/search')}}',
  data:{'search':$value},
  success:function(data){
  $('tbody').html(data);
  }
  });

  })
</script>
@endsection