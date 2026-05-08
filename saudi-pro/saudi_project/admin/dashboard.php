<?php
session_start();
include("../config.php");

// حماية الصفحة
if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>لوحة التحكم</title>

<link rel="stylesheet" href="http://localhost/saudi_project/style.css"></head>

<body>

<!-- الهيدر -->
<nav>
  <div class="nav-brand">لوحة تحكم المشرف</div>

  <div class="nav-links">
<a href="#" class="dark-btn" onclick="toggleDarkMode(); return false;">
  الوضع الليلي
</a><a href="logout.php" class="logout-btn">تسجيل الخروج</a></nav>
<div class="container">

  <h2>إدارة المحتوى</h2>

<div class="info-box">
  تستخدم هذه الصفحة لإدارة محتوى الموقع من خلال عرض السجلات وإضافة أو تعديل أو حذف المحتوى.
</div>
  <!-- زر إضافة -->
  <a href="add.php" class="btn add-btn">إضافة منطقة جديدة</a>

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

      <?php
      $result = $conn->query("SELECT * FROM places");

      while($row = $result->fetch_assoc()){
      ?>

        <tr>

          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['region']; ?></td>
          <td><?php echo $row['description']; ?></td>

          <td class="actions">
            <a href="update.php?id=<?php echo $row['id']; ?>" class="edit">تعديل</a>
<a href="delete.php?id=<?php echo $row['id']; ?>" 
   class="delete"
   onclick="return confirm('هل أنت متأكد من حذف هذا السجل؟');">
   حذف
</a>          </td>

        </tr>

      <?php } ?>

      </tbody>

    </table>

  </div>

</div>
<script src="/saudi_project/script.js"></script>

</body>
</html>
