@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Donate Page</h1>
    <form id="search-form" action="/dashboard/donates" method="get" style="display: inline-block;">
  <div class="input-group mb-3">
    <input id="search-input" type="text" name="search" style="      border: solid 1px #193A6A  ;
    " class="form-control rounded-0" placeholder="Search donates" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ request('search') }}">
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
      <option value="unpaid">Unpaid</option>
      <option value="paid">Paid</option>
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
              <a href="/dashboard/donate/adoptiondonate/{{ $adoptionDonate->id }}" class="btn btn-primary rounded-0"><i class="bi bi-eye"></i></a>
              <form action="/dashboard/donates/{{$adoptionDonate->id }}" method="POST" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger rounded-0" onclick="return confirm('Are U Sure ?')"><i class="bi bi-trash"></i></button>
                </form>
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
              <a href="/dashboard/donate/campaigndonate/{{ $campaignDonate->id }}" class="btn btn-primary rounded-0"><i class="bi bi-eye"></i></a>
              <form action="/dashboard/donates/{{$campaignDonate->id }}" method="POST" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger rounded-0" onclick="return confirm('Are U Sure ?')"><i class="bi bi-trash"></i></button>
                </form>
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
              <a href="/dashboard/donate/donnateshelter/{{ $donateShelter->id }}" class="btn btn-primary rounded-0"><i class="bi bi-eye"></i></a>
              <form action="/dashboard/donates/{{$donateShelter->id }}" method="POST" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger rounded-0" onclick="return confirm('Are U Sure ?')"><i class="bi bi-trash"></i></button>
                </form>
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