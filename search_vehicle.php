<?php
session_start();
if(!isset($_SESSION['admin'])){ header("location: admin_login.php"); }
include("db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Search Vehicle</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>🚗 Smart Parking System</h1>
<div class="logo">
    <img src="https://tse1.mm.bing.net/th/id/OIP.W1lihXeMTRc1GjkkAKdtUwHaHa?pid=Api&P=0&h=180" alt="Parking Logo">
</div>

<h2>🔍 Search Vehicle</h2>
<form method="post">
  <label>Parking Number:</label>
  <input type="text" name="pnum" required>
  <input type="submit" name="search" value="Search">
</form>

<?php
if(isset($_POST['search'])){
  $pnum=$_POST['pnum'];
  $res=mysqli_query($conn,"SELECT * FROM vehicle WHERE parking_number='$pnum'");
  if(mysqli_num_rows($res)>0){
    echo "<table><tr><th>ID</th><th>Parking No</th><th>Owner</th><th>Vehicle No</th><th>In</th><th>Out</th><th>Charges</th></tr>";
    while($row=mysqli_fetch_assoc($res)){
      echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['parking_number']."</td>
            <td>".$row['owner_name']."</td>
            <td>".$row['vehicle_number']."</td>
            <td>".$row['in_time']."</td>
            <td>".$row['out_time']."</td>
            <td>".$row['charges']."</td>
            </tr>";
    }
    echo "</table>";
  } else {
    echo "<p style='color:red;'>❌ No Vehicle Found</p>";
  }
}
?>
<br>
<form action="admin_dashboard.php" method="post">
    <button type="submit">Go back to dashboard</button>
  </form>
</body>
</html>
