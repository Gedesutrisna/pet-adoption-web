@extends('layouts.main')
@section('container')
<div class="row">
    @foreach (Auth::user()->adoption as $adoption)
        
    <div class="col-sm-4 mb-3 mb-sm-0">
        <div class="card">
            <div class="card-body">
                <div style="max-height: 350px; overflow: hidden; ">
                    <div class="position-absolute px-3 py-2 text-white">
                      {{ $adoption->status }}
                    </div>
                    <img src="{{ asset('storage/' . $adoption->pet->image ) }}" alt="{{ $adoption->pet->category->name }}"
                    class="img-fluid mt-2">
                  </div>
                  <p> kode untuk donasi : {{ $adoption->code }}</p>
                  @if ($adoption->status !== 'approved')              
                  @else
                  <a href="{{ asset($adoption->approval_file) }}" download>Download File</a>
                  @endif
                <p class="card-text">{{ $adoption->reason }}</p>
                @if ($adoption->status !== 'approved')      
                @else
                <form method="POST" action="/adoptions/update/{{ $adoption->id }}" class="mb-5" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="approval_file" class="form-label">approval_file</label>
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    <input class="form-control @error('approval_file') is-invalid @enderror" type="file" id="image" name="approval_file" onchange="previewImage()">
                    @error('approval_file')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>                   
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                    
                @endif
            </div>
        </div>
    </div>
    @endforeach
  </div>
@endsection
