<?php
include("../config.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($id > 0){
    $conn->query("DELETE FROM places WHERE id=$id");
}

header("Location: dashboard.php?msg=deleted");
exit();