<?php
// filepath: /c:/xampp/htdocs/bloodmg/admin/login.php
require('config.php');
session_start();
// When form submitted, check and create user session.
if (isset($_POST['M_name'])) {
    $M_name = stripslashes($_REQUEST['M_name']);    // removes backslashes
    $M_name = mysqli_real_escape_string($con, $M_name);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    // Check user is exist in the database
    $query    = "SELECT * FROM `bbmanager` WHERE M_name='$M_name' AND password='" . $password . "'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);
    if ($rows >= 1) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['M_name'] = $M_name;
        $_SESSION['admin_name'] = $M_name; // Set the admin_name session variable
        // Redirect to admin dashboard page
        header("Location: admin_dashboard.php");
    } else {
        echo "<div class='alert alert-danger' role='alert'>
                  Incorrect M_name/password. <a href='login.php' class='alert-link'>Login again</a>.
              </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Manager Login</title>
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

        .login {
            margin-top: 50px;
        }

        .login-title {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #dc3545;
        }

        .login-input {
            margin-bottom: 20px;
            padding: 10px;
            font-size: 1rem;
        }

        .login-button {
            background-color: #dc3545;
            border: none;
        }

        .login-button:hover {
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

    <div class="container login">
        <div class="row">
            <div class="col-lg-6">
                <form class="form" method="post" name="login">
                    <h1 class="login-title">Manager Login</h1>
                    <div class="mb-3">
                        <label for="M_name" class="form-label">Manager Name</label>
                        <input type="text" class="login-input form-control" name="M_name" placeholder="Manager Name" autofocus="true" required />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="login-input form-control" name="password" placeholder="Password" required />
                    </div>
                    <input type="submit" value="Login" name="submit" class="btn btn-dark btn-lg login-button" />
                    <p class="link"><a href="register.php">New Registration</a></p>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>