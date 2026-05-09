<?php 
include("config.php");
$page = 'home';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>اكتشف السعودية</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <nav>
    <div class="nav-brand">اكتشف السعودية</div>
    <div class="nav-links">
      <a href="index.php" class="<?php if($page=='home') echo 'active'; ?>">الرئيسية</a>
      <a href="gallery.php">معرض المناطق</a>
      <a href="admin/login.php">دخول المشرف</a>
      <button onclick="toggleDarkMode()" class="dark-btn" type="button">الوضع الليلي</button>
    </div>
  </nav>
</header>

<div class="top-section">
  <div class="left-box">
    <h2>موقع ثقافي تفاعلي للتعريف بالمملكة</h2>
    <p>استكشف مناطق المملكة العربية السعودية وتعرف على أهم المعالم التاريخية والثقافية. اختر منطقة من المعرض للانتقال إلى صفحة التفاصيل.</p>
    <a href="gallery.php" class="btn">ابدأ الاستكشاف</a>
  </div>
  <div class="right-box">
    <h2>👋 أهلاً بك</h2>
    <p>ابدأ رحلتك لاكتشاف مناطق المملكة</p>
  </div>
</div>

<div class="features">
  <div class="feature">
    ⭐ الهدف
    <p>تقديم معلومات ثرية متنوعة عن مناطق المملكة وأبرز الوجهات السياحية.</p>
  </div>
  <div class="feature">
    📍 المناطق
    <p>معرض تفاعلي ينقل المستخدم بين المناطق (صور + عناوين + روابط).</p>
  </div>
  <div class="feature">
    📖 التفاصيل
    <p>صفحة تعرض وصفاً ومعلومات تاريخية ثرية عن المكان المختار.</p>
  </div>
</div>

<section class="stats-section">
  <div class="stats-grid">
    <div class="stat-item">
      <div class="stat-num">13</div>
      <div class="stat-label">منطقة إدارية</div>
    </div>
    <div class="stat-item">
      <div class="stat-num">7</div>
      <div class="stat-label">مواقع تراث عالمي</div>
    </div>
    <div class="stat-item">
      <div class="stat-num">2030</div>
      <div class="stat-label">رؤية المستقبل</div>
    </div>
    <div class="stat-item">
      <div class="stat-num">2M+</div>
      <div class="stat-label">زائر سنوياً</div>
    </div>
  </div>
</section>

<footer>&copy; اكتشف السعودية - دعاء الغامدي - جود الحقباني - ريما السمراني</footer>
<script src="script.js"></script>
</body>
</html>