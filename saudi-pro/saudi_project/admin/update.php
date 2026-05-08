<?php
session_start();
include("../config.php");

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id <= 0){
    header("Location: dashboard.php");
    exit();
}

$existingCols = [];
$colsResult = $conn->query("SHOW COLUMNS FROM places");
if($colsResult){
    while($c = $colsResult->fetch_assoc()){
        $existingCols[] = $c['Field'];
    }
}

if(isset($_POST['update'])){
    $name        = $conn->real_escape_string($_POST['name']);
    $region      = $conn->real_escape_string($_POST['region']);
    $description = $conn->real_escape_string($_POST['description']);
    $location    = $conn->real_escape_string($_POST['location'] ?? '');
    $features    = $conn->real_escape_string($_POST['features'] ?? '');
    $activities  = $conn->real_escape_string($_POST['activities'] ?? '');
    $landmarks   = $conn->real_escape_string($_POST['landmarks'] ?? '');
    $best_time   = $conn->real_escape_string($_POST['best_time'] ?? '');

    $allData = [
        'name' => $name,
        'region' => $region,
        'description' => $description,
        'location' => $location,
        'features' => $features,
        'activities' => $activities,
        'landmarks' => $landmarks,
        'best_time' => $best_time
    ];

    // Main image update if uploaded
    if(!empty($_FILES['image']['name'])){
        $imageName = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/" . $imageName);
        $allData['image'] = $conn->real_escape_string($imageName);
    }

    // Gallery images update if uploaded
    foreach(['image2', 'image3', 'image4'] as $imgKey){
        if(!empty($_FILES[$imgKey]['name'])){
            $imgName = basename($_FILES[$imgKey]['name']);
            move_uploaded_file($_FILES[$imgKey]['tmp_name'], "../images/" . $imgName);
            $allData[$imgKey] = $conn->real_escape_string($imgName);
        }
    }

    $setParts = [];
    foreach($allData as $col => $val){
        if(in_array($col, $existingCols, true)){
            $setParts[] = $col . "='" . $val . "'";
        }
    }

    if(!empty($setParts)){
        $conn->query("UPDATE places SET " . implode(", ", $setParts) . " WHERE id=" . $id);
    }

    header("Location: dashboard.php?msg=updated");
    exit();
}

$result = $conn->query("SELECT * FROM places WHERE id=$id");
if(!$result || $result->num_rows == 0){
    header("Location: dashboard.php");
    exit();
}
$row = $result->fetch_assoc();

