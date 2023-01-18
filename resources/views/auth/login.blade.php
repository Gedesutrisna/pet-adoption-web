@extends('layouts.main')
@section('container')

<div class="row justify-content-center">
  
      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      @if (session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
{{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
        <div class="col-md-5 rounded-end">
           <main class="form-signin w-100 m-auto">
              <form action="/login" method="POST">
                @csrf
                <div class="form-floating">
                  <div class="form-group">
                    <strong>Email address</strong>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
                </div>
                </div>
                <div class="form-floating" >
                  <div class="form-group">
                    <strong>Password</strong>
                    <input type="password" name="password" class="form-control rounded-top" id="password" placeholder="password" required>
                </div>
                </div>
                <div class="click" >
                  <button class="w-100 btn btn-lg btn-primary"  type="submit">Login</button>
                </div>              
              </form>         
            </main>
      </div> 
    </div>
@endsection



