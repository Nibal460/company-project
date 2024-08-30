<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
    body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    position: relative;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    width: 26.7cm; /* A4 landscape width */
}

.container {
    position: relative;
    padding: 0.5cm;
    margin: 0.5cm;
    box-sizing: border-box;
    background-size: 100% auto; /* Ensure the background image scales proportionally */
    background-position: center;
    background-repeat: no-repeat;
    background-image: url('{{ asset('images/te2.png') }}'); /* Background image */
    height: 90vh; /* Full viewport height */
}

.border-top, .border-left, .border-right, .border-bottom {
    background-color: #0a1f34;
}

.border-top {
    position: absolute;
    top: 0;
    left: 0;
    width: 72%;
    height: 8px;
    margin-left:0.3cm;
    margin-top:0.3cm;
}

.border-top::before {
    content: '';
    position: absolute;
    top: 0;
    right: -5px;
    width: 10px;
    height: 8px;
    background-color: #0a1f34;
    transform: skewX(-50deg);
    
}

.border-left {
    position: absolute;
    top: 0;
    left: 0;
    width: 8px;
    height: 62%;
    margin-left:0.3cm;
    margin-top:0.3cm;
}

.border-left::before {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 8px;
    height: 10px;
    background-color: #0a1f34;
    transform: skewY(-50deg);
}

.border-right {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 8px;
    height: 62%;
    background-color: #36beee;
    margin-right:0.3cm;
    margin-bottom:0.3cm;
}

.border-right::before {
    content: '';
    position: absolute;
    top: -5px;
    right: 0;
    width: 8px;
    height: 10px;
    background-color: #36beee;
    transform: skewY(-50deg);
}

.border-bottom {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 72%;
    height: 8px;
    background-color: #36beee;
    margin-right:0.3cm;
    margin-bottom:0.3cm;
}

.border-bottom::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: -5px;
    width: 10px;
    height: 8px;
    background-color: #36beee;
    transform: skewX(-50deg);
}

h1 {
    text-align: center;
    font-size: 35px;
}

p {
    text-align: center;
    font-size: 18px;
}

p img {
    width: 24%;  /* Increase the width */
    height: 70px;
    
}

.duration, .awarding {
    text-align: center;
    font-size: 18px;
}

.awarding {
    margin-bottom: 6cm;
}

.square {
    position: absolute;
    bottom: 0.8cm;
    right: 0.8cm;
    width: 4.2cm;
    height: 3.5cm;
    border: 2px solid #36beee;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
    align-items: center;
}

.square img {
    width: 80%;  /* Increase the width */
    height: auto;
}

.rectangle {
    position: absolute;
    bottom: 0.8cm;
    left: 0.8cm;
    width: 5.7cm;
    height: 3.7cm;
    border: 2px solid #36beee;
    box-sizing: border-box;
}

@media print {
    .container {
        width: 29.7cm; /* A4 landscape width */
        height: 21cm; /* A4 landscape height */
        background-size: 100% auto; /* Ensure the background image scales proportionally */
    }

    .border-top {
        width: 77%;
        height: 5px;
    }

    .border-top::before {
        width: 10px;
        height: 5px;
    }

    .border-left {
        width: 5px;
        height: 66%;
    }

    .border-left::before {
        width: 5px;
        height: 10px;
    }

    .border-right {
        width: 5px;
        height: 66%;
    }

    .border-right::before {
        width: 5px;
        height: 10px;
    }

    .border-bottom {
        width: 77%;
        height: 5px;
    }

    .border-bottom::before {
        width: 10px;
        height: 5px;
    }
    h1 {
    text-align: center;
    font-size: 35px;
}

p {
    text-align: center;
    font-size: 18px;
}

    p img {
        width: 30%;  /* Increase the width */
        height: auto;
        
    }
}

    </style>
</head>
<body>
    <div class="container" id="certificate">
        <div class="border-top"></div>
        <div class="border-left"></div>
        <div class="border-right"></div>
        <div class="border-bottom"></div>
        <div class="square">
            @if($user && $user->qr_code_path)
                <img src="{{ asset('storage/' . $user->qr_code_path) }}" alt="QR Code">
            @else
                <p>No QR code available</p>
            @endif
        </div>

        <div class="rectangle"></div>
        <p><img src="{{ asset('images/TechTurn-certificate.png') }}" id="certificate-img"></p>
        <h1>CERTIFICATE</h1>
        <p>This is to certify that</p>
        <p><strong>{{ $user->fname }} {{ $user->father_name }} {{ $user->lname }}</strong></p>
        <p>Has successfully completed the course</p>
        <p><strong>{{ $course2->name }}</strong></p>
        <div class="duration"><strong>{{ $course2->hours }} hours of practical training from {{ $startDate }} to {{ $endDate }}</strong></div>
        <div class="awarding">Therefore awarded this certificate on <strong>{{ $awarding }}</strong></div>
    </div>
    <center><button id="download-certificate">Download Certificate</button></center>
   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('download-certificate');
            button.addEventListener('click', function() {
                const certificate = document.getElementById('certificate');
                const img = document.getElementById('certificate-img');

                html2canvas(certificate, {
                    scale: 2,
                    useCORS: true
                }).then(canvas => {
                    const imgData = canvas.toDataURL('image/png');
                    const pdf = new jsPDF('landscape', 'mm', 'a4');
                    pdf.setFillColor(255, 255, 255); // Set background color to white
                    pdf.rect(0, 0, 297, 210, 'F'); // Fill the page with the background color
                    pdf.addImage(imgData, 'PNG', 0, 0, 297, 210);
                    pdf.save('certificate.pdf');
                }).catch(function(error) {
                    console.error("Error generating PDF: ", error);
                });
            });
        });
    </script>
</body>
</html>
