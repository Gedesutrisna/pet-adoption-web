@extends('admin.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Donate</h1>
    </div>
    <div class="col">
      <form action="/dashboard/donates" method="get" style="display: inline-block;">
    <div class="input-group mb-3">
      <input type="text" name="search" class="form-control rounded-0" placeholder="Search donates" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ request('search') }}">
      <button class="input-group-text rounded-0" style="background-color: #193A6A; 
      color: white;
      padding: 10px 20px;
      border: none;
      font-size: 16px;
      cursor: pointer;"  type="submit">search</button>
    </div>
      </form>
    </div>
  <div class="table-responsive mb-3">
    <button  style=" 
      color: #193A6A;
      padding: 5px 10px;
      border: solid 1px #193A6A  ;
      font-size: 13px;
      cursor: pointer;"  onclick="toggleView('donate')">Donate</button>
    <button  style=" 
      color: #193A6A;
      padding: 5px 10px;
      border: solid 1px #193A6A  ;
      font-size: 13px;
      cursor: pointer;"  onclick="toggleView('campaign_id')">Campaign ID</button>
    <button  style=" 
      color: #193A6A;
      padding: 5px 10px;
      border: solid 1px #193A6A  ;
      font-size: 13px;
      cursor: pointer;"  onclick="toggleView('adoption_id')">Adoption ID</button>
    <button  style=" 
      color: #193A6A;
      padding: 5px 10px;
      border: solid 1px #193A6A  ;
      font-size: 13px;
      cursor: pointer;"  onclick="toggleView('shelter_id')">Shelter ID</button>    
    <div id="donate" style="display:block">
      <table class="table table-striped table-sm">
        <thead>
    <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Amount</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($donates as $donate)
          @if(!$donate->adoption_id && !$donate->shelter_id && !$donate->campaign_id)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $donate->user->name}}</td>
            <td>{{ $donate->user->email}}</td>
            <td>Rp{{ number_format($donate->amount, 0, ',', '.') }}
            </td>
            <td>{{ $donate->status }}</td>
            <td>
              <a href="/dashboard/donates/{{ $donate->id }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
              <form action="/dashboard/donates/{{ $donate->id }}" method="POST" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger border-0" onclick="return confirm('Are U Sure ?')"><i class="bi bi-trash"></i></button>
                </form>
              </td>
          </tr>
        @endif
          @endforeach
        </tbody>
      </table>
  </div>
  <div id="campaign_id" style="display:none">
     <table class="table table-striped table-sm">
        <thead>
    <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Amount</th>
            <th scope="col">Status</th>
            <th scope="col">campaign_id</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($donates as $donate)
          @if($donate->campaign_id)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $donate->user->name}}</td>
              <td>{{ $donate->user->email}}</td>
              <td>Rp{{ number_format($donate->amount, 0, ',', '.') }}</td>
              <td>{{ $donate->campaign_id}}</td>
              <td>{{ $donate->status }}</td>
              <td>
                <a href="/dashboard/donates/{{ $donate->id }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
          <form action="/dashboard/donates/{{ $donate->id }}" method="POST" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="btn btn-danger border-0" onclick="return confirm('Are U Sure ?')"><i class="bi bi-trash"></i></button>
                  </form>
                </td>
            </tr>
          @endif
        @endforeach        
        </tbody>
      </table>
  </div>
  <div id="adoption_id" style="display:none">
      <table class="table table-striped table-sm">
        <thead>
    <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Amount</th>
            <th scope="col">Status</th>
            <th scope="col">adoption_id</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($donates as $donate)
          @if($donate->adoption_id)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $donate->user->name}}</td>
              <td>{{ $donate->user->email}}</td>
              <td>Rp{{ number_format($donate->amount, 0, ',', '.') }}</td>
              <td>{{ $donate->adoption_id}}</td>
              <td>{{ $donate->status }}</td>
              <td>
                <a href="/dashboard/donates/{{ $donate->id }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                <form action="/dashboard/donates/{{ $donate->id }}" method="POST" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="btn btn-danger border-0" onclick="return confirm('Are U Sure ?')"><i class="bi bi-trash"></i></button>
                  </form>
              </td>
            </tr>
          @endif
        @endforeach  
        </tbody>
      </table>
  </div>
  <div id="shelter_id" style="display:none">
       <table class="table table-striped table-sm">
        <thead>
    <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Amount</th>
            <th scope="col">Status</th>
            <th scope="col">shelter_id</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($donates as $donate)
          @if($donate->shelter_id)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $donate->user->name}}</td>
              <td>{{ $donate->user->email}}</td>
              <td>Rp{{ number_format($donate->amount, 0, ',', '.') }}</td>
              <td>{{ $donate->shelter_id}}</td>
              <td>{{ $donate->status }}</td>
              <td>
                <a href="/dashboard/donates/{{ $donate->id }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
          <form action="/dashboard/donates/{{ $donate->id }}" method="POST" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="btn btn-danger border-0" onclick="return confirm('Are U Sure ?')"><i class="bi bi-trash"></i></button>
                  </form>
                </td>
            </tr>
          @endif
        @endforeach  
        </tbody>
      </table>
  </div>
  
  </div>
  <script>
    function toggleView(view) {
        if(view == 'donate'){
            document.getElementById("donate").style.display = "block";
            document.getElementById("campaign_id").style.display = "none";
            document.getElementById("adoption_id").style.display = "none";
            document.getElementById("shelter_id").style.display = "none";
        }
        else if(view == 'campaign_id'){
            document.getElementById("donate").style.display = "none";
            document.getElementById("campaign_id").style.display = "block";
            document.getElementById("adoption_id").style.display = "none";
            document.getElementById("shelter_id").style.display = "none";
        }
        else if(view == 'adoption_id'){
            document.getElementById("donate").style.display = "none";
            document.getElementById("campaign_id").style.display = "none";
            document.getElementById("adoption_id").style.display = "block";
            document.getElementById("shelter_id").style.display = "none";
        }
        else if(view == 'shelter_id'){
            document.getElementById("donate").style.display = "none";
            document.getElementById("campaign_id").style.display = "none";
            document.getElementById("adoption_id").style.display = "none";
            document.getElementById("shelter_id").style.display = "block";
        }
    }
</script>


@endsection