@extends('layouts.main')
@section('container')
<div class="row">       
    <div class="col-sm-4 mb-3 mb-sm-0">
        <div class="card">
            <div class="card-body">
                      <p>{{ $shelter->status }}</p>
                      <p>Kode untuk doante : {{ $shelter->code }}</p>
                      @if ($shelter->status !== 'approved')
                          
                      @else
                          
                      <a href="{{ asset($shelter->approval_file) }}" download>Download File</a>
                      @endif
                <p class="card-text">{{ $shelter->reason }}</p>
                @if ($shelter->status !== 'approved')
                    
                @else
                <form method="POST" action="/shelters/update/{{ $shelter->id }}" class="mb-5" enctype="multipart/form-data">
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
  </div>
@endsection
