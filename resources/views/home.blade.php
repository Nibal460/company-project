<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
   <link rel="stylesheet" href="{{ asset('css/app1.css') }}">
   
   
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap" rel="stylesheet"> <!-- Rubik font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Home</title>
   
    <style>
    /* Basic styling */
   
   

body {
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
    }
   /*slider*/
/*slider*/

.slider {
    border:5px solid #36beee;
    position: relative;
    width: 80%;
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    background-color:white ;
    
}

.slider h2 {
      font-family: 'Open Sans', sans-serif; /* Apply Open Sans font to the h2 element */
      font-weight: 700; /* Optionally specify font weight */
            /* Add any other styles for the h2 element */
        }

       /* Define styles for the .slider p elements */
 .slider p {
  font-family: 'Open Sans', sans-serif; /* Apply Open Sans font to the p elements */
  /* Add any other styles for the p elements */
        }


h2 {
    direction:ltr;
    font-family: 'Georgia', serif;
    font-size: 24px;
    color: #333;
    
}

p {
    direction:ltr;
    font-family: 'Verdana', sans-serif;
    font-size: 18px;
    color: #666;
    font-family: 'Rubik', 'Noto Naskh Arabic', sans-serif;
}
@media (max-width: 768px) {
    .slider {
        padding: 10px;
        max-width: 400px;
    }

    h2 {
        font-size: 20px;
    }

    p {
        direction:ltr;
        font-size: 16px;
    }
}
/*end slider*/
   
/* Set direction to right-to-left */
.navbar {
    background-color: #36beee;
    overflow: hidden;
    direction: rtl;
    font-family: 'Rubik', 'Noto Naskh Arabic', sans-serif;
}
.navbar a {
    float: right; /* Float the links to the right */
    display: block;
    color: #000000;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
    font-size: 18px; /* Increase font size */
    font-weight: bold; /* Make the text bold */
    direction: rtl;
    font-family: 'Rubik', 'Noto Naskh Arabic', sans-serif;
}
.dropdown {
    float: right; /* Float the dropdowns to the right */
    overflow: hidden;
    background-color: #36beee;
    z-index: 1100; 

}
.dropdown .dropbtn {
    font-size: 18px; /* Increase font size */
    font-weight: bold; /* Make the text bold */
    border: none;
    outline: none;
    color: #000000;
    padding: 14px 20px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
    font-family: 'Rubik', 'Noto Naskh Arabic', sans-serif;
}
.navbar a:hover {
    color: #000000;
}
.dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 400px; /* Increase width to accommodate larger image */
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1100;
    right: 0; /* Align the dropdown content to the right */
    direction: ltr; /* Ensure content is aligned properly */
    font-family: 'Rubik', 'Noto Naskh Arabic', sans-serif;
    font-family: 'Lora', serif;
}
.dropdown-content a {
    float: none;
    color: #000000;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: right; /* Align text to the right */
    font-family: 'Rubik', 'Noto Naskh Arabic', sans-serif;
    font-family: 'Lora', serif;
}
.dropdown-content a:hover {
    color: #36beee;
}
.dropdown:hover .dropdown-content {
    display: flex;
}
.dropdown-content img {
    display: block;
    margin-left: 10px;
    max-width: 200px; /* Set to twice the original size */
    align-self: center; /* Center image vertically */
}

