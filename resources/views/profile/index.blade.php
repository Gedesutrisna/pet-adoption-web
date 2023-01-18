@extends('layouts.main')
@section('container')
<div class="card mb-3 border-0" style="margin-top:100px;">
  
  <div class="row g-5" >
    
      
      <div class="back">
        <a href="/" class="btn btn-secondary">Back</a>
      </div>
      <div class="col-md-3 mt-3">
        <div class="card-body border border-1 rounded-start">

            <h3>Profile     @if(Auth::user()->image)
              <img class="image rounded-circle" src="{{ asset('storage/' . Auth::user()->image ) }}" alt="profile_image" style="width: 80px;height: 80px; padding: 10px; margin: 0px; ">
         @endif
            </h3>

            <hr>
          <p>Nama : {{ Auth::user()->name }}<p>
          <p>Username : {{ Auth::user()->username }}<p>
          <p>Email : {{ Auth::user()->email }}<p>
          <p>Telepone : {{ Auth::user()->phone }}</p>
          <hr>
        <form action="/logout" method="POST">
          @csrf
          <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
        </form>
      </div>
      </div>
      <div class="col-md-8  mt-3">
        <!-- Tombol untuk menampilkan tampilan edit profile -->
        <button id="toggle-view-button" onclick="toggleView()">Edit Profile</button>


  <!-- HTML untuk tampilan dashboard -->
<div id="dashboard">
  <h1>Dashboard</h1>
  <div class="row">
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Donasi</h5>
          <p class="card-text">{{ Auth::user()->donate->count() }}</p>
          <a href="/data/donation">See</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Adopsi</h5>
          <p class="card-text">{{ Auth::user()->adoption->count() }}</p>
          <a href="/data/adoption">See</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Shelter</h5>
          <p class="card-text">{{ Auth::user()->shelter->count() }}</p>
          <a href="/data/shelter">See</a>
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
        <form action="/profile/update" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nama</label>
              <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="emailHelp" autofocus value="{{ old('name', Auth::user()->name ) }}">    
              @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror           
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Username</label>
              <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" aria-describedby="emailHelp" autofocus value="{{ old('username', Auth::user()->username ) }}">    
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
              <label for="exampleInputEmail1" class="form-label">No Telp</label>
              <input name="phone" type="text" class="form-control  @error('phone') is-invalid @enderror" id="phone" aria-describedby="emailHelp" value="{{ old('phone', Auth::user()->phone ) }}">               
              @error('phone')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror     
            </div>  
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email</label>
              <input name="email" type="text" class="form-control  @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" value="{{ old('email', Auth::user()->email ) }}">               
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror     
            </div>  
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Password</label>
              <input name="password" type="password" class="form-control" id="password" aria-describedby="emailHelp" >     
            </div>   
              <div class="modal-footer">
  
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>    
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card border border-0">
        <form method="POST" action="{{ route('change.password') }}">
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
        
            <button type="submit" class="btn btn-primary">Update Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
      </div>
    </div>
  </div>
</div>
  <script>

    function previewImage(){
      const image = document.querySelector('#image');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const blob = URL.createObjectURL(image.files[0]);
imgPreview.src = blob;
      }
    


  var currentView = "dashboard";

  function toggleView() {
    if (currentView === "dashboard") {
      document.getElementById("dashboard").style.display = "none";
      document.getElementById("edit-profile").style.display = "block";
      document.getElementById("toggle-view-button").innerHTML = "Back";
      currentView = "edit-profile";
    } else {
      document.getElementById("edit-profile").style.display = "none";
      document.getElementById("dashboard").style.display = "block";
      document.getElementById("toggle-view-button").innerHTML = "Edit Profile";
      currentView = "dashboard";
    }
  }
</script>




@endsection
