<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="logo">
            Food<span>Bazar</span>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <div class="account">
            <a href="{{ route('login') }}" class="custom">Login</a>
            <a href="{{ route('signup') }}" class="custom">Sign Up</a>

        </div>
    </header>

    <!-- Main Content Section -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Section -->



    <div class="containerFooter">
        <img src="{{ asset('images/Footer.png') }}" alt="Background Image" class="background-image">
        <div class="content">
            <h1 class="logo">Food<span>Bazar</span></h1>
            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
            <p class ="clrchange">Opening Hours: Sun-Fri (9am - 6pm)</p>
            <div class="subscribe">
                <input type="email" placeholder="Enter Your Email">
                <button>SUBSCRIBE</button>
            </div>
            <hr>
            <p class="copyright">&copy; Developed by SyntaxError 2024</p>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
<style>
    /* Resetting some default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Header styling */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.logo {
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

.logo span {
    color: orange;
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 20px;
}

.nav-links a {
    text-decoration: none;
    color: #333;
    font-weight: 700;
}

.nav-links li a:hover {
    color: #ff5722;
}

.account {
    display: flex;
    gap: 10px;
    align-items: center;
}

.account .custom {
    text-decoration: none;
    color: #333;
    font-weight: 700;
    padding: 8px 15px;
    border: 1px solid #ddd;
    border-radius: 20px;
    transition: color 0.3s ease;
}

.account .custom:hover {
    color: #ff5722;
}



</style>


<style>
        .hero {
            display: flex;
            justify-content: space-between;
            padding: 50px;
        }

        .welcome {
            width: 800px;
            background-image: url('{{ asset('images/orgBanner.png') }}');
            background-size: 100% auto;
            background-repeat: no-repeat;
            border-radius: 10px;
            margin-right: 30px;
        }

        .box {
            margin-left: 385px;
            margin-top: 57px;
        }

        .hero .welcome .box .search-bar {
            display: flex;
            margin-top: 20px;
        }

        .hero .welcome .box .search-bar input {
            width: 60%;  /* Set to a percentage of the container width */
            padding: 10px 20px;
            border-radius: 30px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-right: 10px;  /* Space between input and button */
        }

        .hero .welcome .box .search-bar input::placeholder {
            text-align: center;
            font-weight: 600;
            font-size: 16px;
        }

        .hero .welcome .box .search-bar button {
            padding: 10px 20px;
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            cursor: pointer;
        }

        .hero .welcome .box .search-bar button:hover {
            background-color: #e64a19;  /* Slightly darker hover effect */
        }

        .food-categories {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 20px;
        }

        .food-item {
            text-align: center;
            padding: 30px 20px;
        }

        .food-item img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .slider {
            width: 300px;
            overflow: hidden;
            position: relative;
        }

        .slide {
            display: none;
            width: 100%;
            text-align: center;
        }

        .slide.active {
            display: block;
        }

        .slide img {
            width: 100%;
            border-radius: 10px;
        }
    </style>

<script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        // Initial display of the first slide
        showSlide(currentSlide);

        // Change slides every 3 seconds
        setInterval(nextSlide, 3000);
    </script>


    <style>
            .foodSearch {
            padding: 20px;
            text-align: center;
        }

        .foodSearch .search-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            background-color: #ddd;

        }

        .foodSearch .search-bar input[type=text]{
            width: 60%;  
            padding: 10px 20px;

            border: 1px solid #ccc;
            font-size: 16px;
            margin-right: 10px;  
        }

        .foodSearch .search-bar input::placeholder {
            text-align: center;
            font-weight: 600;
            font-size: 16px;
        }

        .foodSearch .search-bar button {
            padding: 10px 20px;
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            cursor: pointer;
        }

        .foodSearch .search-bar button:hover {
            background-color: #e64a19;
        }

    </style>
    <style>
    /* Testimonial Section Styling */
    .testimonial-section {
        text-align: left;
        padding: 50px;
        background-color: #fff;
        margin-bottom: 50px;
    }

    .testimonial-section h2, .testimonial-section h3 {
        margin-left: 50px;
    }

    .testimonial-section h3 {
        color: #ff6600;
        font-size: 20px;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .testimonial-section h2 {
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .testimonial-section h2 {
            font-size: 28px;
        }

        .testimonial-container {
            justify-content: center;
        }

        .testimonial {
            max-width: 100%;
            padding: 15px;
        }

        .testimonial .user-img {
            width: 50px;
            height: 50px;
        }
    }
</style>


<style>
    /* Resetting some default styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    .ContainerForCatagory {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        gap: 20px;
    }

    .sidebar {
        width: 25%;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
    }

    .sidebar h2 {
        font-size: 22px;
        color: #333;
        margin-bottom: 20px;
    }

    .category {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .category input[type="checkbox"] {
        margin-right: 10px;
    }

    .category label {
        font-size: 18px;
        color: #333;
    }

    .category .count {
        font-size: 14px;
        color: #777;
    }

    .main-content {
        width: 70%;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .header h2 {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .header select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
    }

    .food-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .food-item {
        width: calc(33.33% - 20px);
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
        transition: transform 0.3s ease-in-out;
    }

    .food-item:hover {
        transform: scale(1.05);
    }

    .food-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
    }

    .food-details {
        margin-top: 15px;
    }

    .food-details h3 {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .food-details p {
        font-size: 16px;
        color: #555;
        margin-bottom: 5px;
    }
</style>

<style>
    
.containerFooter {
    position: relative;
    width: 100%;
    /* height: 100vh; */
    overflow: hidden;
}

.containerFooter .background-image {
    position: relative;
    top: 0;
    left: 0;
    width: 100%;
    height: 300px;
    object-fit: cover;
}

.containerFooter .content {
    margin:70px 0 0 0 ;
    position: absolute;
    top:25%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: rgb(0, 0, 0); 
}

.containerFooter .content .logo {
    font-size: 36px;
    margin-bottom: 20px;
}

.containerFooter .content .subscribe {
    margin-top: 30px;
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.containerFooter .content .subscribe input[type="email"] {
    padding: 10px;
    border: none;
    border-radius: 5px;
    margin-right: 10px;
}

.containerFooter .content .subscribe button {
    padding: 10px 20px;
    background-color: #ff6600; /* Button color */
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.containerFooter .content .copyright {
    margin-top:30px;
    font-size: 14px;
}

.clrchange{
    color:orange;
}
</style>
</html>