$mainPreview = !empty($row['image']) ? htmlspecialchars($row['image']) : '';
$galleryPreview = [];
foreach(['image2', 'image3', 'image4'] as $imgCol){
    if(isset($row[$imgCol]) && !empty($row[$imgCol])){
        $galleryPreview[] = htmlspecialchars($row[$imgCol]);
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>تعديل منطقة</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>

<div style="background:var(--green); padding:14px 24px; display:flex; justify-content:space-between; align-items:center; box-shadow:var(--shadow);">
  <span style="color:#fff; font-weight:700; font-size:1rem;">لوحة المشرف</span>
  <div style="display:flex; gap:8px; align-items:center;">
    <a href="dashboard.php" style="color:#fff; text-decoration:none; font-size:0.88rem; padding:7px 15px; border-radius:20px; background:rgba(255,255,255,0.12);">لوحة التحكم</a>
    <button onclick="toggleDarkMode()" style="color:#fff; font-family:inherit; font-size:0.88rem; padding:7px 15px; border-radius:20px; background:rgba(255,255,255,0.12); border:none; cursor:pointer;">الوضع الليلي</button>
    <a href="logout.php" style="color:#fff; text-decoration:none; font-size:0.88rem; padding:7px 15px; border-radius:20px; background:#cf2637;">تسجيل الخروج</a>
  </div>
</div>

<div class="form-page-wrap update-layout">
  <div class="form-card">
    <h2>✏️ تعديل المنطقة</h2>

    <form method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label>* اسم المكان</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name'] ?? ''); ?>" required>
      </div>

      <?php if(in_array('image', $existingCols, true)): ?>
      <div class="form-group">
        <label>الصورة الرئيسية للمكان (اختياري للتحديث)</label>
        <input type="file" name="image" accept="image/*">
      </div>
      <?php endif; ?>

      <div class="form-group">
        <label>* الوصف</label>
        <textarea name="description" required><?php echo htmlspecialchars($row['description'] ?? ''); ?></textarea>
      </div>

      <div class="form-group">
        <label>* المنطقة</label>
        <select name="region" required>
          <?php $currentRegion = $row['region'] ?? ''; ?>
          <option value="">اختر المنطقة</option>
          <option value="وسطى" <?php if($currentRegion === 'وسطى') echo 'selected'; ?>>وسطى</option>
          <option value="غربية" <?php if($currentRegion === 'غربية') echo 'selected'; ?>>غربية</option>
          <option value="شرقية" <?php if($currentRegion === 'شرقية') echo 'selected'; ?>>شرقية</option>
          <option value="جنوبية" <?php if($currentRegion === 'جنوبية') echo 'selected'; ?>>جنوبية</option>
          <option value="شمالية" <?php if($currentRegion === 'شمالية') echo 'selected'; ?>>شمالية</option>
        </select>
      </div>

      <?php if(in_array('location', $existingCols, true)): ?>
      <div class="form-group">
        <label>الموقع</label>
        <input type="text" name="location" value="<?php echo htmlspecialchars($row['location'] ?? ''); ?>">
      </div>
      <?php endif; ?>

      <?php if(in_array('features', $existingCols, true)): ?>
      <div class="form-group">
        <label>المميزات</label>
        <input type="text" name="features" value="<?php echo htmlspecialchars($row['features'] ?? ''); ?>">
      </div>
      <?php endif; ?>

      <?php if(in_array('activities', $existingCols, true)): ?>
      <div class="form-group">
        <label>الأنشطة</label>
        <textarea name="activities" style="min-height:70px;"><?php echo htmlspecialchars($row['activities'] ?? ''); ?></textarea>
      </div>
      <?php endif; ?>

      <?php if(in_array('landmarks', $existingCols, true)): ?>
      <div class="form-group">
        <label>أبرز المعالم</label>
        <textarea name="landmarks" style="min-height:70px;"><?php echo htmlspecialchars($row['landmarks'] ?? ''); ?></textarea>
      </div>
      <?php endif; ?>

      <?php if(in_array('best_time', $existingCols, true)): ?>
      <div class="form-group">
        <label>أفضل وقت للزيارة</label>
        <input type="text" name="best_time" value="<?php echo htmlspecialchars($row['best_time'] ?? ''); ?>">
      </div>
      <?php endif; ?>

      <?php if(in_array('image2', $existingCols, true) || in_array('image3', $existingCols, true) || in_array('image4', $existingCols, true)): ?>
      <div class="form-section-title">صور المعرض (اختياري للتحديث)</div>
      <?php endif; ?>

      <?php if(in_array('image2', $existingCols, true)): ?>
      <div class="form-group">
        <label>صورة المعرض الأولى</label>
        <input type="file" name="image2" accept="image/*">
      </div>
      <?php endif; ?>

      <?php if(in_array('image3', $existingCols, true)): ?>
      <div class="form-group">
        <label>صورة المعرض الثانية</label>
        <input type="file" name="image3" accept="image/*">
      </div>
      <?php endif; ?>

      <?php if(in_array('image4', $existingCols, true)): ?>
      <div class="form-group">
        <label>صورة المعرض الثالثة</label>
        <input type="file" name="image4" accept="image/*">
      </div>
      <?php endif; ?>

      <button type="submit" name="update" class="form-submit">حفظ التعديلات</button>
    </form>

    <br>
    <a href="dashboard.php" class="back-link">← رجوع إلى لوحة التحكم</a>
  </div>

  <aside class="form-card update-preview-card">
    <h3>معاينة المحتوى الحالي</h3>
    <div class="preview-group">
      <strong>الصورة الرئيسية للمكان</strong>
      <?php if(!empty($mainPreview)): ?>
        <img class="preview-main-image" src="../images/<?php echo $mainPreview; ?>" alt="الصورة الرئيسية">
      <?php else: ?>
        <p class="preview-empty">لا توجد صورة رئيسية حالياً.</p>
      <?php endif; ?>
    </div>

    <div class="preview-group">
      <strong>صور المعرض الحالية</strong>
      <?php if(count($galleryPreview) > 0): ?>
        <div class="preview-grid">
          <?php foreach($galleryPreview as $img): ?>
            <img src="../images/<?php echo $img; ?>" alt="صورة معرض">
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p class="preview-empty">لا توجد صور معرض حالياً.</p>
      <?php endif; ?>
    </div>
  </aside>
</div>

<footer>© اكتشف السعودية — جامعة الملك سعود</footer>
<script src="../script.js"></script>

</body>
</html>