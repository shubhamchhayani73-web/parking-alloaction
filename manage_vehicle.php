<?php
session_start();
if(!isset($_SESSION['admin'])){ header("location: admin_login.php"); }
include("db.php");

// Mark Out & Add Charges
if(isset($_POST['out'])){
    $id = $_POST['id'];
    $charges = $_POST['charges'];
    $remarks = $_POST['remarks'];
    mysqli_query($conn,"UPDATE vehicle SET out_time=NOW(), charges='$charges', remarks='$remarks' WHERE id=$id");
    echo "<p style='color:green;'>✅ Vehicle Updated</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Manage Vehicles</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>🚗 Smart Parking System</h1>
<div class="logo">
    <img src="https://tse1.mm.bing.net/th/id/OIP.W1lihXeMTRc1GjkkAKdtUwHaHa?pid=Api&P=0&h=180" alt="Parking Logo">
</div>

<h2>🅿️ Manage Vehicles</h2>

<table>
<tr><th>ID</th><th>Parking No</th><th>Owner</th><th>Vehicle No</th><th>In Time</th><th>Out Time</th><th>Charges</th><th>Action</th></tr>
<?php
$res=mysqli_query($conn,"SELECT v.*,c.category_name FROM vehicle v LEFT JOIN category c ON v.category_id=c.id");
while($row=mysqli_fetch_assoc($res)){
 echo "<tr>
       <td>".$row['id']."</td>
       <td>".$row['parking_number']."</td>
       <td>".$row['owner_name']."</td>
       <td>".$row['vehicle_number']."</td>
       <td>".$row['in_time']."</td>
       <td>".$row['out_time']."</td>
       <td>".$row['charges']."</td>
       <td>";
 if($row['out_time']==""){
     echo "<form method='post'>
           <input type='hidden' name='id' value='".$row['id']."'>
           <input type='text' name='charges' placeholder='Charges'>
           <input type='text' name='remarks' placeholder='Remarks'>
           <input type='submit' name='out' value='Mark Out'>
           </form>";
 } else {
     echo "✅ Completed";
 }
 echo "</td></tr>";
}
?>
<br>
<form action="admin_dashboard.php" method="post">
    <button type="submit">Go back to dashboard</button>
  </form>
</table>
</body>
</html>
