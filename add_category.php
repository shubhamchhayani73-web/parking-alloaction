<?php
session_start();
if(!isset($_SESSION['admin'])){ header("location: admin_login.php"); }
include("db.php");

// Add Category
if(isset($_POST['add'])){
    $cname = $_POST['cname'];
    $sql = "INSERT INTO category (category_name) VALUES ('$cname')";
    if(mysqli_query($conn,$sql)){
        echo "<p style='color:green;'>✅ Category Added Successfully!</p>";
    } else {
        echo "<p style='color:red;'>❌ Error: " . mysqli_error($conn) . "</p>";
    }
}

// Delete Category
if(isset($_GET['del'])){
    $id = $_GET['del'];
    mysqli_query($conn,"DELETE FROM category WHERE id=$id");
    header("location: add_category.php");
}

// Update Category
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $cname = $_POST['cname'];
    mysqli_query($conn,"UPDATE category SET category_name='$cname' WHERE id=$id");
    header("location: add_category.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Categories</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>🚗 Smart Parking System</h1>
<div class="logo">
    <img src="https://tse1.mm.bing.net/th/id/OIP.W1lihXeMTRc1GjkkAKdtUwHaHa?pid=Api&P=0&h=180" alt="Parking Logo">
</div>

<h2>📂 Manage Categories</h2>

<!-- Add Category Form -->
<form method="post">
  <label>Category Name:</label>
  <input type="text" name="cname" required>
  <input type="submit" name="add" value="Add Category">
</form>

<hr>

<!-- Display Categories -->
<table>
<tr><th>ID</th><th>Category Name</th><th>Action</th></tr>
<?php
$res = mysqli_query($conn,"SELECT * FROM category");
while($row=mysqli_fetch_assoc($res)){
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['category_name']."</td>";
    echo "<td>
          <a href='add_category.php?edit=".$row['id']."'>✏️ Edit</a> | 
          <a href='add_category.php?del=".$row['id']."'>🗑 Delete</a>
          </td>";
    echo "</tr>";
}
?>
</table>

<?php
// Edit Form (only show if edit clicked)
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $res = mysqli_query($conn,"SELECT * FROM category WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    ?>
    <h3>✏️ Edit Category</h3>
    <form method="post">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
      <label>Category Name:</label>
      <input type="text" name="cname" value="<?php echo $row['category_name']; ?>" required>
      <input type="submit" name="update" value="Update">
    </form>
    <?php
}
?>
<br>
<form action="admin_dashboard.php" method="post">
    <button type="submit">Go back to dashboard</button>
  </form>
</body>
</html>
