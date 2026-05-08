<?php
$conn = new mysqli("localhost", "root", "", "saudi_db");

if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات");
}
?>