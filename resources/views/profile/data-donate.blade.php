@extends('layouts.main-single')
@section('container')
<div class="back mt-5 mb-3 d-flex justify-content-between  align-items-center">
  <a href="/profile"><i   style="font-size: 3rem; color:#193A6A" class="bi bi-arrow-left-circle-fill"></i></a>
  <div class="select">

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
  </div>
</div>

<div class="table-responsive mb-3" style="height: 300px"> 
   
    <div class="mt-3" id="adoptionDonate" style="display:none">
      @if ($adoptionDonates->count())

      <table class="table table-striped table-sm mt-3" style="font-size: 1.5rem">
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
        @foreach (Auth::user()->adoptionDonate as $adoptionDonate)    
        <tr class="donate-row" data-status="{{$adoptionDonate->status }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{$adoptionDonate->user->name}}</td>
            <td>{{$adoptionDonate->user->email}}</td>
            <td>Rp{{ number_format($adoptionDonate->amount, 0, ',', '.') }}
            </td>
            <td>{{$adoptionDonate->status }}</td>
            <td>
              @if ($adoptionDonate->status == 'Paid')
                
              @else
              <a class="btn btn-success rounded-0"  href="/transaction/{{ $adoptionDonate->id }}/adoption" class="text-decoration-none text-center">Pay !</a>
              @endif       
             
           
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
      <table class="table table-striped table-sm mt-3" style="font-size: 1.5rem">
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
        @foreach (Auth::user()->campaignDonate as $campaignDonate)    
        <tr class="donate-row" data-status="{{$campaignDonate->status }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{$campaignDonate->user->name}}</td>
            <td>{{$campaignDonate->user->email}}</td>
            <td>Rp{{ number_format($campaignDonate->amount, 0, ',', '.') }}
            </td>
            <td>{{$campaignDonate->status }}</td>
            <td>
              @if ($campaignDonate->status == 'Paid')
                
              @else
              <a class="btn btn-success rounded-0"  href="/transaction/{{ $campaignDonate->id }}/campaign" class="text-decoration-none text-center">Pay !</a>
              @endif
                  
               
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
    <table class="table table-striped table-sm mt-3" style="font-size: 1.5rem">
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

        @foreach (Auth::user()->donateShelter as $donateShelter)    
        <tr class="donate-row" data-status="{{$donateShelter->status }}" >
            <td>{{ $loop->iteration }}</td>
            <td>{{$donateShelter->user->name}}</td>
            <td>{{$donateShelter->user->email}}</td>
            <td>Rp{{ number_format($donateShelter->amount, 0, ',', '.') }}
            </td>
            <td>{{$donateShelter->status }}</td>
            <td>
              @if ($donateShelter->status == 'Paid')
                
              @else
              <a class="btn btn-success rounded-0"  href="/transaction/{{ $donateShelter->id }}/shelter" class="text-decoration-none text-center">Pay !</a>
              @endif
        
              
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


</script>
@endsection

