<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>اكتشف السعودية</title>
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
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

<section class="top-section">

  <div class="left-box">
    <h2>موقع ثقافي تفاعلي للتعريف بالمملكة</h2>
    <p>استكشف مناطق المملكة وتعرف على أبرز المعالم.</p>
    <a href="gallery.php" class="btn">ابدأ الاستكشاف</a>
  </div>

  <div class="right-box">
    <h2>👋 أهلاً بك</h2>
    <p>ابدأ رحلتك لاكتشاف ثقافة المملكة</p>
  </div>

</section>

<section class="features">
  <div class="feature">⭐ الهدف</div>
  <div class="feature">📍 المناطق</div>
  <div class="feature">📖 التفاصيل</div>
</section>

</body>
</html>