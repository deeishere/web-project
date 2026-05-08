<?php
session_start();
include("../config.php");

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['add'])){
    $name        = $conn->real_escape_string($_POST['name']);
    $region      = $conn->real_escape_string($_POST['region']);
    $description = $conn->real_escape_string($_POST['description']);
    $location    = $conn->real_escape_string($_POST['location'] ?? '');
    $features    = $conn->real_escape_string($_POST['features'] ?? '');
    $activities  = $conn->real_escape_string($_POST['activities'] ?? '');
    $landmarks   = $conn->real_escape_string($_POST['landmarks'] ?? '');
    $best_time   = $conn->real_escape_string($_POST['best_time'] ?? '');

    // Main image
    $image_name = '';
    if(!empty($_FILES['image']['name'])){
        $image_name = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/" . $image_name);
    }

    // Gallery images
    $image2 = $image3 = $image4 = '';
    foreach(['image2','image3','image4'] as $k){
        if(!empty($_FILES[$k]['name'])){
            $n = basename($_FILES[$k]['name']);
            move_uploaded_file($_FILES[$k]['tmp_name'], "../images/" . $n);
            $$k = $n;
        }
    }

    // Insert only columns that exist in the current DB schema
    $allData = [
        'name' => $name,
        'region' => $region,
        'description' => $description,
        'image' => $image_name,
        'location' => $location,
        'features' => $features,
        'activities' => $activities,
        'landmarks' => $landmarks,
        'best_time' => $best_time,
        'image2' => $image2,
        'image3' => $image3,
        'image4' => $image4
    ];

    $existingCols = [];
    $colsResult = $conn->query("SHOW COLUMNS FROM places");
    if($colsResult){
        while($c = $colsResult->fetch_assoc()){
            $existingCols[] = $c['Field'];
        }
    }

    $insertCols = [];
    $insertVals = [];
    foreach($allData as $col => $val){
        if(in_array($col, $existingCols, true)){
            $insertCols[] = $col;
            $insertVals[] = "'" . $val . "'";
        }
    }

    if(!empty($insertCols)){
        $sql = "INSERT INTO places (" . implode(',', $insertCols) . ") VALUES (" . implode(',', $insertVals) . ")";
        $conn->query($sql);
    }

    header("Location: dashboard.php?msg=added");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>إضافة منطقة</title>
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

<div class="form-page-wrap">
  <div class="form-card">
    <h2>➕ إضافة مكان جديد</h2>

    <form method="POST" enctype="multipart/form-data">

      <div class="form-group">
        <label>* اسم المكان</label>
        <input type="text" name="name" placeholder="مثال: الرياض" required>
      </div>

      <div class="form-group">
        <label>* الصورة الرئيسية للمكان</label>
        <input type="file" name="image" accept="image/*" required>
      </div>

      <div class="form-group">
        <label>* الوصف</label>
        <textarea name="description" placeholder="اكتب وصفاً تفصيلياً..." required></textarea>
      </div>

      <div class="form-group">
        <label>* المنطقة</label>
        <select name="region" required>
          <option value="">اختر المنطقة</option>
          <option value="وسطى">وسطى</option>
          <option value="غربية">غربية</option>
          <option value="شرقية">شرقية</option>
          <option value="جنوبية">جنوبية</option>
          <option value="شمالية">شمالية</option>
        </select>
      </div>

      <div class="form-group">
        <label>المميزات</label>
        <input type="text" name="features" placeholder="مثال: مواقع أثرية، طبيعة خلابة">
      </div>

      <div class="form-group">
        <label>الأنشطة</label>
        <textarea name="activities" placeholder="مثال: موقع أثري، طبيعة خلابة (سطر لكل نشاط)" style="min-height:70px;"></textarea>
      </div>

      <div class="form-group">
        <label>أبرز المعالم</label>
        <textarea name="landmarks" placeholder="مثال: برج الملك سعود (سطر لكل معلم)" style="min-height:70px;"></textarea>
      </div>

      <div class="form-group">
        <label>أفضل وقت للزيارة</label>
        <input type="text" name="best_time" placeholder="مثال: من أكتوبر حتى أبريل للزيارة التقليدية">
      </div>

      <div class="form-section-title">صور المعرض</div>

      <div class="form-group">
        <label>* صورة المعرض الأولى</label>
        <input type="file" name="image2" accept="image/*">
      </div>

      <div class="form-group">
        <label>صورة المعرض الثانية (اختياري)</label>
        <input type="file" name="image3" accept="image/*">
      </div>

      <div class="form-group">
        <label>صورة المعرض الثالثة (اختياري)</label>
        <input type="file" name="image4" accept="image/*">
      </div>

      <button type="submit" name="add" class="form-submit">إضافة المكان</button>
    </form>

    <br>
    <a href="dashboard.php" class="back-link">← رجوع إلى لوحة التحكم</a>
  </div>
</div>

<footer>© اكتشف السعودية — جامعة الملك سعود</footer>
<script src="../script.js"></script>
</body>
</html>