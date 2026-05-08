<?php
include("config.php");
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM places WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>التفاصيل</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
<header>
  <h1>اكتشف السعودية</h1>
  <<nav>
  <div class="nav-brand">اكتشف السعودية</div>

  <div class="nav-links">

    <a href="index.php" class="<?php if($page=='home') echo 'active'; ?>">الرئيسية</a>

    <a href="gallery.php" class="<?php if($page=='gallery') echo 'active'; ?>">معرض المناطق</a>

    <a href="admin/login.php">دخول المشرف</a>

    <button onclick="toggleMode()" class="dark-btn">
      الوضع الليلي
    </button>

  </div>
</nav>
</header>


<h1><?php echo $row['name']; ?></h1>
<img src="images/<?php echo $row['image']; ?>" width="300">

<p><?php echo $row['description']; ?></p>

<a href="gallery.php">رجوع</a>

</body>
</html>