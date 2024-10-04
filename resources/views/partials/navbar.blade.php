<header class="header">

  <a href="#" class="logo">Twice</a>
  
  <nav class="navbar">
  <a href="/">Home</a>
  <a href="/pets">Pets</a>
  <a href="/campaigns">Campaign</a>
  <a href="/shelters">Shelters</a>
  </nav>
  
  <div class="icons d-flex align-items-center">
    <div class="fas fa-bars" id="menu-btn"></div>
    @if (auth()->check())            
      <div class="notification-btn" style=" display: inline-block;
      position: relative;">
      <div class="fas fa-bell" id="notification-btn"></div>
      <div class="notification-count rounded-circle" style=" position: absolute;
        top: -1px;
        right: -4px;
        background-color: #e67e22;
        color: white;
        padding: 0px 6px;
        font-size: 12px;border-radius:50%;">
          <span>{{ Auth::user()->notification()->where('read_at')->count() }}</span>
        </div>            
      </div>
    @else
        
    <a href="#"><i  class="fas fa-bell"></i></a>
    @endif
    <a href="/pets" ><i class="fas fa-shopping-cart"></i></a>
    @auth
              @if (empty(Auth::user()->image))
              <a class="img text-decoration-none" style="color:black;display:inline-block;align-items:center  " href="/profile">        
                <img class="img  rounded-circle" src="/assets/profile.png" alt="profile_image"style="width: 30px;height: 30px; display:inline-block; ">
              </a>
                @else
                <a class="img text-decoration-none" style="color:black;display:inline-block;align-items:center  " href="/profile">        
                  <img class="img rounded-circle " src="{{ asset('storage/' . Auth::user()->image ) }}" alt="{{ Auth::user()->name }}" style="width: 30px;height: 30px; display:inline-block;">
          </a>
              @endif
              @else
      <div class="fas fa-user" id="login-btn"></div>
      @endauth
  </div>
  
  <form action="/login" method="post" class="login-form sign-in-form">
    @csrf
    <h3>Sign in</h3>
    <input type="email" name="email" placeholder="enter your email" id="" class="box">
    <input type="password" name="password" placeholder="enter your Password" id="" class="box">
    <div class="remember">
      <input type="checkbox" name="" id="remember-me">
      <label for="remember-me">remember-me</label>
    </div>
    <input type="submit" value="sign in" class="btn">
    <div class="links">
      <a href="#">forget password</a>
      <div id="register-link">sign up</div>
    </div>
  </form>
  <form action="/register" method="post" class="register-form sign-up-form">
    @csrf
    <h3>Sign up</h3>
    <input type="name" name="name" placeholder="enter your name" id="" class="box">
    <input type="email" name="email" placeholder="enter your email" id="" class="box">
    <input type="password" name="password" placeholder="enter your Password" id="" class="box">
    <input type="password" name="confirm_password" placeholder="enter your confirmation password" id="" class="box">

    <input type="submit" value="sign up" class="btn">
    <div class="links">
      <a href="#">forget password</a>
      <div id="login-link">sign in</div>
    </div>
  </form>

  

  <div class="notification">
    <h3 class="mb-3">Notification</h3>
    @if (auth()->check())

    <div class="notification-content">
      @foreach (Auth::user()->notification as $notification)
      @if (!$notification->read_at)
        @if ($notification->type == 'Adoption Declined'|| $notification->type == 'Shelter Declined')
          <div class="alert alert-danger d-flex justify-content-between" style="color: #ff5555;margin-bottom:1.5rem" role="alert">
            <p style="font-size: 14px;">{{ $notification->data }}</p> 
            <form action="{{ route('notification.read', $notification) }}" method="post">
              @csrf
              @method('PATCH')
              <button class="button" style="background-color: #ff5555;color:white;padding:5px 10px;margin-top:10px;border-radius:15px" type="submit" style="font-size: 14px">Mark as Read</button>
            </form>
          </div>                    
        @else                                       
          <div class="alert alert-success d-flex justify-content-between" role="alert" style="color: #3c763d;margin-bottom:1.5rem">
            <p style="font-size: 14px;">{{ $notification->data }}</p> 
            <form action="{{ route('notification.read', $notification) }} " method="post">
              @csrf
              @method('PATCH')
              <button class="button" style="background-color: #3c763d;color:white;padding:5px 10px;margin-top:10px;border-radius:15px" type="submit" style="font-size: 14px">Mark as Read</button>
            </form>
          </div>
        @endif
      @endif
    @endforeach
    </div>
    
    @else
    
    @endif
  </div>
  </header>
  <style>
    a{
      text-decoration: none;
    }
  </style>
