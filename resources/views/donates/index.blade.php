@extends('layouts.main')
@section('container')
<div class="container mb-3">
  <div class="row">
      @foreach ($mainCampaigns as $campaign)
      <h1 class="card-title mb-3">{{ $campaign->title }}</h1>
      <div class="col-md-8 mb-3">
        <div class="card border-0 rounded-0 mb-3" style="box-shadow: 3px 3px 10px #ccc;">
          <div class="position-absolute px-3 py-3 text-white">
            <a href="/campaign/{{ $campaign->slug }}" style="background-color: #193A6A; 
              color: white;
              padding: 8px 16px;
              border: none;
              font-size: 13px;
              cursor: pointer;" class="text-decoration-none">Donate Now</a>
          </div>
          <img src="{{ asset('storage/' . $campaign->image ) }}" alt="{{ $campaign->category->name }}"
          class="img-fluid" style="width:800px; height:400px;">
        </div>
        <div class="card-body" style="background-color: #EDF7F5; padding: 0px 20px ">
          <p class="mb-0" style="font-size: .8rem; padding-top:10px">Donate</p>
          <div class="progress mb-2">
            <div class="progress-bar" role="progressbar" style="width: {{ $campaign->percentage() }}%" aria-valuenow="{{ $campaign->percentage() }}" aria-valuemin="0" aria-valuemax="100"></div>
            <span class="progress-bar-label position-absolute">{{ $campaign->percentage() }}%</span>
          </div>
          <div class="row justify-content-between ">
            <div class="col-5">
              <p style="font-size: .8rem; text-align:left;">Raised:
                @if($campaign->donations)
                Rp{{ number_format($campaign->donations->sum('amount'), 0, ',', '.') }}
                @else
                Rp0
                @endif
              </p>
            </div>
            <div class="col">
              <p style="font-size: .8rem; text-align:right;"> 
                Goal:Rp{{ number_format($campaign->donation_target, 0, ',', '.') }}</p>
            </div>
          </div>
          {{-- <p style="font-size: .8rem">{{ $campaign->date_target }} Remaining: Rp{{ $campaign->remaining() }}</p> --}}
        </div>
      </div>
      <div class="col mb-3" style="background-color: #EDF7F5">
        <h2 style="margin: 1rem 1rem">More Campaigns</h2>
        @foreach ($submainCampaigns->skip(1) as $campaign)
        <div class="row">
          <div class="col">
            <img src="{{ asset('storage/' . $campaign->image ) }}" alt="{{ $campaign->category->name }}"
            class="img-fluid mb-3 " style="width:150px; height:90px; margin-left:1rem;">
          </div>
          <div class="col">
            <p class="card-title mb-1"> <a href="/campaign/{{ $campaign->slug }}" class="text-decoration-none" style="color: #193A6A">{{ $campaign->title }} </a></p>
            <p class="card-title text-muted " style="font-size: 13px;">{{ $campaign->category->name }}</p>
          </div>
        </div>
        @endforeach
      </div>
      @endforeach
    </div>
    <div class="row">
      <div class="col">
        <!-- Button trigger modal -->
        @if (auth()->check())
        <button type="button" style="background-color: #193A6A; color:white" class="btn rounded-0 btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Online Donation 
        </button>
        <a href="#how" class="btn btn-secondary rounded-0 btn-sm mb-3">Offline Donation</a>
        @else
        <a style="background-color: #193A6A; border: solid 1px #193A6A;  padding: 8px 16px; font-size:13px; color:white" class="text-decoration-none rounded-0 btn-sm mb-3"  href="/login"> Online Donation</a>
        <a href="#how" style="border: solid 1px#193A6A; padding: 8px 16px; font-size:13px; color:#193A6A" class="text-decoration-none rounded-0 btn-sm mb-3"  >Offline Donation</a>  
        @endif
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content" style="background-color: #EDF7F5">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Your Donation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="/donates/create" method="POST">
                  @csrf
                 
          <div class="mb-3">
              <label for="amount" class="form-label">Amount</label>
              <input type="number" name="amount"  class="form-control rounded-0 @error('amount') is-invalid @enderror"  id="amount" min="50000" step="1000" required value="{{ old('amount') }}">
              
              @error('amount')
              <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror

                <br>
