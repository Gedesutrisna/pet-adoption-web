    <div class="sidenav">
        <div class="profile">
          <li class="nav-item dropdown list-unstyled">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::guard('admin')->user()->name }}
            </a>
            <ul class="dropdown-menu" style="margin-left:-70px; margin-top:30px;">
               
          <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-window"></i> My Dashboard</a></li>
          <li><hr class="dropdown-divider"></li>
              
                <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
            </ul>
          </li>
        </div>
        <a style="color: #193A6A" href="/dashboard/pets">Pet</a>
        <a style="color: #193A6A" href="/dashboard/campaigns">Campaign</a>
        <a style="color: #193A6A" href="/dashboard/categories">Category</a>
        <button class="dropdown-btn rounded-5" style="background-color: #193A6A; color:white;"> <i class="bi bi-person"></i>     Customers <i class="bi bi-caret-down-fill"></i>
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
          <a style="color: #193A6A" href="/dashboard/donates">Donate</a>
          <a style="color: #193A6A" href="/dashboard/adoptions">Adoptions</a>
          <a style="color: #193A6A" href="/dashboard/shelters">Shelters</a>
         </div>
      </div>
  
