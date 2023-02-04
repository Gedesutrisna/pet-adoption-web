@extends('admin.layouts.main')
@section('container')
    <div class="row mt-4">
        <h1 class="mb-5">Dashboard Page</h1>
            <div class="card mb-3 mx-auto" style="width: 14rem;height:10rem;border:solid 1px #193A6A">
                <div class="card-body" >
                  <img src="/assets/icon/pet.png" style="width:80px" alt="">
                  <p class="text-muted mb-0">Total Pets</p>
                  <h5 class="card-title">{{ $pets->count() }} Pets</h5>
                </div>
              </div>
            <div class="card mb-3 mx-auto" style="width: 14rem;height:10rem;border:solid 1px #193A6A">
                <div class="card-body" >
                  <img src="/assets/icon/campaign.png" style="width:80px" alt="">
                  <p class="text-muted mb-0">Total Campaigns</p>
                  <h5 class="card-title">{{ $campaigns->count() }} Campaigns</h5>
                </div>
              </div>
            <div class="card mb-3 mx-auto" style="width: 14rem;height:10rem;border:solid 1px #193A6A">
                <div class="card-body" >
                  <img src="/assets/icon/adoption.png" style="width:80px" alt="">
                  <p class="text-muted mb-0">Total Adoptions</p>
                  <h5 class="card-title">{{ $adoptions->count() }} Adoptions</h5>
                </div>
              </div>
            <div class="card mb-3 mx-auto" style="width: 14rem;height:10rem;border:solid 1px #193A6A">
                <div class="card-body" >
                  <img src="/assets/icon/shelter.png" style="width:80px" alt="">
                  <p class="text-muted mb-0">Total Shelters</p>
                  <h5 class="card-title">{{ $shelters->count() }} Shelters</h5>
                </div>
              </div>       
    </div>
    <div class="row mb-3 mt-3">
      <canvas id="myChart"></canvas>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

    <script>
      var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: ['AdoptionDonate', 'CampaignDonate', 'DonateShelter'],
              datasets: [{
                  label: 'Amount',
                  data: [{{$adoptionDonate}}, {{$campaignDonate}}, {{$donateShelter}}],
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              title: {
            display: true,
            text: 'Donate Chart'
        },
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true
                      }
                  }]
              }
          }
      });
      </script>
      
@endsection