<button style=" 
color: #193A6A;
padding: 8px 36px;
border: solid 1px #193A6A;
font-size: 13px;
cursor: pointer;" class="nominal" value="50000" onclick="setAmount(50000); return false;">Rp {{ number_format(50000, 0, ',', '.') }}</button>
<button style=" 
color: #193A6A;
padding: 8px 36px;
border: solid 1px #193A6A;
font-size: 13px;
cursor: pointer;" class="nominal" value="100000" onclick="setAmount(100000); return false;">Rp {{ number_format(100000, 0, ',', '.') }}</button>
<button style=" 
color: #193A6A;
padding: 8px 36px;
border: solid 1px #193A6A;
font-size: 13px;
cursor: pointer;" class="nominal" value="500000" onclick="setAmount(500000); return false;">Rp {{ number_format(500000, 0, ',', '.') }}</button>
            </div>
            <div class="mb-3">
              <label for="comment" class="form-label">comment</label>
              <textarea class="form-control rounded-0 @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3"value="{{ old('comment') }}" style="resize: none"></textarea>
              @error('comment')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>   
            <div class="mb-3" id="adoption-input" style="display: none;">
              <label for="adoption_id" class="form-label">Code Adoption</label>
              <input type="text" class="form-control rounded-0 @error('adoption_id') is-invalid @enderror" id="adoption_id" name="adoption_id"  value="{{ old('adoption_id') }}">
              @error('adoption_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            
            <div class="mb-3" id="shelter-input" style="display: none;">
              <label for="shelter_id" class="form-label">Code Shelter</label>
              <input type="text" class="form-control rounded-0 @error('shelter_id') is-invalid @enderror" id="shelter_id" name="shelter_id"  value="{{ old('shelter_id') }}">
              @error('shelter_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>    
       </div>
       <div class="modal-footer">
         <button type="submit" style=" 
         color: #193A6A;
         padding: 8px 36px;
         border: solid 1px #193A6A;
         font-size: 13px;
         cursor: pointer;" class="rounded-0">Donate Now</button>
         </form>
       </div>
           </div>
         </div>
       </div>
    </div>
    <div class="row mt-4">
      <h3>How to <span style="color: #193A6A">Donate</span></h3>
      <p>Ada 4 cara donate yang tersedia di website kami</p>
      <ol>
        <h3>Donate Biasa</h3>
        <li>Klik tombol "Donate" yang terdapat pada halaman Donate.</li>
        <li>Masukkan jumlah yang ingin Anda sumbangkan dalam form input "Amount".</li>
        <li>(Opsional) Tambahkan komentar pada form input "Comment" untuk memberikan catatan atau ucapan terima kasih.</li>
        <li>Klik tombol "Submit" atau "Kirim" untuk mengirimkan donasi Anda.</li>
      </ol>
      <ol>
        <h3>Donate Campaign</h3>
        <li>Klik tombol "Donate" yang terdapat pada halaman campaign yang ingin Anda bantu.</li>
        <li>Masukkan jumlah yang ingin Anda sumbangkan dalam form input "Amount".</li>
        <li>(Opsional) Tambahkan komentar pada form input "Comment" untuk memberikan catatan atau ucapan terima kasih.</li>
        <li>Klik tombol "Submit" atau "Kirim" untuk mengirimkan donasi Anda.</li>
      </ol>
      <ol>
        <h3>Donate Adoption</h3>
        <li>Klik tombol "Donate" yang terdapat pada halaman Donate setelah Anda melakukan proses adopsi dan disetujui oleh admin.</li>
        <li>Pilih metode untuk donate menggunakan adopsi</li>
        <li>Masukkan jumlah yang ingin Anda sumbangkan dalam form input "Amount".</li>
        <li>(Opsional) Tambahkan komentar pada form input "Comment" untuk memberikan catatan atau ucapan terima kasih.</li>
        <li>Klik tombol "Submit" atau "Kirim" untuk mengirimkan donasi Anda.</li>
      </ol>
      <ol>
        <h3>Donate Shelter</h3>
        <li>Klik tombol "Donate" yang terdapat pada halaman Donate setelah Anda melakukan proses shelter dan disetujui oleh admin.</li>
        <li>Pilih metode untuk donate menggunakan shelter</li>
        <li>Masukkan jumlah yang ingin Anda sumbangkan dalam form input "Amount".</li>
        <li>(Opsional) Tambahkan komentar pada form input "Comment" untuk memberikan catatan atau ucapan terima kasih.</li>
        <li>Klik tombol "Submit" atau "Kirim" untuk mengirimkan donasi Anda.</li>
      </ol>
      <ol>
        <h3 id="how">Offline Donate</h3>
        <li>Hubungi admin melalui kontak yang tersedia di website kami</li>
        <li>Kirim data diri, pernyataan ingin donasi dan apa yang ingin didonasikan untuk hewan</li>
        <li>Klik tombol "Submit" atau "Kirim" untuk mengirimkan donasi Anda.</li>
      </ol>
    </div>
  </div>
</div>
<script>
  let nominal = document.querySelectorAll('.nominal');
  let amount = document.getElementById('amount');
  function setAmount(amount) {
        document.getElementById("amount").value = amount;
    }
  nominal.forEach(function(el) {
      el.addEventListener('click', function() {
          amount.value = this.value;
      });
  });
</script>  
@endsection