<?php
session_start();
if(!isset($_SESSION['admin'])){ header("location: admin_login.php"); }
include("db.php");

if(isset($_POST['add'])){
    $owner = $_POST['owner'];
    $vnum = $_POST['vnum'];
    $categ = $_POST['categ'];
    $pnum = "PN".rand(1000,9999);

    $sql = "INSERT INTO vehicle(parking_number,owner_name,vehicle_number,category_id) 
            VALUES('$pnum','$owner','$vnum','$categ')";
    if(mysqli_query($conn,$sql)){
        echo "<p style='color:green;'>✅ Vehicle Added with Parking Number: $pnum</p>";
    } else {
        echo "<p style='color:red;'>❌ Error: ".mysqli_error($conn)."</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Vehicle</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>🚗 Smart Parking System</h1>
<div class="logo"><img src="https://tse1.mm.bing.net/th/id/OIP.W1lihXeMTRc1GjkkAKdtUwHaHa?pid=Api&P=0&h=180"></div>

<h2>🚘 Add Vehicle</h2>
<form method="post">
  <label>Owner Name:</label>
  <input type="text" name="owner" required>

  <label>Vehicle Number:</label>
  <input type="text" name="vnum" required>

  <label>Category:</label>
  <select name="categ" required>
    <option value="">Select</option>
    <?php
    $res = mysqli_query($conn,"SELECT * FROM category");
    while($row=mysqli_fetch_assoc($res)){
      echo "<option value='".$row['id']."'>".$row['category_name']."</option>";
    }
    ?>
  </select>

  <input type="submit" name="add" value="Add Vehicle">
</form>
<br>
<form action="admin_dashboard.php" method="post">
    <button type="submit">Go back to dashboard</button>
  </form>
</body>
</html>
