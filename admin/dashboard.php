<?php
// Include the database configuration file
include_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Blood Bank Management</title>
    <!-- favicon -->
    <link href="/favicons/favicon.ico" rel="icon" type="image/x-icon" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/dashboard.css">
    <!-- font awesome script -->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-a11y="true"></script>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="">Blood Bank Management</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav_elements" id="navbarTogglerDemo02">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_recipient_details.php">Add Recipient Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="donor_details.php">Donor Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_stock.php">View Blood Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_reci_list.php">View Recipient List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="request_blood.php">Request Blood</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="update_reci_list.php">Update Recipient List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="delete_blood_request.php">Delete Blood Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_donor_eligibility.php">View Donor Eligibility</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">Admin Dashboard</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- top part -->
    <div class="top">
        <h1 class="heading"><em><strong>XYZ Hospital</strong></em></h1>
    </div>

    <!-- Map Section -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div id="map"></div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Function to initialize the map
        function initMap(lat, lng) {
            var map = L.map('map').setView([lat, lng], 13);

            // Add a tile layer to the map (OpenStreetMap tiles)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Fetch nearby hospitals using Overpass API
            var overpassUrl = 'https://overpass-api.de/api/interpreter?data=[out:json];node[amenity=hospital](around:5000,' + lat + ',' + lng + ');out;';
            fetch(overpassUrl)
                .then(response => response.json())
                .then(data => {
                    data.elements.forEach(hospital => {
                        var hospitalMarker = L.marker([hospital.lat, hospital.lon]).addTo(map)
                            .bindPopup(hospital.tags.name || 'Unnamed Hospital');
                    });
                })
                .catch(error => console.error('Error fetching hospital data:', error));
        }

        // Get the user's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                initMap(lat, lng);
            }, function() {
                // Default location if geolocation fails (e.g., Kuala Lumpur, Malaysia)
                initMap(3.1390, 101.6869);
            });
        } else {
            // Default location if geolocation is not supported (e.g., Kuala Lumpur, Malaysia)
            initMap(3.1390, 101.6869);
        }
    </script>
</body>

</html>