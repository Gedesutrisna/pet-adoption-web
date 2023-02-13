<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
     <script type="text/javascript"
     src="https://app.sandbox.midtrans.com/snap/snap.js"
     data-client-key="{{ config('app.client_key') }}"></script>
   <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <title>Twice | Web</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Nunito:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style-no-home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
   @include('partials.navbar-no-home')
   @include('sweetalert::alert')
   <div class="container">
    @yield('container')
   </div>
   <section class="footer">

    <img src="/assets/top_wave.png" alt="">
  
    <div class="share">
        <a href="#" class="btn-custom"> <i class="fab fa-facebook-f"></i> facebook </a>
        <a href="#" class="btn-custom"> <i class="fab fa-twitter"></i> twitter </a>
        <a href="#" class="btn-custom"> <i class="fab fa-instagram"></i> instagram </a>
        <a href="#" class="btn-custom"> <i class="fab fa-linkedin"></i> linkedin </a>
        <a href="#" class="btn-custom"> <i class="fab fa-pinterest"></i> pinterest </a>
    </div>
  
    <div class="credit"> created by Twice team</div>
  
  </section>
  <script src="/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>