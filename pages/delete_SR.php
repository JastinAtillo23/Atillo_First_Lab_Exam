<?php
include "../db.php";

$id = mysqli_real_escape_string($conn, $_GET['id']);

mysqli_query($conn, "DELETE FROM student WHERE ID_number='$id'");

header("Location: ../index.php");
exit();
?>