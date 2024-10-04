@extends('layouts.main-single')
@section('container')
<div class="card mb-3 border-0" style="margin-top:100px;margin-bottom:100px;">
  
  <div class="row g-5" >
    @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
  
      <div class="col-md-4 mt-3">
        <div class="card-body rounded" style="margin-bottom:100px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
          <h3 class="text-center" style="position: relative;">
            @if(auth()->user()->image)
            <form id="update-form" action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
              @method('put')
              @csrf
              <img id="profile-image" class="image rounded-circle" src="{{ asset('storage/' . auth()->user()->image ) }}" alt="profile_image" style="width: 100px; height: 100px; padding: 10px; margin: 0 auto;  cursor: pointer;">
              <input type="file" id="image" name="image" style="display: none;">
            </form>
            @else
            <form id="update-form" action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
              @method('put')
              @csrf
              <img id="profile-image" class="image rounded-circle" src="/assets/profile.png" alt="profile_image" style="width: 100px;height: 100px; padding: 10px; margin: 0px;  cursor: pointer;">   
              <input type="file" id="image" name="image" style="display: none;">
            </form>
            @endif
            <button id="toggle-view-button" onclick="toggleView()" class="border-0" style="background: none; position: absolute; top: 10px; right: 10px; z-index: 1;">
              <i class="bi bi-gear" style="font-size: 24px;"></i>
            </button>
          </h3>
     
          <h3 class="text-center mb-3" style="font-size: 2rem">{{ auth()->user()->name }}</h3>
          <p style="margin-left: 1rem;font-size:14px;">Username : {{ auth()->user()->username }}</p>
          <p style="margin-left: 1rem;font-size:14px;">Email : {{ auth()->user()->email }}</p>
          <p style="margin-left: 1rem;font-size:14px;">Phone : {{ auth()->user()->phone }}</p>
          <p style="margin-left: 1rem;font-size:14px;margin-bottom:3rem">Address : {{ auth()->user()->address }}</p>
         
        <form style="text-center" class="text-center" action="/logout" method="POST">
          @csrf
          <button type="submit" class="dropdown-item rounded" style="padding:8px 16px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;background-color:#193A6A;color:white;font-size:14px"><i class="bi bi-box-arrow-right"></i> Logout</button>
        </form>
      </div>
      </div>
      <div class="col-md-8  mt-3">



<div id="dashboard">
  <h1 style="font-size: 3rem">Dashboard</h1>
  <div class="row mt-3">
    <div class="col-sm-4">
      <div class="card mb-3 mx-auto" style="width: 14rem;width:15rem;height:15rem;border:none;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <div class="card-body text-center" >
          <img src="/assets/icon/donate.png" style="width:80px;" alt="">
          <p class="text-muted mb-0 mt-2" style="font-size: 13px">Total Donations</p>
          <h5 class="card-title" style="font-size: 1.8rem"><span style="color: #193A6A;">{{ auth()->user()->campaigndonate->count() + auth()->user()->adoptiondonate->count() + auth()->user()->donateshelter->count() }}</span> Donations</h5>
          </div>
          <a  style="background-color: #193A6A; 
            color: white;
            padding: 8px 24px;
            border: none;
            font-size: 13px;
            cursor: pointer;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" class="text-decoration-none rounded-bottom d-flex justify-content-between align-items-center" href="/data/donations">See <i class="bi bi-arrow-right"></i></a>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card mb-3 mx-auto" style="width: 14rem;width:15rem;height:15rem;border:none;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <div class="card-body text-center" >
          <img src="/assets/icon/adoption.png" style="width:80px;" alt="">
          <p class="text-muted mb-0 mt-2" style="font-size: 13px">Total Adoptions</p>
          <h5 class="card-title" style="font-size: 1.8rem"><span style="color: #193A6A;">{{ auth()->user()->adoption->count() }} </span> Adoptions</h5>
        </div>
        <a  style="background-color: #193A6A; 
            color: white;
            padding: 8px 24px;
            border: none;
            font-size: 13px;
            cursor: pointer;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" class="text-decoration-none rounded-bottom d-flex justify-content-between align-items-center" href="/data/adoptions">See <i class="bi bi-arrow-right"></i></a>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card mb-3 mx-auto" style="width: 14rem;width:15rem;height:15rem;border:none;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <div class="card-body text-center" >
          <img src="/assets/icon/shelter.png" style="width:80px;" alt="">
          <p class="text-muted mb-0 mt-2" style="font-size: 13px">Total Shelters</p>
          <h5 class="card-title" style="font-size: 1.8rem"><span style="color: #193A6A;">{{ auth()->user()->shelter->count() }} </span> Shelters</h5>
          </div>
          <a  style="background-color: #193A6A; 
            color: white;
            padding: 8px 24px;
            border: none;
            font-size: 13px;
            cursor: pointer;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" class="text-decoration-none rounded-bottom d-flex justify-content-between align-items-center" href="/data/shelters">See <i class="bi bi-arrow-right"></i></a>
      </div>   
    </div>
  </div>  
