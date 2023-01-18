<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" >
    <div class="position-sticky pt-3 sidebar-sticky">
      <ul class="nav flex-column">
     
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/pets*') ? 'active' : ''}}" href="/dashboard/pets" >
            <span data-feather="file-text"></span>
            My Pets
          </a>
        </li>
      </ul>

      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/campaigns*') ? 'active' : ''}}" href="/dashboard/campaigns" >
            <span data-feather="grid"></span>
            My Campaigns
          </a>
        </li>
      </ul>      
      
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/donates*') ? 'active' : ''}}" href="/dashboard/donates" >
            <span data-feather="grid"></span>
            Data Donates
          </a>
        </li>
      </ul>   

      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/adoptions*') ? 'active' : ''}}" href="/dashboard/adoptions" >
            <span data-feather="grid"></span>
            Data Adoptions
          </a>
        </li>
      </ul>     

      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/shelters*') ? 'active' : ''}}" href="/dashboard/shelters" >
            <span data-feather="grid"></span>
            Data Shelters
          </a>
        </li>
      </ul>      

      
    </div>
  </nav>