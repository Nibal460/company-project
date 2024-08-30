<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <title>Image Display</title>
</head>
<body>
    <h1>Image Display</h1>

    @if($choice === 'choice1')
        <img src="{{ asset('images/roadmap1.jpg') }}" alt="Image 1">
    @elseif($choice === 'choice2')
        <img src="{{ asset('images/roadmap2.jpg') }}" alt="Image 2">
    @elseif($choice === 'choice3')
        <img src="{{ asset('images/roadmap3.jpg') }}" alt="Image 3">
    @elseif($choice === 'choice4')
        <img src="{{ asset('images/roadmap4.jpg') }}" alt="Image 4">
    @else
        <p>No image found for the selected choice.</p>
    @endif
</body>
</html>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var imagePath = ''; // This will be set dynamically based on the user's choice
            var imgElement = $('<img>').attr('src', imagePath);
            $('#image-container').html(imgElement);
        });
    </script>
</body>
</html>
