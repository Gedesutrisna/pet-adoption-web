<div class="sidenav" style="background-color: #193A6A;color:white;">
  <div class="profile mb-3">
    <div class="row ">
      <div class="col-3">
        <img src="/assets/avatar.png" class="rounded-circle" style="padding-left: 10px" alt="">
      </div>
      <div class="col mx-0">
        <button class="dropdown-btn rounded-5">  
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::guard('admin')->user()->name }}
          </a>
        </button>
        <div class="dropdown-container" style="margin-left: 2px">
          <form action="/logout" method="POST">
            @csrf
            <button style="margin-left: 28px" type="submit" class="dropdown-item text-muted">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <a class="text-white mb-3" href="/dashboard"><img src="/assets/icon/home.png" style="width: 20px;" alt=""> Home</a>
  <a class="text-white mb-3" href="/dashboard/pets"><img src="/assets/icon/pet-sidebar.png" style="width: 20px;" alt=""> Pet</a>
  <a class="text-white mb-3" href="/dashboard/campaigns"><img src="/assets/icon/campaign-sidebar.png" style="width: 20px;" alt=""> Campaign</a>
  <a class="text-white mb-4" href="/dashboard/categories"><img src="/assets/icon/category-sidebar.png" style="width: 19px;" alt=""> Category</a>
  <button class="dropdown-btn rounded-5" style="background-color: white; color: #193A6A;" > <i class="bi bi-person"></i>Customers <i class="bi bi-caret-down-fill"></i>
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a class="text-white mt-4" href="/dashboard/donates"><img src="/assets/icon/donate-sidebar.png" style="width: 20px;" alt=""> Donate</a>
    <a class="text-white mt-3" href="/dashboard/adoptions"><img src="/assets/icon/adoption-sidebar.png" style="width: 20px;" alt=""> Adoptions</a>
    <a class="text-white mt-3" href="/dashboard/shelters"><img src="/assets/icon/shelter-sidebar.png" style="width: 20px;" alt=""> Shelters</a>
  </div>
</div>
