<?php
session_start();
include("../config.php");

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $region = $_POST['region'];
    $description = $_POST['description'];

    // معلومات الصورة
    $image_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    // نقل الصورة إلى مجلد images
    move_uploaded_file($tmp_name, "../images/" . $image_name);

    // إدخال البيانات في قاعدة البيانات
    $conn->query("INSERT INTO places (name, region, description, image) 
                  VALUES ('$name', '$region', '$description', '$image_name')");

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>إضافة منطقة</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<h2>➕ إضافة منطقة جديدة</h2>

<form method="POST" enctype="multipart/form-data">

  <input type="text" name="name" placeholder="اسم المنطقة" required><br><br>

  <input type="text" name="region" placeholder="الإقليم" required><br><br>

  <textarea name="description" placeholder="الوصف" required></textarea><br><br>

  <!-- رفع الصورة -->
  <input type="file" name="image" required><br><br>

  <button name="add">إضافة</button>

</form>

<br>
<a href="dashboard.php">⬅️ رجوع</a>

</body>
</html>