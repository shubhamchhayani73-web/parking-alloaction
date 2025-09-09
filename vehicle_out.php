<?php
include("db.php");
$id = $_GET['id'];
$out = date("Y-m-d H:i:s");
$charges = 50; // fixed charges
$sql="UPDATE vehicle SET out_time='$out', charges=$charges, remarks='Paid' WHERE id=$id";
mysqli_query($conn,$sql);
header("location: manage_vehicle.php");
?>
