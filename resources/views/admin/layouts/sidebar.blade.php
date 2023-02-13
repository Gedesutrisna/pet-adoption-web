<div class="sidenav" style="background-color: #193A6A;color:white;">
  <div class="profile mb-3">
    <div class="row " style="align-items: center">
      <div class="col-4">
        <img src="/assets/avatar.png" class="rounded-circle" style="padding-left: 10px" alt="">
      </div>
      <div class="col mx-0">
            {{ Auth::guard('admin')->user()->name }}
         
      </div>
    </div>
  </div>
  <div class="nav-items" style="margin-left:5px">
    <a class="text-white mb-3" href="/dashboard"><img src="/assets/icon/home.png" style="width: 20px;" alt=""> Home</a>
    <a class="text-white mb-3" href="/dashboard/pets"><img src="/assets/icon/pet-sidebar.png" style="width: 20px;" alt=""> Pet</a>
    <a class="text-white mb-3" href="/dashboard/campaigns"><img src="/assets/icon/campaign-sidebar.png" style="width: 20px;" alt=""> Campaign</a>
    <a class="text-white mb-4" href="/dashboard/categories"><img src="/assets/icon/category-sidebar.png" style="width: 19px;" alt=""> Category</a>
    <div class="hr mx-2">

      <hr>
    </div>
  </div>
  <div class="dropdown-btn" style="margin-left:5px;margin-right:30px">
    <button class="dropdown-btn-1 rounded-1 d-flex" style="background-color: #42B6F3; color: white; padding-left:0;padding-right:0;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" >
      <div class="putih" style="background-color: white;border-radius:0px 3px 3px 0px;">p</div>
      <div class="text">
        <i class="bi bi-person mx-2"></i>Customers 
        <i class="fa fa-caret-down"></i>
      </div>
    </button>
  </div>
  <div class="dropdown-container">
    <a class="text-white mt-4" href="/dashboard/donates"><img src="/assets/icon/donate-sidebar.png" style="width: 20px;" alt=""> Donate</a>
    <a class="text-white mt-3" href="/dashboard/adoptions"><img src="/assets/icon/adoption-sidebar.png" style="width: 20px;" alt=""> Adoptions</a>
    <a class="text-white mt-3" href="/dashboard/shelters"><img src="/assets/icon/shelter-sidebar.png" style="width: 20px;" alt=""> Shelters</a>
  </div>
  <div class="logout" style="margin-left:5px;margin-right:5px;position: fixed;bottom:0;">
    <form action="/logout" method="POST">
      @csrf
      <button style="background-color:#6477AF; color:white;border:none;border-radius:5px;padding:5px 45px;margin-bottom:20px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
background: rgba(255, 255, 255, 0.2);
" type="submit"><img src="/assets/icon/logout.png" style="width: 20px;" alt=""> Logout</button>
    </form>
  </div>
</div>
