<?php 
include("config.php");
$page = 'gallery';

// Search & filter
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$filter = isset($_GET['region']) ? trim($_GET['region']) : '';

$where = [];
if($search) $where[] = "name LIKE '%" . $conn->real_escape_string($search) . "%'";
if($filter) $where[] = "region = '" . $conn->real_escape_string($filter) . "'";
$whereSQL = $where ? "WHERE " . implode(" AND ", $where) : "";

$result = $conn->query("SELECT * FROM places $whereSQL ORDER BY id");
$count = $result ? $result->num_rows : 0;

// Get distinct regions for filter
$regResult = $conn->query("SELECT DISTINCT region FROM places ORDER BY region");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>معرض المناطق — اكتشف السعودية</title>
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

<div class="gallery-header">
  <h1>📍 معرض المناطق</h1>
  <p>ابحث أو رشّح النتائج ثم اضغط على أي منطقة للانتقال إلى صفحة التفاصيل</p>

  <form method="GET" class="gallery-toolbar">
    <input type="text" name="search" placeholder="ابحث عن منطقة..." value="<?php echo htmlspecialchars($search); ?>">
    <select name="region">
      <option value="">كل المناطق</option>
      <?php if($regResult) while($r = $regResult->fetch_assoc()): ?>
        <option value="<?php echo htmlspecialchars($r['region']); ?>" <?php if($filter==$r['region']) echo 'selected'; ?>>
          <?php echo htmlspecialchars($r['region']); ?>
        </option>
      <?php endwhile; ?>
    </select>
    <button type="submit" class="btn" style="white-space:nowrap">بحث</button>
    <?php if($search || $filter): ?>
      <a href="gallery.php" class="btn" style="background:#6b7280;white-space:nowrap">مسح</a>
    <?php endif; ?>
  </form>
</div>

<div class="result-count">عدد النتائج: <?php echo $count; ?></div>

<div class="cards">
<?php if($result && $result->num_rows > 0): ?>
  <?php while($row = $result->fetch_assoc()): ?>
    <div class="card">
      <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" loading="lazy">
      <div class="card-body">
        <span class="card-region-tag"><?php echo htmlspecialchars($row['region']); ?></span>
        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
        <p><?php echo htmlspecialchars($row['description']); ?></p>
        <a href="details.php?id=<?php echo $row['id']; ?>" class="card-link">عرض التفاصيل ←</a>
      </div>
    </div>
  <?php endwhile; ?>
<?php else: ?>
  <p style="text-align:center; color:var(--muted); grid-column:1/-1; padding:40px 0;">لا توجد نتائج مطابقة</p>
<?php endif; ?>
</div>

<footer>&copy; اكتشف السعودية - دعاء الغامدي - جود الحقباني - ريما السمراني</footer>
<script src="script.js"></script>
</body>
</html>