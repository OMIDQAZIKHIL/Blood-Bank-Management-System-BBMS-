<?php
// filepath: /c:/xampp/htdocs/bloodmg/donor_details.php
require('config.php');
// When form submitted, insert values into the database.
if (isset($_REQUEST['D_name'])) {
    // removes backslashes
    $D_name = stripslashes($_REQUEST['D_name']);
    //escapes special characters in a string
    $D_name = mysqli_real_escape_string($con, $D_name);
    $D_age    = stripslashes($_REQUEST['D_age']);
    $D_age    = mysqli_real_escape_string($con, $D_age);
    $D_sex    = stripslashes($_REQUEST['D_sex']);
    $D_sex    = mysqli_real_escape_string($con, $D_sex);
    $D_phno    = stripslashes($_REQUEST['D_phno']);
    $D_phno    = mysqli_real_escape_string($con, $D_phno);
    $D_bgrp    = stripslashes($_REQUEST['D_bgrp']);
    $D_bgrp    = mysqli_real_escape_string($con, $D_bgrp);
    $HLevel    = stripslashes($_REQUEST['HLevel']);
    $HLevel    = mysqli_real_escape_string($con, $HLevel);
    $BS    = stripslashes($_REQUEST['BS']);
    $BS    = mysqli_real_escape_string($con, $BS);
    $BP    = stripslashes($_REQUEST['BP']);
    $BP    = mysqli_real_escape_string($con, $BP);

    $query    = "INSERT into `donor` (D_name , D_age,  D_sex, D_phno, D_bgrp, HLevel, BS, BP, rdate)
                 VALUES ('$D_name' , '$D_age', '$D_sex', '$D_phno', '$D_bgrp', '$HLevel', '$BS', '$BP', current_timestamp());";
    $result   = mysqli_query($con, $query);
    if ($result) {
        echo "<div class='alert alert-success' role='alert'>
                  Donor registered successfully. <a href='dashboard.php' class='alert-link'>Go to home page</a>.
              </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>
                  Required fields are missing. <a href='donor_details.php' class='alert-link'>Try again</a>.
              </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Blood Bank Management</title>
    <!-- favicon -->
    <link href="favicons/favicon.ico" rel="icon" type="image/x-icon" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome script -->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-a11y="true"></script>
    <style>
        .form-container {
            margin-top: 20px;
        }
        .form-title {
            margin-bottom: 20px;
        }
        .form-input {
            margin-bottom: 15px;
        }
        .form-button {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container">
                <a class="navbar-brand" href="#">Blood Bank Management</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse nav_elements" id="navbarTogglerDemo02">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php#aboutus">About</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container form-container">
        <h2 class="text-center form-title">Registration for Donor</h2>
        <form class="form" action="" method="post">
            <div class="mb-3">
                <label for="D_name" class="form-label">Name</label>
                <input type="text" class="form-control form-input" name="D_name" placeholder="Name" required />
            </div>
            <div class="mb-3">
                <label for="D_age" class="form-label">Age</label>
                <input type="number" class="form-control form-input" name="D_age" placeholder="Age" required />
            </div>
            <div class="mb-3">
                <label for="D_sex" class="form-label">Sex</label>
                <input type="text" class="form-control form-input" name="D_sex" placeholder="Sex" required />
            </div>
            <div class="mb-3">
                <label for="D_phno" class="form-label">Phone Number</label>
                <input type="text" class="form-control form-input" name="D_phno" placeholder="Phone Number" required />
            </div>
            <div class="mb-3">
                <label for="D_bgrp" class="form-label">Blood Group</label>
                <input type="text" class="form-control form-input" name="D_bgrp" placeholder="Blood Group" required />
            </div>
            <div class="mb-3">
                <label for="HLevel" class="form-label">Haemoglobin Level</label>
                <input type="text" class="form-control form-input" name="HLevel" placeholder="Haemoglobin Level" required />
            </div>
            <div class="mb-3">
                <label for="BS" class="form-label">Blood Sugar</label>
                <input type="text" class="form-control form-input" name="BS" placeholder="Blood Sugar" required />
            </div>
            <div class="mb-3">
                <label for="BP" class="form-label">Blood Pressure</label>
                <input type="text" class="form-control form-input" name="BP" placeholder="Blood Pressure" required />
            </div>
            <button type="submit" name="submit" class="btn btn-dark btn-lg form-button">Register</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>