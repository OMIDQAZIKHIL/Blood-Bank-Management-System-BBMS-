<?php
// filepath: /c:/xampp/htdocs/bloodmg/admin/register.php
require('config.php');
// When form submitted, insert values into the database.
if (isset($_REQUEST['M_name'])) {
    // removes backslashes
    $M_name = stripslashes($_REQUEST['M_name']);
    //escapes special characters in a string
    $M_name = mysqli_real_escape_string($con, $M_name);
    $M_phno    = stripslashes($_REQUEST['M_phno']);
    $M_phno    = mysqli_real_escape_string($con, $M_phno);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);

    $query    = "INSERT into `bbmanager` (M_name , M_phno, password)
                 VALUES ('$M_name',  '$M_phno', '" . $password . "')";
    $result   = mysqli_query($con, $query);
    if ($result) {
        echo "<div class='alert alert-success' role='alert'>
                  You are registered successfully. <a href='login.php' class='alert-link'>Login</a>.
              </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>
                  Required fields are missing. <a href='register.php' class='alert-link'>Try again</a>.
              </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Manager Registration</title>
    <!-- favicon -->
    <link href="/favicons/favicon.ico" rel="icon" type="image/x-icon" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome script -->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-a11y="true"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #dc3545;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-link {
            color: #fff !important;
        }

        .register {
            margin-top: 50px;
        }

        .register-title {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #dc3545;
        }

        .register-input {
            margin-bottom: 20px;
            padding: 10px;
            font-size: 1rem;
        }

        .register-button {
            background-color: #dc3545;
            border: none;
        }

        .register-button:hover {
            background-color: #c82333;
        }

        .link a {
            color: #dc3545;
        }

        .blood3 {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="#">Blood Bank Management</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav_elements" id="navbarTogglerDemo02">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard.php#aboutus">About</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container register">
        <div class="row">
            <div class="col-lg-6">
                <form class="form" action="" method="post">
                    <h1 class="register-title">Manager Registration</h1>
                    <div class="mb-3">
                        <label for="M_name" class="form-label">Manager Name</label>
                        <input type="text" class="register-input form-control" name="M_name" placeholder="Manager Name" required />
                    </div>
                    <div class="mb-3">
                        <label for="M_phno" class="form-label">Phone Number</label>
                        <input type="text" class="register-input form-control" name="M_phno" placeholder="Phone Number" required />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="register-input form-control" name="password" placeholder="Password" required />
                    </div>
                    <input type="submit" name="submit" value="Register" class="btn btn-dark btn-lg register-button">
                    <p class="link"><a href="login.php">Click to Login</a></p>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>