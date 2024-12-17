@extends('layouts.base')

@section('title', 'Home')

@section('content')

    <!-- Hero Section -->
    <div class="hero">
        <div class="welcome">
            <div class="box">
                <h2>Welcome to FoodBazar</h2>
                <p>Your favorite food delivered to your doorsteps</p>
                <div class="search-bar">
                    <input type="text" placeholder="Search for food, restaurants, etc...">
                    <button class="search-btn">Search</button>
                </div>
            </div>
        </div>

        <!-- Slider Section -->
        <div class="slider">
            <div class="slide active">
                <img src="{{ asset('images/slider1.png') }}" alt="Slide 1">
            </div>
            <div class="slide">
                <img src="{{ asset('images/slider2.jpg') }}" alt="Slide 2">
            </div>
            <div class="slide">
                <img src="{{ asset('images/slider3.jpg') }}" alt="Slide 3">
            </div>
        </div>
    </div>


    <div class="food-categories">
        <div class="food-item">
            <img src="{{ asset('images/food1.jpg') }}" alt="Pizza">
            <p>Pizza</p>
        </div>
        <div class="food-item">
            <img src="{{ asset('images/food2.jpg') }}" alt="Burgers">
            <p>Burgers</p>
        </div>
        <div class="food-item">
            <img src="{{ asset('images/food3.jpg') }}" alt="Sushi">
            <p>Sushi</p>
        </div>
        <div class="food-item">
            <img src="{{ asset('images/food1.jpg') }}" alt="Pizza">
            <p>Pizza</p>
        </div>
        <div class="food-item">
            <img src="{{ asset('images/food2.jpg') }}" alt="Burgers">
            <p>Burgers</p>
        </div>
        <div class="food-item">
            <img src="{{ asset('images/food3.jpg') }}" alt="Sushi">
            <p>Sushi</p>
        </div>
    </div>

    <div class="foodSearch">
    <div class="search-bar">
        <input type="text" placeholder="Search for food, restaurants, etc...">
        <button class="search-btn">Search</button>
    </div>
</div>

<div class="ContainerForCatagory">
  <div class="sidebar">
    <h2>Categories</h2>
    
    <div class="category">
      <input type="checkbox" id="biriyani" />
      <label for="biriyani">Biriyani</label>
      <span class="count">1</span>
    </div>
    <div class="category">
      <input type="checkbox" id="burger" />
      <label for="burger">Burger</label>
      <span class="count">1</span>
    </div>
    <div class="category">
      <input type="checkbox" id="pizza" />
      <label for="pizza">Pizza</label>
      <span class="count">2</span>
    </div>
  </div>

  <div class="main-content">
    <div class="header">
      <h2>All Items</h2>
      <select>
        <option>Default sorting</option>
      </select>
    </div>
    <div class="items">
    @foreach ($foods as $food)
    <div class="card">
        <a href="{{ route('food.product', $food['id']) }}">
            <img src="{{ asset('images/' . $food['image']) }}" alt="{{ $food['name'] }}"></a>
            <h3>{{ $food['name'] }}</h3>
            <span class="new-price">Price: ${{ $food['price'] }}</span>	
            <div class="rating">★★★★★</div>
        
    </div>
      @endforeach

</div>
</div>
</div>








<div class="ContainerForCatagory">
  <div class="sidebar">
    <h2>Special Offers</h2>
    
    <div class="category">
      <input type="checkbox" id="biriyani" />
      <label for="biriyani">Biriyani</label>
      <span class="count">1</span>
    </div>
    <div class="category">
      <input type="checkbox" id="burger" />
      <label for="burger">Burger</label>
      <span class="count">1</span>
    </div>
    <div class="category">
      <input type="checkbox" id="pizza" />
      <label for="pizza">Pizza</label>
      <span class="count">2</span>
    </div>
  </div>

  <div class="main-content">
    <div class="header">
      <h2>Special Offer Item</h2>
      <select>
        <option>Default sorting</option>
      </select>
    </div>
    <div class="items">
    @foreach ($foods as $food)
    <div class="card">
        <a href="{{ route('food.product', $food['id']) }}">
            <img src="{{ asset('images/' . $food['image']) }}" alt="{{ $food['name'] }}"></a>
            <h3>{{ $food['name'] }}</h3>
            <span class="new-price">Price: ${{ $food['price'] }}</span>	
            <div class="rating">★★★★★</div>
        
    </div>
@endforeach


</div>
</div>
</div>




    <!-- Testimonial Section -->
    
    <section class="testimonials-section">
        <h3>Testimonial</h3>
        <h2>10 Years of Experience <br>in Food Delivery</h2>
        
        <div class="testimonial-container">
            <div class="testimonial">
            <img src="{{ asset('images/t1.jpg') }}" alt="review">
                <h4>Syntax Error</h4>
                <div class="rating">⭐⭐⭐⭐⭐</div>
                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                <span class="date">3 days ago by Google</span>
            </div>

            <div class="testimonial">
            <img src="{{ asset('images/t1.jpg') }}" alt="review">
                <h4>Syntax Error</h4>
                <div class="rating">⭐⭐⭐⭐⭐</div>
                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                <span class="date">3 days ago by Google</span>
            </div>
        </div>
    </section>


    <style>
        
.testimonials-section {
    text-align: left;
    padding: 50px;
    background-color: #fff;
    margin-bottom: 50px;
}

.testimonials-section h3 {
    color: #ff6600;
    font-size: 20px;
    margin-bottom: 10px;
    font-weight: 600;
}
.testimonials-section h2,h3{
    margin-left:50px;
}

.testimonials-section h2 {
    font-size: 32px;
    color: #333;
    font-weight: 700;
    margin-bottom: 40px;
    line-height: 1.4;
}

.testimonial-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.testimonial {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 500px;
    width: 100%;
    text-align: left;
    margin: 10px;
}

.testimonial .user-img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    float: left;
    margin-right: 15px;
}

.testimonial h4 {
    font-size: 18px;
    color: #333;
    font-weight: 600;
    margin: 0;
}

.testimonial .rating {
    color: #ffcc00;
    font-size: 16px;
    margin: 5px 0;
}

.testimonial p {
    font-size: 15px;
    color: #666;
    line-height: 1.6;
    margin: 10px 0;
    clear: both;
}

.testimonial .date {
    font-size: 13px;
    color: #999;
}
    </style>

    <style>
        .ContainerForCatagory {
    display: flex;
    margin: 20px;
    margin-bottom: 50px;

    padding: 50px;
  }
  
  .ContainerForCatagory .sidebar {
    width: 25%;
    background-color: #fff5e6;
    padding: 20px;
    border-radius: 10px;
  }
  
  .ContainerForCatagory .sidebar h2 {
    margin-bottom: 20px;
  }
  
  .ContainerForCatagory .sidebar .category {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 10px 0;
  }
  
  .ContainerForCatagory .sidebar .category input {
    margin-right: 10px;
  }
  
  .main-content {
    width: 75%;
    margin-left: 20px;
  }
  
  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }
  
  .items {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
  }
  
  .card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    text-align: center;
    padding: 20px;
  }
  
  .card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
  }
  
  .card h3 {
    margin: 15px 0;
  }
  
  .rating {
    margin: 10px 0;
    color: #ff9800;
  }
  
  .price {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin: 10px 0;
  }
  
  .old-price {
    text-decoration: line-through;
    color: gray;
  }
  
  .new-price {
    color: #ff5722;
  }
    </style>

@endsection

