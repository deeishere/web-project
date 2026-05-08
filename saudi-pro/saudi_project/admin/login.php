<?php
session_start();

if(isset($_SESSION['admin'])){
    header("Location: dashboard.php");
    exit();
}

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if($user == "admin" && $pass == "1234"){
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "❌ اسم المستخدم أو كلمة المرور غير صحيح";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>تسجيل دخول المشرف</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>

<div style="background:var(--green); padding:14px 28px; display:flex; justify-content:space-between; align-items:center; box-shadow:var(--shadow);">
  <span style="color:#fff; font-weight:700; font-size:1rem;">لوحة المشرف</span>
  <div style="display:flex; gap:10px; align-items:center;">
    <a href="javascript:void(0)" onclick="toggleDarkMode()" style="color:#fff; text-decoration:none; font-size:0.88rem; padding:7px 15px; border-radius:20px; background:rgba(255,255,255,0.12);">الوضع الليلي</a>
    <a href="../index.php" style="color:#fff; text-decoration:none; font-size:0.88rem; padding:7px 15px; border-radius:20px; background:rgba(255,255,255,0.12);">زيارة الموقع</a>
  </div>
</div>

<div class="login-wrap">
  <div class="login-card">
    <h2>🔐 تسجيل دخول المشرف</h2>

    <?php if(isset($error)): ?>
      <div class="error-msg"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="form-group">
        <label for="username">اسم المستخدم</label>
        <input type="text" id="username" name="username" placeholder="مثال: admin" required>
      </div>
      <div class="form-group">
        <label for="password">كلمة المرور</label>
        <input type="password" id="password" name="password" placeholder="••••••••" required>
      </div>
      <button type="submit" name="login" class="form-submit">دخول</button>
    </form>
  </div>
</div>

<script src="../script.js"></script>
</body>
</html>