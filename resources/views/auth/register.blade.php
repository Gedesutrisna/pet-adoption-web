@extends('layouts.main')
@section('container')

<div class="row justify-content-center">

    <div class="col-md-5 rounded-end" style="background-color: #BAD7E9">
        <main class="form-registration w-100 m-auto " >
          <div class="text" style="text-align: center; padding-top: 20px">
            <h1 class="h3 mb-3 fw-normal">Create your account</h1>
            <p class="text-muted">it’s free and easy</p>
          </div>
            <form action="/register" method="POST" style="margin-left: 50px; margin-right: 50px;">
              @csrf
              <div class="form-floating">
                <div class="form-group">
                  <strong>Name</strong>
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" required value="{{ old('name') }}">
                  @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>  
                @enderror
              </div>
              </div>
             
              <div class="form-floating" style="padding-top: 20px">
                <div class="form-group">
                  <strong>Email</strong>
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                  @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>  
                @enderror
              </div>
              </div>
              <div class="form-floating" style="padding-top: 20px">
                <div class="form-group">
                  <strong>Password</strong>
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                  @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>  
                @enderror
              </div>
              </div>
            <div class="click" style="padding-top: 20px">

              <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
            </div>
              
            </form>
            <small style="padding-bottom: 20px" class="d-block text-center mt-3">Already Registered?<a href="/login">Login</a></small>
          </main>
    </div>
</div>

@endsection