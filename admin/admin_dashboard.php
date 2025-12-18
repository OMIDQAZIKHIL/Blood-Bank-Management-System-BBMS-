<?php
session_start();

// Authentication Check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Include database connection
require_once '../config.php';

// Fetch some quick stats
$donor_query = "SELECT COUNT(*) as total_donors FROM donor";
$recipient_query = "SELECT COUNT(*) as total_recipients FROM recipient";
$blood_request_query = "SELECT COUNT(*) as total_requests FROM blood_request";
$blood_stock_query = "SELECT SUM(B_qnty) as total_blood FROM blood_stock";

$donor_result = mysqli_query($con, $donor_query);
$recipient_result = mysqli_query($con, $recipient_query);
$request_result = mysqli_query($con, $blood_request_query);
$stock_result = mysqli_query($con, $blood_stock_query);

$donor_count = mysqli_fetch_assoc($donor_result)['total_donors'];
$recipient_count = mysqli_fetch_assoc($recipient_result)['total_recipients'];
$request_count = mysqli_fetch_assoc($request_result)['total_requests'];
$stock_count = mysqli_fetch_assoc($stock_result)['total_blood'];

// Fetch messages
$messages_query = "SELECT * FROM messages ORDER BY created_at DESC";
$messages_result = mysqli_query($con, $messages_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dashboard-card {
            transition: transform 0.3s;
        }
        .dashboard-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container">
                <a class="navbar-brand" href="#">Admin Dashboard</a>
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </div>
        </nav>

        <div class="container mt-4">
            <h2>Welcome, Admin <?php echo isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin'; ?></h2>
            
            <div class="row">
                <!-- Quick Stats Cards -->
                <div class="col-md-3 mb-4">
                    <div class="card dashboard-card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Donors</h5>
                            <p class="card-text display-4"><?php echo $donor_count; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card dashboard-card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Recipients</h5>
                            <p class="card-text display-4"><?php echo $recipient_count; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card dashboard-card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Blood Requests</h5>
                            <p class="card-text display-4"><?php echo $request_count; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card dashboard-card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Blood Stock</h5>
                            <p class="card-text display-4"><?php echo $stock_count; ?> ml</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Management Sections -->
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Donor Management</h5>
                            <a href="donor_details.php" class="btn btn-primary">Add Donor</a>
                            <a href="view_donor_eligibility.php" class="btn btn-success">Check Eligibility</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recipient Management</h5>
                            <a href="add_recipient_details.php" class="btn btn-primary">Add Recipient</a>
                            <a href="view_reci_list.php" class="btn btn-success">View Recipients</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Blood Request Management</h5>
                            <a href="request_blood.php" class="btn btn-primary">New Request</a>
                            <a href="view_blood_request.php" class="btn btn-success">View Requests</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages Section -->
            <div class="row">
                <div class="col-md-12 mb-4">
                    <h3>Messages</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($message = mysqli_fetch_assoc($messages_result)) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($message['name']); ?></td>
                                    <td><?php echo htmlspecialchars($message['email']); ?></td>
                                    <td><?php echo htmlspecialchars($message['message']); ?></td>
                                    <td><?php echo htmlspecialchars($message['created_at']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>