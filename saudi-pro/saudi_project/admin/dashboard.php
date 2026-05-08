<?php
session_start();
include("../config.php");

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM places ORDER BY id");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>لوحة التحكم</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>

<div style="background:var(--green); padding:14px 24px; display:flex; justify-content:space-between; align-items:center; box-shadow:var(--shadow); margin-bottom:0;">
  <span style="color:#fff; font-weight:700; font-size:1rem;">لوحة تحكم المشرف</span>
  <div style="display:flex; gap:8px; align-items:center;">
    <button onclick="toggleDarkMode()" style="color:#fff; font-family:inherit; font-size:0.88rem; padding:7px 15px; border-radius:20px; background:rgba(255,255,255,0.12); border:none; cursor:pointer;">الوضع الليلي</button>
    <a href="logout.php" style="color:#fff; text-decoration:none; font-size:0.88rem; padding:7px 15px; border-radius:20px; background:#cf2637;">تسجيل الخروج</a>
  </div>
</div>

<div class="container">

  <?php if(isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
    <div class="success-box">✅ تم حذف السجل بنجاح.</div>
  <?php endif; ?>
  <?php if(isset($_GET['msg']) && $_GET['msg'] === 'added'): ?>
    <div class="success-box">✅ تمت إضافة السجل بنجاح.</div>
  <?php endif; ?>
  <?php if(isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
    <div class="success-box">✅ تم تحديث السجل بنجاح.</div>
  <?php endif; ?>

  <div class="info-box">
    استخدم هذه الصفحة لإدارة محتوى الموقع من خلال عرض السجلات وإضافة أو تعديل أو حذف المحتوى.
  </div>

  <div class="dashboard-header">
    <h2>إدارة المحتوى</h2>
    <a href="add.php" class="btn add-btn">+ إضافة منطقة جديدة</a>
  </div>

  <div class="table-box">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>المنطقة</th>
          <th>التصنيف</th>
          <th>الوصف</th>
          <th>الإجراءات</th>
        </tr>
      </thead>
      <tbody>
      <?php if($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo htmlspecialchars($row['name']); ?></td>
          <td><?php echo htmlspecialchars($row['region']); ?></td>
          <td style="max-width:280px; text-align:right;"><?php echo mb_strimwidth(htmlspecialchars($row['description']), 0, 60, '...'); ?></td>
          <td>
            <div class="actions">
              <a href="update.php?id=<?php echo $row['id']; ?>" class="edit-btn">تعديل</a>
              <a href="delete.php?id=<?php echo $row['id']; ?>" class="delete-btn"
                 onclick="return confirm('هل أنت متأكد من حذف هذا السجل؟');">حذف</a>
            </div>
          </td>
        </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="5" style="padding:30px; color:var(--muted);">لا توجد سجلات</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>

</div>

<footer>© اكتشف السعودية — جامعة الملك سعود</footer>
<script src="../script.js"></script>
</body>
</html>