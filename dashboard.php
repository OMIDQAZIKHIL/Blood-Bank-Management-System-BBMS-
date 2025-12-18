<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Blood Bank Management</title>
    <!-- favicon -->
    <link href="favicons/favicon.ico" rel="icon" type="image/x-icon" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboard.css">
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
                        <a class="nav-link" href="admin/login.php">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="add_recipient_details.php">Add Recipient Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="donor_details.php">Add Donor Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="request_blood.php">Request Blood</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#aboutus">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>

                </ul>
            </div>
        </nav>
    </div>

    <!-- top part -->
    <div class="top">
        <h1 class="heading"><em><strong>XYZ Hospital</strong></em></h1>
        <img class="blood0" src="images/blood0.jpg" alt="background image">
    </div>

    <!-- Map Section -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div id="map"></div>
        </div>
    </div>

    <!-- middle -->
    <div class="middle">

        <h2>
            <center>Things You Should Know Before Donating Blood</center>
        </h2>
        <br>
        <ol>
            <li>You need to be 17 or older to donate whole blood.</li>
            <li>You must weigh at least 50 Kg and be in good health to donate.</li>
            <li>You need to provide information about medical conditions and any medications you’re taking, as these may affect your eligibility to donate blood.</li>
            <li>You must wait at least 8 weeks between whole blood donations and 16 weeks between double red cell donations.</li>
            <li>Platelet donations can be made every 7 days, up to 24 times per year.</li>
            <li>Drink plenty of fluids and eat a healthy meal before donating.</li>
            <li>Rest and avoid strenuous activities after your donation.</li>
        </ol>
    </div>
    <hr size="3" noshade>
    <div class="middle">
        <h2>
            <center>Donation Procedure</center>
        </h2>
        <br>
        <p>You must register to donate blood. This includes providing identification, your medical history, and undergoing a quick physical examination. You’ll also be given some information about blood donation to read.
            <br>
            Once you’re ready, your blood donation procedure will begin. Whole blood donation is the most common type of donation. This is because it offers the most flexibility. It can be transfused as whole blood or separated into red cells, platelets,
            and plasma for different recipients.
        </p>
        <ol>
            <li>You’ll be seated in a reclining chair. You can donate blood either sitting or lying down.</li>
            <li>A small area of your arm will be cleaned. A sterile needle will then be inserted.</li>
            <li>You’ll remain seated or lying down while a pint of your blood is drawn. This takes 8 to 10 minutes.</li>
            <li>When a pint of blood has been collected, a staff member will remove the needle and bandage your arm.</li>
        </ol>
    </div>
    <hr size="3" noshade>
    <!-- bottom -->
    <div class="bottom" id="aboutus">
        <h2>About Us</h2>
        <p>
        <h4>This is a DBMS Mini Project</h4>
        <br>
        <h5>Made by AIU Students:</h5>
        <br>
        <strong>PE 04:</strong> Hashem Mwanis
        <br>
        <strong>PE 09:</strong> Aryan 
        <br>
        <strong>PE 13:</strong> Atharva Jadhav
        <br>
        <strong>PE 17:</strong> Atharva Gurav
        <br>
        <strong>PE 36:</strong> Aamir Hullur
        </p>
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