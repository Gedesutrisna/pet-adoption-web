@extends('layouts.main')
@section('container')
<div class="card mb-3 border-0" style="margin-top:100px;">
  
  <div class="row g-5" >
    @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
  




    
      <div class="col-md-4 mt-3">
        <div class="card-body border border-1 rounded-start">

            <h3>Profile         <button id="toggle-view-button" onclick="toggleView()" class="border-0" style="background: none;"><i class="bi bi-gear"></i></button>
              @if(auth()->user()->image)
              <img class="image rounded-circle" src="{{ asset('storage/' . auth()->user()->image ) }}" alt="profile_image" style="width: 80px;height: 80px; padding: 10px; margin: 0px; ">
         @endif  
            </h3>
        <!-- Tombol untuk menampilkan tampilan edit profile -->
            <hr>
          <p>Name : {{ auth()->user()->name }}<p>
          <p>Username : {{ auth()->user()->username }}<p>
          <p>Email : {{ auth()->user()->email }}<p>
          <p>Phone : {{ auth()->user()->phone }}</p>
          <p>Address : {{ auth()->user()->address }}</p>
          <hr>
        <form action="/logout" method="POST">
          @csrf
          <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
        </form>
      </div>
      </div>
      <div class="col-md-8  mt-3">



  <!-- HTML untuk tampilan dashboard -->
<div id="dashboard">
  <h1>Dashboard</h1>
  <div class="row">
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Donasi</h5>
          <p class="card-text">{{ auth()->user()->campaigndonate->count() + auth()->user()->adoptiondonate->count() + auth()->user()->donateshelter->count() }}</p>
          <a  style="background-color: #193A6A; 
              color: white;
              padding: 8px 16px;
              border: none;
              font-size: 13px;
              cursor: pointer;" class="text-decoration-none" href="/data/donations">See</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Adopsi</h5>
          <p class="card-text">{{ auth()->user()->adoption->count() }}</p>
          <a  style="background-color: #193A6A; 
              color: white;
              padding: 8px 16px;
              border: none;
              font-size: 13px;
              cursor: pointer;" class="text-decoration-none" href="/data/adoptions">See</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Shelter</h5>
          <p class="card-text">{{ auth()->user()->shelter->count() }}</p>
          <a  style="background-color: #193A6A; 
              color: white;
              padding: 8px 16px;
              border: none;
              font-size: 13px;
              cursor: pointer;" class="text-decoration-none" href="/data/shelters">See</a>
        </div>
      </div>
    </div>
  </div>  
</div>

<!-- HTML untuk tampilan edit profile -->
<div id="edit-profile" style="display:none;">
  <h1>Edit Profile</h1>
  <div class="row g-5">
    <div class="col-sm-6">
      <div class="card border border-0">
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
              <label for="image" class="form-label">Photo Profile</label>
              <img class="img-preview img-fluid mb-3 col-sm-5">
              <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
              @error('image')
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
      <div class="card border border-0">
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
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>

  <script>

    function previewImage(){
      const image = document.querySelector('#image');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const blob = URL.createObjectURL(image.files[0]);
imgPreview.src = blob;
      
    
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
    document.getElementById("toggle-view-button").innerHTML = '<i class="bi bi-gear-fill"></i>';
    currentView = "edit-profile";
  } else {
    document.getElementById("edit-profile").style.display = "none";
    document.getElementById("dashboard").style.display = "block";
    document.getElementById("toggle-view-button").innerHTML = '<i class="bi bi-gear"></i>';
    currentView = "dashboard";
  }
}
</script>



@endsection
