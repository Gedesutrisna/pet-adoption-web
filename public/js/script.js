let loginForm = document.querySelector('.login-form');
let registerForm = document.querySelector('.register-form');

document.addEventListener("DOMContentLoaded", function(event) {
  let loginBtn = document.querySelector('#login-btn');
  if (loginBtn) {
    loginBtn.onclick = () => {
      loginForm.classList.toggle('active');
    };
  }

  let registerLink = document.querySelector('#register-link');
  if (registerLink) {
    registerLink.onclick = () => {
      registerForm.classList.toggle('active');
      loginForm.classList.remove('active');
    };
  }

  let loginLink = document.querySelector('#login-link');
  if (loginLink) {
    loginLink.onclick = () => {
      loginForm.classList.toggle('active');
      registerForm.classList.remove('active');
    };
  }
});


let notification = document.querySelector('.header .notification');
document.addEventListener("DOMContentLoaded", function(event) {
  let notificationBtn = document.querySelector('#notification-btn');
  if (notificationBtn) {
    notificationBtn.onclick = () => {
      notification.classList.toggle('active');
      navbar.classList.remove('active');
    };
  }
});


let navbar = document.querySelector('.header .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');    
    loginForm.classList.remove('active');
}

window.onscroll = () =>{
    loginForm.classList.remove('active');
    navbar.classList.remove('active');

    if(window.scrollY > 0){
        document.querySelector('.header').classList.add('active');
    }else{
        document.querySelector('.header').classList.remove('active');
    }
}

window.onload = () =>{
    if(window.scrollY > 0){
        document.querySelector('.header').classList.add('active');
    }else{
        document.querySelector('.header').classList.remove('active');
    }
}
