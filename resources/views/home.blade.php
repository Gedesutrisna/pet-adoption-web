@extends('layouts.main-home')
@section('container')
<!-- Home Section Start -->
<section class="home" id="home">

  <div class="content">
    <h3> <span>hi</span> welcome to our twice home </h3>
    <a href="/campaigns" class="btn"> donate </a>
  </div>
  <img src="/assets/bottom_wave.png" class="wave" alt="">
  </section>
  
  <!-- Home Section End -->
  
  <!-- About Start -->
  
  <section class="about" id="about">
  
    <div class="image">
      <img src="/assets/about_img.png" alt="">
    </div>
  
    <div class="content">
      <h3>Go save <span>Dog and Cat</span></h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, officiis unde facere esse quidem modi Lorem, ipsum dolor. Lorem ipsum dolor.
  
      </p>
      <a href="#" class="btn">Read more</a>
    </div>
  </section>
  <!-- About end -->
  
  <div class="dog-food">
  
  <div class="image">
    <img src="/assets/dog_food.png" alt="">
  </div>
  
  <div class="content">
    <h3>For better life <span>cat and dog</span></h3>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo nemo aliquid veritatis iure, soluta voluptatum dolorum fugiat aspernatur exercitationem modi!</p>
    <a href="#"> <img src="/assets/shop_now_dog.png" alt=""></a>
  </div>
  
  </div>
  
  <div class="cat-food">
    
    <div class="content">
      <h3>Help much of them <br> <span>cat and dog lovers</span></h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo nemo aliquid veritatis iure, soluta voluptatum dolorum fugiat aspernatur exercitationem modi!</p>
      <a href="#"> <img src="/assets/shop_now_cat.png" alt=""></a>
    </div>
  
    <div class="image">
      <img src="/assets/cat_food.png" alt="">
    </div>
    </div>
    
  <!-- Shop section start -->
  
  <section class="shop" id="shop">
  
    <h1 class="heading"> our <span> pets </span> </h1>
  
    <div class="box-container">
        @foreach ($petsByDog as $pet)
        <div class="box">
          <div class="icons">
              <a href="/pets" class="fas fa-shopping-cart"></a>
              <a href="/pets" class="fas fa-eye"></a>
          </div>
          <div class="image">
            <img src="{{ asset('storage/' . $pet->image ) }}" alt="{{ $pet->category->name }}"
            class="img-fluid mt-2">
          </div>
          <div class="content">
              <h3>{{ $pet->name }}</h3>
          </div>
        </div>
      @endforeach
        @foreach ($petsByCat as $pet)
        <div class="box">
          <div class="icons">
              <a href="/pets" class="fas fa-shopping-cart"></a>
              <a href="/pet/{{ $pet->slug }}" class="fas fa-eye"></a>
          </div>
          <div class="image">
            <img src="{{ asset('storage/' . $pet->image ) }}" alt="{{ $pet->category->name }}"
            class="img-fluid mt-2">
          </div>
          <div class="content">
              <h3>{{ $pet->name }}</h3>
          </div>
        </div>
      @endforeach
    </div>
  </section>
  
  <!-- Shop section end -->
  
  
  <section class="services" id="services">
  
    <h1 class="heading"> our <span>services</span> </h1>
  
    <div class="box-container">
  
        <div class="box">
            <i class="fas fa-dog"></i>
            <h3>Campaign</h3>
            <a href="/campaigns" class="btn">read more</a>
        </div>
  
        <div class="box">
            <i class="fas fa-cat"></i>
            <h3>Adoption</h3>
            <a href="/pets" class="btn">read more</a>
        </div>
  
        <div class="box">
            <i class="fas fa-bath"></i>
            <h3>Shelters</h3>
            <a href="/shelters" class="btn">read more</a>
        </div>
  
        <div class="box">
            <i class="fas fa-drumstick-bite"></i>
            <h3>Donation</h3>
            <a href="/campaigns" class="btn">read more</a>
        </div>
  
    </div>
  </section>
  
  
  
  <section class="contact" id="contact">
  
    <div class="image">
        <img src="/assets/contact_img.png" alt="">
    </div>
  
    <form action="/contact" method="POST">
        <h3>contact us</h3>
        @csrf
        <input name="name" type="text" placeholder="your name" class="box">
        <input name="email" type="email" placeholder="your email" class="box">
        <input name="phone" type="text" placeholder="your number" class="box">
        <textarea name="message" placeholder="your message" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="send message" class="btn">
    </form>
  
  </section>
  
@endsection
