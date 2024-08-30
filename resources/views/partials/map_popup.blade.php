<!-- resources/views/partials/map_popup.blade.php -->
<div class="map-popup__container">
    <div class="map-popup__icon"></div>
    <div class="map-popup__popup">
        <div class="map-popup__square-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d415.7978138567353!2d36.2960961!3d33.5174392!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1518e72fc7244e4d%3A0xa85ae7d14e521e4f!2sAl%20Majed%20Hotel!5e0!3m2!1sen!2sbg!4v1718622109716!5m2!1sen!2sbg" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="branch-name">Damascus</div>
        </div>
        <div class="map-popup__square-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1639.9166166513874!2d36.71843893518832!3d34.70938598274829!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15230f18d6dfc90f%3A0xa4f4dd43cb7aba39!2sWorkers%20Sports%20Club!5e0!3m2!1snl!2s!4v1718622703078!5m2!1snl!2s" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="branch-name">Homs</div>
        </div>
        <div class="map-popup__square-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3304.003280437149!2d36.764522974816764!3d34.09505641546999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15228e3a37d1c541%3A0x29865ec34f22912e!2z2KzYp9mF2Lkg2KfZhNin2YrZhdin2YY!5e0!3m2!1snl!2s!4v1718622878835!5m2!1snl!2s" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="branch-name">Deir Atiah</div>
        </div>
    </div>
</div>

<style>
.map-popup__container {
    position: fixed;
    bottom: 10px;
    left: 10px;
    z-index: 1000;
}

.map-popup__icon {
    width: 130px;
    height: 130px;
    background-image: url('{{ asset('images/map2.png') }}');
    background-size: cover;
    cursor: pointer;
}

.map-popup__popup {
    display: none; /* Ensure popup is hidden initially */
    position: absolute;
    bottom: 160px; /* Adjust to position the popup above the icon */
    left: 0;
    background-color: white;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: row;
}

.map-popup__square-map {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px;
}

.branch-name {
    margin-top: 10px;
    text-align: center;
    font-size: 1.2em; /* Increase font size */
    font-weight: bold; /* Make text bold */
    color: #0a1f34; /* Set text color */
}

.responsive-iframe {
    width: 100%;
    height: 200px;
    max-width: 400px;
    max-height: 300px;
    border: 0;
}

@media (max-width: 768px) {
    .map-popup__popup {
        flex-direction: column;
        max-height: 80vh; /* Limit the height to 80% of the viewport height */
        overflow-y: auto; /* Enable scrolling */
    }

    .responsive-iframe {
        width: 100%;
        height: 200px;
    }
}

</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Initially hide the square maps and the popup
    $('.map-popup__square-map').hide();
    $('.map-popup__popup').hide();

    $('.map-popup__icon').on('click', function() {
        if ($('.map-popup__popup').is(':visible')) {
            $('.map-popup__popup').hide();
        } else {
            $('.map-popup__popup').show(function() {
                // Show the square maps when the popup is displayed
                $('.map-popup__square-map').show();
                // Scroll to the top of the popup initially
                $('.map-popup__popup').scrollTop(0);
            });
        }
    });
});
</script>