@media (max-width: 768px) {
    .dropdown-content {
        flex-direction: column; /* Stack items vertically */
        min-width: 100%; /* Full width on smaller screens */
    }
    .dropdown-content img {
        max-width: 100%; /* Full width image */
        margin-left: 0; /* Remove left margin */
        margin-top: 10px; /* Add top margin for spacing */
    }
    .navbar a, .dropdown .dropbtn {
        padding: 10px 15px; /* Adjust padding for smaller screens */
        font-size: 16px; /* Adjust font size for smaller screens */
    }
}
.dropdown2 {
    float: right; /* Float the dropdowns to the right */
    overflow: hidden;
    font-family: 'Roboto', 'Arial', 'Helvetica Neue', sans-serif;
    font-family: 'Lora', serif;
}
.dropdown2 .dropbtn2 {
    font-size: 18px; /* Increase font size */
    font-weight: bold; /* Make the text bold */
    border: none;
    outline: none;
    color: #000000;
    padding: 14px 20px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
    font-family: 'Roboto', 'Arial', 'Helvetica Neue', sans-serif;
}
.dropbtn2 {
    color: rgb(57,190,239);
}
.dropdown2-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    z-index: 1;
}
.dropdown2-content a {
    float: none;
    color: #000000;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}
.dropdown2-content a:hover {
    color: rgb(57,190,239);
}
.dropdown2:hover .dropdown2-content {
    display: block;
}
/* Logo */
.logo {
    display: block;
    margin: 10px auto;
    max-width: 30%;
    height: 30%;
    border-style:solid;
    border-color:transparent #36beee transparent #0a1f34;
}

/* CSS for image container */
.image-container {
    text-align: center;
    margin-top: 20px;
}

/* CSS for image */
.image-container img {
    display: none; /* Hide images by default */
    max-width: 80%; /* Ensure images don't exceed container width */
}

/* CSS for links */
.image-links {
    text-align: center;
    margin-top: 20px;
}

.image-links a {
    margin-right: 20px;
    display: inline-block; /* Ensure links appear inline */
}

/* Responsive CSS */
@media screen and (max-width: 600px) {
    .image-links a {
        margin-right: 10px; /* Reduce margin between links on smaller screens */
    }
}

/* Responsive */
@media screen and (max-width: 600px) {
    .navbar a, .dropdown .dropbtn {
        float: none;
        display: block;
        text-align: left;
    }
    .dropdown-content {
        position: relative;
    }
}
/* Basic styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

/* Navbar styles */
/* Add your existing navbar styles here */

/* Container for squares */
.square-container {
    max-width: 80%;
    margin: 20px auto;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.row {
    display: flex;
    width: 100%;
    justify-content: space-between;
    margin-bottom: 10px;
}

.square {
    flex-basis: calc(33.33% - 20px);
    height: 0;
    padding-bottom: calc(33.33% - 20px);
    margin: 10px;
    background-color: rgb(57, 190, 239);
    box-sizing: border-box;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 20px;
    text-align: center;
    overflow: hidden;
    transition: transform 0.3s ease;
}

/*.primary-image {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
}*/

.square.blue {
    background-color: rgb(57, 190, 239);
}

.square-text {
    color: white; /* Set text color to white */
    text-align: center; /* Center-align the text */
    font-size: 1.5em;
    position: absolute; /* Position the text absolutely */
    top: 50%; /* Position the text 50% from the top */
    transform: translateY(-50%); /* Center the text vertically */
    font-family: 'Rubik', 'Noto Naskh Arabic', sans-serif;
}

/*.image {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    display: none;
    position: absolute;
    top: 0;
    left: 0;
}*/

.fixed-image, .hover-image1, .hover-image2, .hover-image3  {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    display: none;
}
.fixed-image {
    display: block; /* Ensure the primary image is visible */
}

.hover-image1, .hover-image2, .hover-image3{
            display: none; /* Hide the hover images by default */
        }
/*.square.image:hover {
    transform: scale(1.3);
    z-index: 10;
}*/

/* Responsive CSS */
@media screen and (max-width: 600px) {
    .square {
        flex-basis: calc(50% - 10px);
        padding-bottom: calc(50% - 10px);
    }

    .square-text {
        font-size: 0.7em;
    }
}
/*begin the 4images*/
.container2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 40px; /* Add space between grid items */
    padding: 0;
    width: 60%; /* Adjust as needed */
    margin: 0 auto; /* Center the grid */
    position: relative; /* Make the container a positioned element */
    font-family: 'Roboto', sans-serif;
}

.item {
    position: relative;
    overflow: hidden;
    cursor: pointer;
    width: 100%;
    height: 0;
    padding-bottom: 75%; /* Maintain aspect ratio */
    font-family: 'Roboto', sans-serif;
}

.item img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.item:hover img {
    transform: scale(1.1);
}

.item .text-container2 {
    position: absolute;
    bottom: 10px;
    left: 10px;
    right: 10px;
    color: white;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
    padding: 10px;
    transition: bottom 0.3s ease, transform 0.3s ease;
    font-family: 'Open Sans', sans-serif;
}

.item .text-container2 .text {
    font-size: 24px; /* Increase font size */
    font-family: 'Open Sans', sans-serif;
}

.item .text-container2 .hover-text {
    display: none;
    margin-top: 10px; /* Space between title and paragraph */
}

.item:hover .text-container2 {
    bottom: 50%;
    transform: translateY(50%);
}

.item:hover .text-container2 .hover-text {
    display: block;
}


/* Center logo */
.center-logo {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 30%; /* Adjust as needed */
    z-index: -1; /* Ensure it is behind the grid items */
}


/* Responsive adjustments */
@media (max-width: 768px) {
    .container2 {
        grid-template-columns: 1fr;
        grid-template-rows: repeat(4, auto);
        gap: 20px; /* Adjust spacing for responsive view */
    }
    .item {
        padding-bottom: 75%; /* Maintain aspect ratio */
    }
    .center-logo {
        width: 50%; /* Adjust logo size for smaller screens */
    }
}

@media (max-width: 480px) {
    .item {
        padding-bottom: 100%; /* Adjust aspect ratio for very small screens if needed */
    }
    .center-logo {
        width: 70%; /* Adjust logo size for very small screens */
    }
}

/*end the 4images*/
.footer {
    color: #fff;
    padding: 30px 15px; /* Adjusted padding to 15px */
    margin-top: 100px;
}

.footer h4 {
    color: #fff;
    font-weight: bold;
}

.footer p {
    color: #fff;
}

.footer .container {
    max-width: 1140px;
    margin: 0 auto;
    padding: 0 15px; /* Adjusted padding to 15px */
}

@media (max-width: 992px) {
    .footer .container {
        max-width: 100%;
        padding: 0 15px; /* Adjusted padding to 15px */
    }

    .footer .row {
        flex-direction: column;
        align-items: center;
    }

    .footer .col-md-4 {
        margin-bottom: 30px;
    }
}

@media (max-width: 768px) {
    .footer .row {
        text-align: center;
    }

    .footer .col-md-4 {
        margin-bottom: 30px;
    }

    .footer .col-md-4:last-child {
        margin-bottom: 0;
    }
}

@media (max-width: 576px) {
    .footer .col-md-4 {
        margin-bottom: 30px;
    }

    .footer .row {
        text-align: center;
    }

    .footer .col-md-4:last-child {
        margin-bottom: 0;
    }

    .footer .col-md-4:nth-child(3) {
        margin-top: 30px;
    }

    .footer .col-md-4:nth-child(3) p {
        margin-top: 10px;
    }

    .footer .col-md-12.text-center {
        text-align: center;
    }
}


.faq-container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        .faq-item {
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .faq-question {
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.2em;
            font-family: 'Rubik', 'Noto Naskh Arabic', sans-serif;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-out, padding-top 0.5s ease-out;
            font-size: 1.2em;
            font-family: 'Rubik', 'Noto Naskh Arabic', sans-serif;
        }

        .toggle-symbol {
            font-weight: bold;
            font-size: 1.5em;
        }
        .logo{
            border-radius: 50%;
        }

        @media (max-width: 768px) {
            .faq-container {
                width: 100%;
                padding: 10px;
            }

            .faq-question {
                font-size: 1em;
            }

            .faq-answer {
                font-size: 0.9em;
            }

            .toggle-symbol {
                font-size: 1.2em;
            }
        }
   
    .fullscreen-slider-container {
      position: relative;
      overflow: hidden;
      width: 100%;
      height: auto;
      direction:ltr;
    }

    .fullscreen-slider {
      display: flex;
      transition: transform 0.5s ease;
    }

    .fullscreen-slide {
      min-width: 100%;
      height: 100%;
      align-items: center;
      justify-content: center;
      display: none;
    }

    .fullscreen-slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .navigation-points {
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
    }

    .navigation-point {
      width: 15px;
      height: 15px;
      margin: 0 5px;
      border-radius: 50%;
      background: white;
      border: 3px solid rgb(57, 190, 239);
      cursor: pointer;
    }

    .navigation-point.active {
        background: rgb(57, 190, 239);
    }



  .navigation {
    position: absolute;
    bottom: 20px; /* Adjust this value to position the arrows higher or lower */
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .navigation button {
    background-color: rgba(0, 0, 0, 0.5);
    border: none;
    color: white;
    font-size: 2rem;
    cursor: pointer;
    padding: 10px; /* Optional: Add some padding to the buttons */
    margin: 0 10px; /* Space between buttons */
  }
  
  body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .marquee-container {
            display: flex;
            align-items: center;
            width: 100%;
            height: 250px;
            background-color: white;
            margin-top:60px;
            overflow: hidden;
            box-sizing: border-box;
            direction:ltr;
            border: 4px solid rgb(57, 190, 239);
        }

        .marquee-text {
            flex: 0 0 15%;
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            background-color: white;
            z-index: 1;
            border-right: 4px solid rgb(57, 190, 239);
            box-sizing: border-box;
            display: flex;
            flex-direction: column; /* Ensure the text and image are stacked vertically */
            align-items: center;
            justify-content: center;
            height: 100%;
            margin: 0;
            direction: ltr;
            font-family: 'Rubik', 'Noto Naskh Arabic', sans-serif;
        }
        .marquee-text img{
            margin-top:5px;
            width:70%;
        }
        .marquee {
            flex: 1;
            overflow: hidden;
            position: relative;
            height: 100%;
        }

        .marquee-content {
            display: flex;
            animation: marquee 60s linear infinite;
        }

        .marquee-content:hover {
            animation-play-state: paused;
        }

        .marquee img {
            display: block;
            margin-right: 20px;
            margin-left:20px;
            height: 230px;
            width: auto;
            vertical-align: middle;
        }

        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        @media (max-width: 768px) {
    .marquee-container {
        height: 150px;
    }

    .marquee-text {
        font-size: 20px;
    }

    .marquee img {
        height: 120px;
    }
}

@media (max-width: 576px) {
    .marquee-container {
        height: 120px;
    }

    .marquee-text {
        font-size: 16px;
    }

    .marquee img {
        height: 100px;
    }
}



    </style>
 <script>
        document.addEventListener('DOMContentLoaded', function() {
            const faqItems = document.querySelectorAll('.faq-item');

            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                const answer = item.querySelector('.faq-answer');
                const toggleSymbol = item.querySelector('.toggle-symbol');

                question.addEventListener('click', () => {
                    if (answer.style.maxHeight && answer.style.maxHeight !== '0px') {
                        answer.style.maxHeight = '0';
                        answer.style.paddingTop = '0';
                        toggleSymbol.textContent = '+';
                    } else {
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                        answer.style.paddingTop = '10px';
                        toggleSymbol.textContent = '-';
                    }
                });
            });
        });
    </script>
</head>
<body>
@extends('layouts.app2')

<script src="{{ asset('js/app.js') }}"></script>


    <div class="navbar">
    
    
       
       <a href="{{ route('home') }}">الصفحة الرئيسية</a>
    
    <div class="dropdown">
         <button class="dropbtn" onclick="toggleDropdown()">
    قسم التدريب والتأهيل</button>
    <div class="dropdown-content">
        <div>
        <a href="{{ route('automation') }}">دورات التأهيل المهني في التحكم والأتمتة الصناعية</a>
        <a href="{{ route('robotech') }}">دورات التأهيل المهني في الروبوتيك</a>
        <a href="{{ route('development') }}">دورات التأهيل المهني في الIT</a>
        <a href="{{ route('industrial') }}">دورات التأهيل المهني في الصيانة</a>
    </div>
    <img src="{{ asset('images/training1.jpg') }}" alt="Training-Image">
    </div>
</div>

<a href="{{ route('download') }}" class="arabic-text">التنزيلات</a>
    <!-- Check if the user is authenticated -->
    @auth
    <div class="dropdown2">
        <button class="dropbtn2">Profile</button>
        <div class="dropdown2-content">
            <!-- Link to user profile -->
            
            <a href="{{ route('profile3.show')}}">View Profile</a>
    <!-- Logout link -->
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
                </div>
                </div>
    <!-- Logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @else
        <!-- Display login link if user is not authenticated -->
        <a href="{{ route('kind') }}">Login</a>
    @endauth
</div>

<div class="fullscreen-slider-container">
    <div id="slide1" class="fullscreen-slide">
      <img src="images/image1.jpg" alt="Slide 1">
    </div>
    <div id="slide2" class="fullscreen-slide">
      <img src="images/image2.jpg" alt="Slide 2">
    </div>
    <div id="slide3" class="fullscreen-slide">
      <img src="images/image3.jpg" alt="Slide 3">
    </div>
    <div id="slide4" class="fullscreen-slide">
      <img src="images/image4.jpg" alt="Slide 4">
    </div>
    <div class="navigation-points">
      <div class="navigation-point" onclick="jumpToSlide(0)"></div>
      <div class="navigation-point" onclick="jumpToSlide(1)"></div>
      <div class="navigation-point" onclick="jumpToSlide(2)"></div>
      <div class="navigation-point" onclick="jumpToSlide(3)"></div>
    </div>
  </div>

  <script>
    let slideIndex = 0; // Start at the first slide
    let interval;

    function showSlide(index) {
      const slides = document.querySelectorAll('.fullscreen-slide');
      const points = document.querySelectorAll('.navigation-point');

      if (index >= slides.length) {
        slideIndex = 0;
      } else if (index < 0) {
        slideIndex = slides.length - 1;
      } else {
        slideIndex = index;
      }

      slides.forEach((slide, i) => {
        slide.style.display = (i === slideIndex) ? 'flex' : 'none';
      });

      points.forEach((point, i) => {
        point.classList.toggle('active', i === slideIndex);
      });
    }

    function nextSlide() {
      slideIndex = (slideIndex + 1) % document.querySelectorAll('.fullscreen-slide').length;
      showSlide(slideIndex);
    }

    function jumpToSlide(index) {
      slideIndex = index;
      showSlide(slideIndex);
      resetInterval(); // Reset the interval when a point is clicked
    }

    function resetInterval() {
      clearInterval(interval);
      interval = setInterval(nextSlide, 5000); // Move to the next slide every 5 seconds
    }

    document.addEventListener("DOMContentLoaded", function(event) {
      showSlide(slideIndex); // Show the first slide initially
      interval = setInterval(nextSlide, 5000); // Move to the next slide every 5 seconds
    });
  </script>


<div class="slider">
            <h2>Tech Turn </h2>
            <p>
An engineering training, consulting and studies company in electrical, mechanical, mechatronics and informatics engineering.</p>
<p>In addition to its work in manufacturing machines, production lines, robots,
applications and websites.</p>

            </p>
        </div>
    @include('partials.icons')

<script>
    function updateBackgroundColors() {
   
    var fixedIconsContainer = document.querySelector('.fixed-icons-container');
    var sliderContainer = document.querySelector('.fullscreen-slider-container');
    
    var sliderBottom = sliderContainer.getBoundingClientRect().bottom;

    if (sliderBottom < 10) {
            fixedIconsContainer.querySelectorAll('img').forEach(function(img) {
            img.style.backgroundColor = 'rgba(255, 255, 255, 0.9)'; // White with opacity
        });
    } else {
            fixedIconsContainer.querySelectorAll('img').forEach(function(img) {
            img.style.backgroundColor = 'rgba(240, 240, 240, 0.9)'; // Very light gray with opacity
        });
    }
}

// Run the function when the page loads
document.addEventListener('DOMContentLoaded', updateBackgroundColors);

// Run the function on scroll
document.addEventListener('scroll', updateBackgroundColors);


    </script>
   <!-- Include jQuery -->
<div class="square-container">
    <div class="row">
        <div class="square blue">
            <div class="square-text">ندعم أفكاراً جديدة للوصول إلى مستقبل أفضل</div>
        </div>
        <div class="square" id="square32">
            <div class="fixed-image" style="background-image: url('images/automation18.jpg');"></div>
            <div class="hover-image1" style="background-image: url('images/automation2.jpg'); display: none;"></div> <!-- Hide by default -->
            <div class="hover-image2" style="background-image: url('images/automation3.jpg'); display: none;"></div> <!-- Hide by default -->
            <div class="hover-image3" style="background-image: url('images/automation22.jpg'); display: none;"></div> <!-- Hide by default -->
        </div>
        <div class="square blue">
            <div class="square-text" class="arabic-text">تجهيزات ومعدات الشركة في خدمة المتدربين</div>
        </div>
    </div>
    <!--the second row-->
    <div class="row">
        <div class="square" id="square33">
        <div class="fixed-image"  style="background-image: url('images/maintenance8.jpg');"></div>
        <div class="hover-image1" style="background-image: url('images/maintenance3.jpg'); display: none;"></div> <!-- Hide by default -->
        <div class="hover-image2" style="background-image: url('images/maintenance2.webp'); display: none;"></div> <!-- Hide by default --> 
        <div class="hover-image3" style="background-image: url('images/maintenance23.jpg'); display: none;"></div> <!-- Hide by default --> 
        </div>
        <div class="square blue">
            <div class="square-text" class="arabic-text">نواكب العصر بالتدريب والمعرفة</div>
        </div>
        <div class="square" id="square34">
        <div class="fixed-image"  style="background-image: url('images/programming-languages.jpg');"></div>
        <div class="hover-image1" style="background-image: url('images/web-development2.jpg'); display: none;"></div> <!-- Hide by default -->
        <div class="hover-image2" style="background-image: url('images/android-app2.webp'); display: none;"></div> <!-- Hide by default -->
        <div class="hover-image3" style="background-image: url('images/coding12.webp'); display: none;"></div> <!-- Hide by default -->  
        </div>
    </div>

    <!--the third row-->
    <div class="row">
        <div class="square blue" >
            <div class="square-text" class="arabic-text">نعمل مع الشركاء</div>
        </div>
        <div class="square" id="square35">
            <div class="fixed-image"  style="background-image: url('images/industrial-machine.jpg');"></div>
            <div class="hover-image1" style="background-image: url('images/robot-kids.jpg'); display: none;"></div> <!-- Hide by default -->
            <div class="hover-image2" style="background-image: url('images/robot46.jpg'); display: none;"></div> <!-- Hide by default -->
            <div class="hover-image3" style="background-image: url('images/robot-worker.jpg'); display: none;"></div> <!-- Hide by default -->  
        </div>

        <div class="square blue">
            <div class="square-text" class="arabic-text">نقدم شهادات معتمدة</div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
$(document).ready(function(){
    var hoverTimeout;

    $(".square").hover(
        function() {
            var hoverable = $(this);
            clearTimeout(hoverTimeout); // Clear any existing timeout

            // Hide the fixed image and show the first hover image
            hoverable.find(".fixed-image").hide();
            hoverable.find(".hover-image1").show();

            // Set timeouts to sequence the hover images
            hoverTimeout = setTimeout(function() {
                hoverable.find(".hover-image1").hide();
                hoverable.find(".hover-image2").show();
                hoverTimeout = setTimeout(function() {
                    hoverable.find(".hover-image2").hide();
                    hoverable.find(".hover-image3").show();
                }, 1000); // Show third hover image after 1 second
            }, 1000); // Show second hover image after 1 second
        },
        function() {
            var hoverable = $(this);
            clearTimeout(hoverTimeout); // Clear any existing timeout

            // Clear all hover images and show the fixed image immediately
            hoverable.find(".hover-image3").hide();
            hoverable.find(".hover-image2").hide();
            hoverable.find(".hover-image1").hide();
            hoverable.find(".fixed-image").show();
        }
    );
});
</script>





<div class="faq-container">
        <h1>الأسئلة المتكررة:</h1>
        
        <div class="faq-item">
            <div class="faq-question">
                <span>ما هو نوع التدريب الذي تقدمونه؟</span>
                <span class="toggle-symbol">+</span>
            </div>
            <div class="faq-answer">
                تدريب عملي تستطيع من خلاله البدء بمشروعك الخاص أوتحقيق
                قبول وظيفي لدى الشركات والمصانع داخل وخارج البلد
                في مجال:
                <ul>
                    <li>التحكم والأتمتة الصناعية</li>
                    <li>الربوتيك والتصميم</li>
                    <li>البرمجة و ال IT</li>
                    <li>التصميم الكهربائي والتنفيذ</li>
                
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>من هي الفئة المستهدفة للتدريب؟</span>
                <span class="toggle-symbol">+</span>
            </div>
            <div class="faq-answer">
جميع الأعمار وبالأخص طلاب الهندسة الميكانيكية والكهربائية والميكاترونيكس و المعلوماتية
والمعاهد التقنية وفروعها.

                          </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>كيف يمكن الإستفادة من معدات وتجهيزات الشركة؟</span>
                <span class="toggle-symbol">+</span>
            </div>
            <div class="faq-answer">
    تستطيع تنفيذ دارات ومشاريع متعددة متنوعة لمختلف الهندسات.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>هل يقدم مركزكم دورات أونلاين؟</span>
                <span class="toggle-symbol">+</span>
            </div>
            <div class="faq-answer">
                لا تقدم الشركة في الوقت الراهن دورات اونلاين(عن بعد) ولكن بعد فترة ستتوفر الخدمة.
             
            </div>
        </div>
    </div>
<div class="container2">
        <div class="item">
            <img src="images/mechanical11.jpg" alt="Image 1">
             <div class="text-container2">
                <div class="text">Mechanical Engineering</div>
                <div class="hover-text">the study of physical machines that may involve force and movement </div>
            </div>
    </div>
        <div class="item">
            <img src="images/electrical18.jpg" alt="Image 2">
             <div class="text-container2">
            <div class="text">Electrical Engineering</div>
            <div class="hover-text">an engineering discipline concerned with the study and application of equipment, devices, and systems which use electricity and electromagnetism </div>
        </div>
          </div>
        <div class="item full-width">
            <img src="images/mechatronix11.jpg" alt="Image 3">
             <div class="text-container2">
            <div class="text">Mechatronix Engineering</div>
            <div class="hover-text">a multidisciplinary field that refers to the skill sets needed in the contemporary, advanced automated manufacturing industry</div>
        </div>
        </div>
        <div class="item full-width">
            <img src="images/software11.jpg" alt="Image 4">
             <div class="text-container2">
            <div class="text">Information Technology</div>
            <div class="hover-text">a set of related fields that encompass computer systems, software, programming languages, and data and information processing, and storage</div>
        </div>
        </div>
    </div>
    </br>
    <div class="marquee-container">
        <div class="marquee-text">عملائنا
        
        <img src="images/clients-icon.png" alt="Clients">
        </div>
        <div class="marquee">
            <div class="marquee-content" id="marquee-content">
                <!-- Initial set of images -->
                <img src="images/logo-image1.png" alt="Company 1">
                <img src="images/logo-image2.jpg" alt="Company 2">
                <img src="images/logo-image3.png" alt="Company 3">
                <img src="images/logo-image4.jpg" alt="Company 4">
                <img src="images/logo-image5.jpg" alt="Company 5">
                <img src="images/logo-image6.png" alt="Company 6">
                <!-- Duplicate set for continuous scroll -->
                <img src="images/logo-image1.png" alt="Company 1">
                <img src="images/logo-image2.jpg" alt="Company 2">
                <img src="images/logo-image3.png" alt="Company 3">
                <img src="images/logo-image4.jpg" alt="Company 4">
                <img src="images/logo-image5.jpg" alt="Company 5">
                <img src="images/logo-image6.png" alt="Company 6">
                <!-- Third set for continuous scroll -->
                <img src="images/logo-image1.png" alt="Company 1">
                <img src="images/logo-image2.jpg" alt="Company 2">
                <img src="images/logo-image3.png" alt="Company 3">
                <img src="images/logo-image4.jpg" alt="Company 4">
                <img src="images/logo-image5.jpg" alt="Company 5">
                <img src="images/logo-image6.png" alt="Company 6">
                <!-- Fourth set for continuous scroll -->
                <img src="images/logo-image1.png" alt="Company 1">
                <img src="images/logo-image2.jpg" alt="Company 2">
                <img src="images/logo-image3.png" alt="Company 3">
                <img src="images/logo-image4.jpg" alt="Company 4">
                <img src="images/logo-image5.jpg" alt="Company 5">
                <img src="images/logo-image6.png" alt="Company 6">
            </div>
        </div>
    </div>
   
   
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const marqueeContent = document.getElementById('marquee-content');
            const images = Array.from(marqueeContent.querySelectorAll('img'));
            const totalImages = images.length / 4; // Number of unique images per set
            const imageWidth = images[0].offsetWidth + 10; // Including margin-right
            const totalWidth = imageWidth * totalImages;

            // Clone images dynamically for continuous scroll
            const cloneContent = marqueeContent.innerHTML;
            marqueeContent.innerHTML += cloneContent;

            // Set the width of the marquee-content to fit all images
            marqueeContent.style.width = `${totalWidth * 4}px`;
        });
    </script>
    </div>
    </div>

    @include('partials.map_popup')

</body>
</html>
</body>
</html>
@include('footer')
   


</body>
</html>   