</div>

<div id="edit-profile" style="display:none;">
  <h1 style="font-size: 3rem">Edit Profile</h1>
  <div class="row g-4 d-flex justify-content-between">
    <div class="col-sm-6">
      <div class="card border border-0" style="font-size: 1.5rem">
          <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nama</label>
              <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="emailHelp" autofocus value="{{ old('name', auth()->user()->name ) }}">    
              @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror           
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Username</label>
              <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" aria-describedby="emailHelp" value="{{ old('username', auth()->user()->username ) }}">    
              @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror           
            </div>
            <div class="mb-3">
              <label for="ktp" class="form-label">Ktp</label>
              <img class="img-preview img-fluid mb-3 col-sm-5" id="ktp-preview">
              <input class="form-control @error('ktp') is-invalid @enderror" type="file" id="ktp" name="ktp" onchange="previewImage()">
              @error('ktp')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">No Telp</label>
              <input name="phone" type="text" class="form-control  @error('phone') is-invalid @enderror" id="phone" aria-describedby="emailHelp" value="{{ old('phone', auth()->user()->phone ) }}">               
              @error('phone')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror     
            </div>  
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Address</label>
              <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address" aria-describedby="emailHelp" value="{{ old('address', auth()->user()->address ) }}">    
              @error('address')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror           
            </div>
              <div class="modal-footer">
                <button type="submit" style="background-color: #193A6A; 
              color: white;
              padding: 8px 16px;
              border: none;
              font-size: 13px;
              cursor: pointer;" class="text-decoration-none">Update</button>
              </div>
            </form>    
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card border border-0" style="font-size: 1.5rem">
        <form method="POST" action="{{ route('change.password') }}">
          @method('PATCH')
          @csrf 
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Curent Password</label>
            <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">           
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">New Password</label>
            <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">New Confirm Password</label>
            <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
          </div>
          <div class="modal-footer">
        
            <button type="submit" style="background-color: #193A6A; 
              color: white;
              padding: 8px 16px;
              border: none;
              font-size: 13px;
              cursor: pointer;" class="text-decoration-none">Update Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
      </div>
    </div>
  </div>
</div>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>

  <script>

    function previewImage(){
      const ktp = document  .querySelector('#ktp');
      const ktpPreview = document.querySelector('#ktp-preview');
      ktpPreview.style.display = 'block';
      const ktpBlob = URL.createObjectURL(ktp.files[0]);
      ktpPreview.src = ktpBlob;
      }
    


  var currentView = "dashboard";

  function toggleView() {
  if (currentView == "dashboard") {
    document.getElementById("dashboard").style.display = "none";
    document.getElementById("edit-profile").style.display = "block";
    document.getElementById("toggle-view-button").innerHTML = '<i class="bi bi-gear-fill" style="font-size: 24px;color:#193A6A">';
    currentView = "edit-profile";
  } else {
    document.getElementById("edit-profile").style.display = "none";
    document.getElementById("dashboard").style.display = "block";
    document.getElementById("toggle-view-button").innerHTML = '<i class="bi bi-gear" style="font-size: 24px">';
    currentView = "dashboard";
  }
}
var profileImage = document.getElementById('profile-image');

if (profileImage) {
  profileImage.addEventListener("click", function() {
    document.getElementById('image').click();
  });
}

const imageInput = document.getElementById("image");
  const form = document.getElementById("update-form");

  imageInput.addEventListener("change", function() {
    const confirmation = confirm("Are you sure update your profile image ?");

    if (confirmation) {
      form.submit();
    }
  });

</script>



@endsection
