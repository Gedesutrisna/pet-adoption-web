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
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Nunito:wght@700;800&display=swap" rel="stylesheet">
    <style>
      :root{
    --primary-color: #193A6A;
    --Btn-color: #FFDA47;

    --heading-font: 'Lato', sans-serif;
    --main-font: 'Nunito', sans-serif;
}



body{
    background-image: url("/assets/image.png"); 
    background-repeat: no-repeat;
    background-position: right top;
    background-size: 850px;
}

.container{
    width: 1500px;
}

.container .navbar-brand{
    font-family: var(--heading-font);
    color: var(--primary-color);
    font-size: 2.125rem;
    font-weight: 800;
}

.container .navbar-brand span{
    font-family: var(--heading-font);
    color: var(--Btn-color);
    font-size: 2.125rem;
}

.container .navbar-nav .nav-item-custom .nav-link{
    color: black;
    font-family: var(--main-font);
}

section{
    margin-top: 100px;
    margin-left: 50px;
}
 .row .left .heading{
    font-variant: var(--main-font);
    font-weight: 800;
    font-size: 3.25rem;
    color: var(--primary-color);
    text-align: center;
 }

.row .left .subheading{
    font-family: var(--heading-font);
    width: 500px;
    margin-left: 125px;
}

.left .btn-learn{
    margin-left: 40px;
    margin-top: 150px;
    padding: 16px 50px;
    border-radius: 8px;
    font-family: var(--heading-font);
    font-weight: 600;
    font-weight: 18px;
    border: 2px solid var(--primary-color);
    color: var(--primary-color);
    text-decoration: none;
    list-style: none;
}

.left .btn-learn:hover{
    background-color: var(--primary-color);
    color: #fff;
    transition: all .3s ease-in-out;
    
}

.left .btn-learn img{
    margin-right: 20px;
    
}
    </style>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
   @include('partials.navbar')
   @include('sweetalert::alert')
   <div class="container">
    @yield('container')
   </div>
   @include('partials.footer')

<script src="/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
  <link rel="" href="/js/script/">
</html>