<footer class="container">
    <div class="row">
        <hr>
        <div class="col-6 col-md">
        <h5>Reach Us</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#"><i class="bi bi-telephone"></i> +62 879-3835-79349</a></li>
          <li><a class="text-muted" href="#"><i class="bi bi-geo-alt"></i> JL. x</a></li>
          <li><a class="text-muted" href="#"><i class="bi bi-envelope"></i> x@gmail.com</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>About Us</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="">Contact</a></li>
          <li><a class="text-muted" href="/about">Team</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>Contact</h5>
 
    <form method="POST" action="{{ route('contact.store') }}" id="contactUSForm" style="margin-left: 20px; margin-right: 20px;">
        @csrf
          
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Name</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6"  style="margin-top:20px;">
                <div class="form-group">
                    <strong>Message</strong>
                    <textarea name="message" rows="3" class="form-control">{{ old('message') }}</textarea>
                    @if ($errors->has('message'))
                        <span class="text-danger">{{ $errors->first('message') }}</span>
                    @endif
                </div>  
                <button class="btn btn-dark btn-submit mt-3" >Submit</button>
            </div>
        </div>
 
    </form>
      </div>
    </div>
  </footer>