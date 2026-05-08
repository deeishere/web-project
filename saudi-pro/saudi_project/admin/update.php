<?php
session_start();
include("../config.php");

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

// تحديث البيانات
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $region = $_POST['region'];
    $description = $_POST['description'];

    $conn->query("UPDATE places 
                  SET name='$name', region='$region', description='$description'
                  WHERE id=$id");

    header("Location: dashboard.php");
}

// جلب البيانات الحالية
$result = $conn->query("SELECT * FROM places WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>تعديل</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<h2>✏️ تعديل المنطقة</h2>

<form method="POST">
  <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>

  <input type="text" name="region" value="<?php echo $row['region']; ?>" required><br><br>

  <textarea name="description" required><?php echo $row['description']; ?></textarea><br><br>

  <button name="update">تحديث</button>
</form>

<br>
<a href="dashboard.php">⬅️ رجوع</a>

</body>
</html>