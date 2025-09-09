<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location: admin_login.php");
}
include("db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h1>🚗 Smart Parking System</h1>
  <div class="logo">
    <img src="https://tse1.mm.bing.net/th/id/OIP.W1lihXeMTRc1GjkkAKdtUwHaHa?pid=Api&P=0&h=180" alt="Parking Logo">
</div>
  <h2>Welcome Admin - <?php echo $_SESSION['admin']; ?></h2>

  <ul class="dashboard-menu">
    <li><a href="add_category.php">Manage Categories</a></li>
    <li><a href="add_vehicle.php">Add Vehicle</a></li>
    <li><a href="manage_vehicle.php">Manage Vehicles</a></li>
    <li><a href="report.php">Reports</a></li>
    <li><a href="search_vehicle.php">Search Vehicle</a></li>
    <li><a href="vehicle_out.php">Vehicle Out</a></li>
  </ul>
  <form action="logout.php" method="post">
    <button type="submit">Logout</button>
  </form>
</div>
</body>
</html>
