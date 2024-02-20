<?php 
    session_start();
    require_once "../adminNavbar.php";
    if(!isset($_SESSION["admin"])){
        header("Location: adminDashboard.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../../css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./../../css/style.css">
</head>
<body>
    <div class="mx-auto form-width margin-top">
        <?php 
        require_once "./../../config/database.php"; 
            $id = $_GET['id'];
            $sql = "SELECT * FROM test WHERE id = $id";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
        ?>

        <h1 class="text-center h1">View Test</h1>
        <div class="card">
            <div class="card-header">
                <h2><?php echo $data['test_name'] ?></h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">Description</h5>
                <p class="card-text"><?php echo $data['description'] ?></p>
                <h5 class="card-title">Level</h5>
                <p class="card-text"><?php echo $data['level'] ?></p>
                </div>
            </div>
            <div class="margin-top">
                <a href="edit.php?id=<?php echo $id?>" class="btn btn-outline-primary" tabindex="-1" role="button" aria-disabled="true">Edit</a>
                <a href="./../questionModule/add.php?id=<?php echo $id?>" class="btn btn-outline-primary" tabindex="-1" role="button" aria-disabled="true">Add Question</a>
                <a href="./../questionModule/viewQuestions.php?id=<?php echo $id?>" class="btn btn-outline-primary" tabindex="-1" role="button" aria-disabled="true">View All Question</a>
            </div>
    </div>
</body>
</html>