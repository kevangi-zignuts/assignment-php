<?php 
    require_once "./../../config/database.php"; 
    $id = $_GET['id'];
    $sql = "DELETE FROM test WHERE id = $id";
    mysqli_query($conn, $sql);
    $_SESSION["admin"] = "yes";
    header("Location: ./../adminDashboard.php");
    die();
?>