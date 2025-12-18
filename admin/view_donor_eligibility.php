<?php
// filepath: /c:/xampp/htdocs/bloodmg/admin/view_donor_eligibility.php
require('config.php');
$insert = false;
if (isset($_POST["submit"])) {
    $d_id = $_POST['d_id'];
    $sql = "call view_donor_eligibility('$d_id');";
    $sql1 = "select eligibility from donor where d_id = '$d_id';";
    $result = mysqli_query($con, $sql);
    $result1 = mysqli_query($con, $sql1);
    $insert = true;
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Eligibility</title>
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

        .eligibility {
            margin-top: 50px;
        }

        .eligibility-title {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #dc3545;
        }

        .eligibility-input {
            margin-bottom: 20px;
            padding: 10px;
            font-size: 1rem;
        }

        .eligibility-button {
            background-color: #dc3545;
            border: none;
        }

        .eligibility-button:hover {
            background-color: #c82333;
        }

        .link a {
            color: #dc3545;
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
                        <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard.php#aboutus">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container eligibility">
        <form class="form" action="" method="POST">
            <h1 class="eligibility-title text-center">View Donor Eligibility</h1>
            <div class="mb-3">
                <label for="d_id" class="form-label">Donor ID</label>
                <input type="text" class="eligibility-input form-control" name="d_id" placeholder="Donor ID" required />
            </div>
            <input type="submit" name="submit" value="View" class="btn btn-dark btn-lg eligibility-button">
        </form>

        <?php
        if ($insert == true) {
            while ($row = mysqli_fetch_array($result1)) {
                echo "<div class='alert alert-info mt-4' role='alert'>";
                echo "<h4 class='alert-heading'>Eligibility: " . $row['eligibility'] . "</h4>";
                echo "</div>";
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>