<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>المعرض</title>
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

<h1>📍 معرض المناطق</h1>

<div class="cards">
<?php
$result = $conn->query("SELECT * FROM places");

while($row = $result->fetch_assoc()){
    echo "<div class='card'>";
    echo "<img src='images/".$row['image']."'>";
    echo "<h3>".$row['name']."</h3>";
    echo "<p>".$row['region']."</p>";
    echo "<a href='details.php?id=".$row['id']."'>عرض التفاصيل</a>";
    echo "</div>";
}
?>
</div>

</body>
</html>