@extends('layouts.main')
@section('container')
<div class="container">
  <div class="card mb-3 border-0 rounded-0" style="box-shadow: 3px 3px 10px #ccc">
    <div class="row g-0">
      <div class="col-md-6">
        <img src="assets/login-register.png" class="img-fluid w-100 h-100 rounded-end" alt="...">
      </div>
      <div class="col-md-6">
        <div class="card-body">
          <div class="col mt-5" style="padding-left: 3rem; ">
            <h5 class="card-title mb-3">Sign up</h5>
            <p class="mb-0">If you already have an account register</p>
            <p>You can <a href="/login" class="text-decoration-none"> Login here !</a></p>
          </div>
          <form action="/register" method="POST" style="margin-left: 50px; margin-right: 50px; margin-top:30px">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label"><i class="bi bi-person"></i> Name</label>
              <input type="text" name="name" style="border: 2px " class="form-control border-bottom rounded-0 @error('name') is-invalid @enderror" id="name" placeholder="Enter Your Name" required value="{{ old('name') }}">
              @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>  
            <div class="mb-3">
              <label for="email" class="form-label"><i class="bi bi-envelope"></i> Email</label>
              <input type="text" name="email" style="border: 2px " class="form-control border-bottom rounded-0 @error('email') is-invalid @enderror" id="email" placeholder="Enter Your Email Address" required value="{{ old('email') }}">
              @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>  
            <div class="mb-3">
              <label for="password" class="form-label"><img src="assets/padlock.png" alt=""> Password</label>
              <input type="password" name="password" style="border: 2px " class="form-control border-bottom rounded-0 @error('password') is-invalid @enderror" id="password" placeholder="Enter Your Password" required>
              @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>  
            <div class="mb-5">
              <label for="confirm_password" class="form-label"><img src="assets/padlock.png" alt="">Confirm Password</label>
              <input type="password" name="confirm_password" style="border: 2px " class="form-control border-bottom rounded-0 @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Enter Your confirm_password" required>
              @error('confirm_password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>  
          <div class="form-submit mb-5">
            <button type="submit" id="submit-btn" style="background-color: #193A6A; 
            color: white;
            width: 100%;
            height:40px;
            border-radius: 1rem;
            border: solid 1px #193A6A;
            font-size: 13px;
            cursor: pointer;">Register</button>            
          </div>     
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection