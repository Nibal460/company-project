<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app1.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap" rel="stylesheet"> <!-- Rubik font -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">

    <title>Automation</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        background-color: #f0f0f0; /* Fallback for older browsers */
        background-color: #f5f5f5; /* Light gray */
        
    }
        
        /*slider*/
        
        
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
        }
        .navbar a:hover {
            color: #000000;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 300px; /* Increase width to accommodate text and image side by side */
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1100;
            right: 0; /* Align the dropdown content to the right */
            direction: ltr; /* Ensure content is aligned properly */
            font-family: 'Rubik', 'Noto Naskh Arabic', sans-serif;
        }
        .dropdown-content a {
            float: none;
            color: #000000;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: right; /* Align text to the right */
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
            max-width: 200px;
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
                        border-radius: 50%;
                    }
                
                    .image-container {
            display: flex;
            justify-content: center; /* Center the images horizontally */
            flex-wrap: wrap; /* Allow images to wrap to the next line on smaller screens */
        }
        .image-container img {
            max-width: 30%; /* Set a maximum width for the images */
            height: 360px; /* Maintain aspect ratio */
            margin: 10px; /* Add some space around the images */
            flex: 1 1 auto; /* Allow images to grow and shrink */
        }
        @media (max-width: 768px) {
       .image-container {
        flex-direction: column; /* Stack items vertically on mobile */
        align-items: center; /* Center items vertically on mobile */
    }

       .image-container img {
        max-width: 80%; /* Adjust the width for mobile view */
        margin: 10px 0; /* Adjust margin for vertical stacking */
    }
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
                font-size: 1em;
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
}

.item {
    position: relative;
    overflow: hidden;
    cursor: pointer;
    width: 100%;
    height: 0;
    padding-bottom: 75%; /* Maintain aspect ratio */
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
}

.item .text-container2 .text {
    font-size: 24px; /* Increase font size */
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

.content {
            text-align: center;
            padding: 20px;
           
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            font-family: 'Lora', serif;
        }
        img {
            width: 100%;
            max-width: 800px;
            height: auto;
            border-radius: 8px;
        }
        .content1 {
    text-align: center;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    display: flex; /* Use flexbox */
    flex-wrap: wrap; /* Allow wrapping */
    justify-content: center; /* Center items horizontally */
}

.content1 img {
    border: 2px solid rgb(57, 190, 239);
    border-radius: 40px;
    max-width: 45%; /* Ensure images don't exceed container width */
    height: auto; /* Maintain aspect ratio */
    margin: 10px; /* Add space between images */
}


@media (max-width: 768px) {
    .content1 {
        flex-direction: column; /* Stack items vertically on mobile */
        align-items: center; /* Center items vertically on mobile */
    }

    .content1 img {
        max-width: 85%; /* Make images take up 80% of the container width on mobile */
        margin: 10px 0; /* Adjust margin for vertical stacking */
    }
}

        @media (max-width: 768px) {
            h1 {
                font-size: 20px;
            }
            img {
                max-width: 100%;
            }
        }
        @media (max-width: 480px) {
            h1 {
                font-size: 18px;
            }
            img {
                max-width: 100%;
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



        


      
        
       
    </style>
   
</head>
<body>
 


<script src="{{ asset('js/app.js') }}"></script>


    
    <div class="navbar">
    
    
       
    <a href="{{ route('home') }}">الصفحة الرئيسية</a>
 
    <div class="dropdown">
    <button class="dropbtn" onclick="toggleDropdown()">قسم التدريب والتأهيل</button>
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

<a href="{{ route('download') }}">التنزيلات</a>
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

<h1 align="center">Industrial Automation and Controlling Courses</h1>
<div class="content1">
    <img src="{{ asset('images/Roadmap2.jpg') }}" alt="Automation1 Course Image">
    <img src="{{ asset('images/Roadmap3.jpg') }}" alt="Automation2 Course Image">
</div>
@include('partials.icons')

        
<div class="image-container">
        <img src="{{ asset('images/automation2.jpg') }}" alt="Image 1">
        <img src="{{ asset('images/automation3.jpg') }}" alt="Image 2">
        <img src="{{ asset('images/automation18.jpg') }}" alt="Image 3">
    </div>
        
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

