<?php 
    require_once "./../../config/database.php"; 
    $id = $_GET['id'];
    $sql = "SELECT * FROM questions WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    $testId = $data["test_id"];
    $sql = "DELETE FROM questions WHERE id = $id";
    mysqli_query($conn, $sql);
    $_SESSION["admin"] = "yes";
    // header("Location: ./../adminDashboard.php");
    header("Location: viewQuestions.php?id=$testId");
    die();
?>