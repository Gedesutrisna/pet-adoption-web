<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
     <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" 
     data-client-key="{{ config('app.client_key') }}"></script>
   <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <title>Twice | Web</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Nunito:wght@700;800&display=swap" rel="stylesheet">
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap");
* {
  font-family: "Poppins", sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  outline: none;
  border: none;
  text-decoration: none;
  text-transform: capitalize;
  transition: 0.2s linear;
}

html {
  font-size: 62.5%;
  overflow-x: hidden;
  scroll-behavior: smooth;
  scroll-padding-top: 4rem;
}
html::-webkit-scrollbar {
  width: 1rem;
}
html::-webkit-scrollbar-track {
  background: transparent;
}
html::-webkit-scrollbar-thumb {
  background: #e67e22;
  border-radius: 5rem;
}

.heading {
  padding-bottom: 2rem;
  text-align: center;
  font-size: 3.5rem;
  color: #193A6A;
}
.heading span {
  color: #e67e22;
}

section {
  padding: 5rem 9%;
}

.btn-custom {
  display: inline-block;
  margin-top: 1rem;
  padding: 0.8rem 2.8rem;
  border-radius: 5rem;
  border-top-left-radius: 0;
  cursor: pointer;
  background: none;
  color: #193A6A;
  font-size: 1.7rem;
  overflow: hidden;
  z-index: 0;
  border: 0.2rem solid #193A6A;
  position: relative;
}
.btn-custom::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background: #193A6A;
  z-index: -1;
  transition: 0.2s linear;
  -webkit-clip-path: circle(0% at 0% 5%);
          clip-path: circle(0% at 0% 5%);
}
.btn-custom:hover::before {
  -webkit-clip-path: circle(100%);
          clip-path: circle(100%);
}
.btn-custom:hover {
  color: #fff;
}

@keyframes fadeIn {
  0% {
    transform: translateY(3rem);
    opacity: 0;
  }
}
.header {
  background: #fff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 2rem 9%;
  box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1000;
  transform: translateY(-10rem);
}
.header.active {
  transform: translateY(0rem);
}
.header .logo {
  font-size: 2.5rem;
  color: #193A6A;
  font-weight: bolder;
}
.header .navbar a {
  margin: 0 1rem;
  font-size: 1.7rem;
  color: #666;
}
.header .navbar a:hover {
  color: #e67e22;
}
.header .icons a,
.header .icons div {
  font-size: 2.5rem;
  margin-left: 1.5rem;
  color: #193A6A;
  cursor: pointer;
}
.header .icons a:hover,
.header .icons div:hover {
  color: #e67e22;
}

.header .notification h3{
  margin-bottom: 10px;
}
.header .notification {
  position: absolute;
  top: 115%;
  right: 2rem;
  width: 35rem;
  border-radius: 1rem;
  background: #fff;
  box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
  padding: 2rem;
  display: none;
}

.header .notification .btn{
  margin-bottom: 1rem;
}
.header .notification.active {
  display: block;
  animation: fadeIn 0.4s linear;
}

.header .login-form {
  position: absolute;
  top: 115%;
  right: 2rem;
  width: 35rem;
  border-radius: 1rem;
  background: #fff;
  box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
  padding: 2rem;
  display: none;
}
.header .login-form.active {
  display: block;
  animation: fadeIn 0.4s linear;
}
.header .login-form h3 {
  color: #193A6A;
  font-size: 2.5rem;
  padding-bottom: 0.5rem;
}
.header .login-form .box {
  width: 100%;
  border-bottom: 0.2rem solid #193A6A;
  border-width: 0.1rem;
  padding: 1.5rem 0;
  font-size: 1.6rem;
  color: #193A6A;
  text-transform: none;
  margin: 1rem 0;
}
.header .register-form {
  position: absolute;
  top: 115%;
  right: 2rem;
  width: 35rem;
  border-radius: 1rem;
  background: #fff;
  box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
  padding: 2rem;
  display: none;
}
.header .register-form.active {
  display: block;
  animation: fadeIn 0.4s linear;
}
.header .register-form h3 {
  color: #193A6A;
  font-size: 2.5rem;
  padding-bottom: 0.5rem;
}
.header .register-form .box {
  width: 100%;
  border-bottom: 0.2rem solid #193A6A;
  border-width: 0.1rem;
  padding: 1.5rem 0;
  font-size: 1.6rem;
  color: #193A6A;
  text-transform: none;
  margin: 1rem 0;
}
.header .login-form .remember {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 1rem 0;
}
.header .login-form .remember label {
  font-size: 1.5rem;
  cursor: pointer;
  color: #666;
}
.header .login-form .btn-custom {
  width: 100%;
  text-align: center;
  margin: 1.5rem 0;
}
.header .login-form .btn-custom:hover {
  background: #193A6A;
}
.header .login-form .links {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 1rem;
}
.header .login-form .links a, 
.header .login-form .links div {
  font-size: 1.4rem;
  color: #e67e22;
}
.header .login-form .links a:hover,
.header .login-form .links div:hover {
  color: #193A6A;
  text-decoration: underline;
}
.header .register-form .btn-custom {
  width: 100%;
  text-align: center;
  margin: 1.5rem 0;
}
.header .register-form .btn-custom:hover {
  background: #193A6A;
}
.header .register-form .links {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 1rem;
}
.header .register-form .links a, 
.header .register-form .links div {
  font-size: 1.4rem;
  color: #e67e22;
}
.header .register-form .links a:hover,
.header .register-form .links div:hover {
  color: #193A6A;
  text-decoration: underline;
}


#menu-btn {
  display: none;
}

.footer {
  position: relative;
  background: url(/assets/footer_background.jpg) no-repeat;
  background-position: center;
  background-size: center;
  padding-top: 10rem;
  padding-bottom: 2rem;
}
.footer img {
  position: absolute;
  top: 0;
  left: 0;
  height: 10rem;
  width: 100%;
}
.footer .share {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 1.5rem;
}
.footer .share a {
  color: #fff;
  border-color: #fff;
}
.footer .share a:hover {
  color: #193A6A;
}
.footer .share a::before {
  background: #fff;
}
.footer .share a i {
  padding-right: 0.5rem;
}
.footer .credit {
  text-align: center;
  color: #fff;
  font-size: 2rem;
  padding: 2rem 1rem;
  margin-top: 2.5rem;
}
.footer .credit span {
  color: #e67e22;
}

@media (max-width: 991px) {
  html {
    font-size: 55%;
  }
  .header {
    padding: 2rem;
  }
  .content {
    text-align: center;
    padding-bottom: 5rem;
  }
}
@media (max-width: 768px) {
  #menu-btn {
    display: inline-block;
  }
  .header .navbar {
    position: absolute;
    top: 99%;
    left: 0;
    right: 0;
    background: #fff;
    -webkit-clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
            clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
  }
  .header .navbar.active {
    -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
  }
  .header .navbar a {
    display: block;
    margin: 2rem;
    font-size: 2rem;
  }
}
@media (max-width: 450px) {
  html {
    font-size: 50%;
  }
  .header .login-form {
    width: 90%;
  }
}/*# sourceMappingURL=style.css.map */
    </style>
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