<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "saudi_db", 3306);

if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات");
}
?>