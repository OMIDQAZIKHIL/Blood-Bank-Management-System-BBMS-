<?php
// filepath: /c:/xampp/htdocs/bloodmg/admin/add_recipient_details.php
require('../config.php');
// When form submitted, insert values into the database.
if (isset($_REQUEST['reci_name'])) {
    // removes backslashes
    $reci_name = stripslashes($_REQUEST['reci_name']);
    //escapes special characters in a string
    $reci_name = mysqli_real_escape_string($con, $reci_name);
    $reci_age    = stripslashes($_REQUEST['reci_age']);
    $reci_age    = mysqli_real_escape_string($con, $reci_age);
    $reci_sex    = stripslashes($_REQUEST['reci_sex']);
    $reci_sex    = mysqli_real_escape_string($con, $reci_sex);
    $reci_phno   = stripslashes($_REQUEST['reci_phno']);
    $reci_phno   = mysqli_real_escape_string($con, $reci_phno);
    $reci_bgrp   = stripslashes($_REQUEST['reci_bgrp']);
    $reci_bgrp   = mysqli_real_escape_string($con, $reci_bgrp);

    $query    = "INSERT into `recipient` (reci_name , reci_age,  reci_sex, reci_phno, reci_bgrp, reci_reg_date)
                 VALUES ('$reci_name' , '$reci_age', '$reci_sex', '$reci_phno', '$reci_bgrp', current_timestamp());";
    $result   = mysqli_query($con, $query);
    if ($result) {
        echo "<div class='alert alert-success' role='alert'>
                  Recipient registered successfully. <a href='admin_dashboard.php' class='alert-link'>Go to home page</a>.
              </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>
                  Required fields are missing. <a href='add_recipient_details.php' class='alert-link'>Try again</a>.
              </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Recipient Details</title>
    <!-- favicon -->
    <link href="/favicons/favicon.ico" rel="icon" type="image/x-icon" />
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
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </div>
        </nav>

        <div class="container form-container">
            <h2 class="text-center form-title">Registration for Recipient</h2>
            <form class="form" action="" method="post">
                <div class="mb-3">
                    <label for="reci_name" class="form-label">Name</label>
                    <input type="text" class="form-control form-input" name="reci_name" placeholder="Name" required />
                </div>
                <div class="mb-3">
                    <label for="reci_age" class="form-label">Age</label>
                    <input type="number" class="form-control form-input" name="reci_age" placeholder="Age" required />
                </div>
                <div class="mb-3">
                    <label for="reci_sex" class="form-label">Sex</label>
                    <input type="text" class="form-control form-input" name="reci_sex" placeholder="Sex" required />
                </div>
                <div class="mb-3">
                    <label for="reci_phno" class="form-label">Phone Number</label>
                    <input type="text" class="form-control form-input" name="reci_phno" placeholder="Phone Number" required />
                </div>
                <div class="mb-3">
                    <label for="reci_bgrp" class="form-label">Blood Group</label>
                    <input type="text" class="form-control form-input" name="reci_bgrp" placeholder="Blood Group" required />
                </div>
                <button type="submit" name="submit" class="btn btn-dark btn-lg form-button">Register</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>