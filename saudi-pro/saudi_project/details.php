<?php
include("config.php");
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id <= 0) { header("Location: gallery.php"); exit(); }

$result = $conn->query("SELECT * FROM places WHERE id=$id");
if(!$result || $result->num_rows == 0) { header("Location: gallery.php"); exit(); }
$row = $result->fetch_assoc();

$name = htmlspecialchars($row['name'] ?? '');
$region = htmlspecialchars($row['region'] ?? '');
$description = nl2br(htmlspecialchars($row['description'] ?? ''));
$mainImage = htmlspecialchars($row['image'] ?? '');
$location = htmlspecialchars($row['location'] ?? '');
$features = htmlspecialchars($row['features'] ?? '');
$bestTime = htmlspecialchars($row['best_time'] ?? '');
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $name; ?> — اكتشف السعودية</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <nav>
    <div class="nav-brand">اكتشف السعودية</div>
    <div class="nav-links">
      <a href="index.php">الرئيسية</a>
      <a href="gallery.php" class="active">معرض المناطق</a>
      <a href="admin/login.php">دخول المشرف</a>
      <button onclick="toggleDarkMode()" class="dark-btn" type="button">الوضع الليلي</button>
    </div>
  </nav>
</header>

<div class="details-wrap">
  <a href="gallery.php" class="back-link">← رجوع إلى المعرض</a>

  <div class="details-hero">
    <img src="images/<?php echo $mainImage; ?>" alt="<?php echo $name; ?>">
  </div>

  <h1 class="details-title"><?php echo $name; ?></h1>

  <div class="details-desc">
    <?php echo $description; ?>
  </div>

  <!-- Quick Facts -->
  <div class="details-section">
    <h3>معلومات سريعة</h3>
    <div class="quick-facts">
      <div class="fact-item">
        <strong>المنطقة الإدارية</strong>
        <?php echo $region; ?>
      </div>
      <div class="fact-item">
        <strong>التصنيف</strong>
        <?php echo !empty($row['category']) ? htmlspecialchars($row['category']) : 'سياحي'; ?>
      </div>
      <?php if(!empty($location)): ?>
      <div class="fact-item">
        <strong>الموقع</strong>
        <?php echo $location; ?>
      </div>
      <?php endif; ?>
      <?php if(!empty($features)): ?>
      <div class="fact-item">
        <strong>المميزات</strong>
        <?php echo $features; ?>
      </div>
      <?php endif; ?>
      <?php if(!empty($bestTime)): ?>
      <div class="fact-item">
        <strong>أفضل وقت للزيارة</strong>
        <?php echo $bestTime; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Landmarks -->
  <?php if(!empty($row['landmarks'])): ?>
  <div class="details-section">
    <h3>أبرز المعالم</h3>
    <ul>
      <?php foreach(explode("\n", $row['landmarks']) as $l): if(trim($l)): ?>
        <li><?php echo htmlspecialchars(trim($l)); ?></li>
      <?php endif; endforeach; ?>
    </ul>
  </div>
  <?php endif; ?>

  <!-- Activities -->
  <?php if(!empty($row['activities'])): ?>
  <div class="details-section">
    <h3>الأنشطة</h3>
    <ul>
      <?php foreach(explode("\n", $row['activities']) as $a): if(trim($a)): ?>
        <li><?php echo htmlspecialchars(trim($a)); ?></li>
      <?php endif; endforeach; ?>
    </ul>
  </div>
  <?php endif; ?>

  <!-- Mini Gallery -->
  <?php
  $gallery_imgs = [];
  if(!empty($row['image2'])) $gallery_imgs[] = htmlspecialchars($row['image2']);
  if(!empty($row['image3'])) $gallery_imgs[] = htmlspecialchars($row['image3']);
  if(!empty($row['image4'])) $gallery_imgs[] = htmlspecialchars($row['image4']);
  if(count($gallery_imgs) === 0 && !empty($mainImage)) $gallery_imgs[] = $mainImage;
  ?>
  <?php if(count($gallery_imgs) > 0): ?>
  <div class="details-section">
    <h3>معرض الصور</h3>
    <div class="mini-gallery">
      <?php foreach($gallery_imgs as $gi): ?>
        <img src="images/<?php echo htmlspecialchars($gi); ?>" alt="صورة">
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>

</div>

<footer>© اكتشف السعودية — جامعة الملك سعود</footer>
<script src="script.js"></script>
</body>
</html>