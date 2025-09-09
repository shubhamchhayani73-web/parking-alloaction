<?php include("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>🚗 Smart Parking System</h1>
<div class="logo">
    <img src="https://tse1.mm.bing.net/th/id/OIP.W1lihXeMTRc1GjkkAKdtUwHaHa?pid=Api&P=0&h=180" alt="Parking Logo">
</div>

<h2>Admin Login</h2>
<form method="post">
  <label>Username:</label>
  <input type="text" name="uname">

  <label>Password:</label>
  <input type="password" name="pass">

  <input type="submit" name="login" value="Login">
</form>

<?php
if(isset($_POST['login'])){
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM admin WHERE username='$uname' AND password='$pass'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)==1){
        session_start();
        $_SESSION['admin']=$uname;
        header("location: admin_dashboard.php");
    } else {
        echo "<p style='color:red;'>❌ Invalid Login</p>";
    }
}
?>

</body>
</html>
