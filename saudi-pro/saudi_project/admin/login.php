<?php
session_start();

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if($user == "admin" && $pass == "1234"){
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
    } else {
        $error = "❌ اسم المستخدم أو كلمة المرور غلط";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>تسجيل دخول الأدمن</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<h2>🔐 تسجيل دخول الأدمن</h2>

<?php if(isset($error)) echo "<p>$error</p>"; ?>

<form method="POST">
  <input type="text" name="username" placeholder="اسم المستخدم" required><br><br>
  <input type="password" name="password" placeholder="كلمة المرور" required><br><br>
  <button name="login">دخول</button>
</form>

</body>
</html>