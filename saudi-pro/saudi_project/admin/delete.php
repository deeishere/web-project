<?php
include("../config.php");

$id = $_GET['id'];

$conn->query("DELETE FROM places WHERE id=$id");

header("Location: dashboard.php?msg=deleted");
exit();