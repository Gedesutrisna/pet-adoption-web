<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <title>Adopsi | dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    
    <!-- Custom styles for this template -->

    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.js"></script>
    <style>
      body{
        background-color: #F5F5F5;
      }
      trix-toolbar [data-trix-button-group="file-tools"]{
        display: none;
      }
.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  background-color: #F5F5F5;
  z-index: 1;
  top: 0;
  left: 0;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a, .dropdown-btn-1 {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  display: block;
  border: none;
  background: none;
  width:100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}
.main {
  margin-left: 200px; 
  font-size: 20px;
  padding: 0px 10px;
}

.dropdown-container {
  display: none;
}

.fa-caret-down {
  float: right;
  padding-right: 8px;
}
    </style>
  </head>
  <body>
    
<div class="container-fluid">
  <div class="row">
    @include('admin.layouts.sidebar')
    @include('sweetalert::alert')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      @yield('container')
    </main>
  </div>
</div>
<script>
  //* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>

<script src="https://pcdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  </body>
</html>
