<?php
// filepath: /c:/xampp/htdocs/bloodmg/admin/view_reci_list.php
$insert = false;
require('../config.php');

$sql = "SELECT * FROM recipient;";
$result = mysqli_query($con, $sql);
$insert = true;

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Recipient List</title>
    <!-- favicon -->
    <link href="favicons/favicon.ico" rel="icon" type="image/x-icon" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome script -->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-a11y="true"></script>
    <style>
        .dashboard-card {
            transition: transform 0.3s;
        }
        .dashboard-card:hover {
            transform: scale(1.05);
        }
        .table-container {
            margin-top: 20px;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }
        .table-hover tbody tr:hover {
            color: #212529;
            background-color: rgba(0, 0, 0, 0.075);
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

        <div class="container mt-4">
            <h2 class="text-center">Recipient List</h2>
            <div class="table-container">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Recipient ID</th>
                            <th>Recipient Name</th>
                            <th>Recipient Age</th>
                            <th>Recipient Sex</th>
                            <th>Recipient Phone</th>
                            <th>Recipient Blood Group</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($insert == true) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['reci_id'] . "</td>";
                                echo "<td>" . $row['reci_name'] . "</td>";
                                echo "<td>" . $row['reci_age'] . "</td>";
                                echo "<td>" . $row['reci_sex'] . "</td>";
                                echo "<td>" . $row['reci_phno'] . "</td>";
                                echo "<td>" . $row['reci_bgrp'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>