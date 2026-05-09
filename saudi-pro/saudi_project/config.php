<?php
try{
    $conn = mysqli_connect("127.0.0.1", "root", "", "saudi_db", 3306);
}catch(Exception $e){
    die("فشل الاتصال بقاعدة البيانات");
}
?>