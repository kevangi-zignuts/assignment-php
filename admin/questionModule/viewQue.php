<?php 
    session_start();
    require_once "./../adminNavbar.php";
    if(!isset($_SESSION["admin"])){
        header("Location: ./../adminDashboard.php");
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
            $sql = "SELECT * FROM questions WHERE id = $id";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
        ?>

        <h1 class="text-center h1">View Question</h1>
        <div class="card">
            <div class="card-header">
                <h4><?php echo $data['question'] ?></h4>
            </div>
            <div class="card-body">
                <h5 class="card-title">option 1 :- </h5>
                <p class="card-text"><?php echo $data['option1'] ?></p>
                <h5 class="card-title">option 2 :- </h5>
                <p class="card-text"><?php echo $data['option1'] ?></p>
                <h5 class="card-title">option 3 :- </h5>
                <p class="card-text"><?php echo $data['option3'] ?></p>
                <h5 class="card-title">Answer</h5>
                <?php 
                    if($data['answer']==="1"){
                        echo "<p class='card-text'>".$data['answer']." ".$data['option1']."</p>";
                    }else if($data['answer']==="2"){
                        echo "<p class='card-text'>".$data['answer']." ".$data['option2']."</p>";
                    }else if($data['answer']==="3"){
                        echo "<p class='card-text'>".$data['answer']." ".$data['option3']."</p>";
                    }
                ?>
            </div>
        </div>
        <div class="margin-top">
            <a href="editQue.php?id=<?php echo $id?>" class="btn btn-outline-primary" tabindex="-1" role="button" aria-disabled="true">Edit</a>
            <a href="add.php?id=<?php echo $id?>" class="btn btn-outline-primary" tabindex="-1" role="button" aria-disabled="true">Add Question</a>
            <a href="viewQuestions.php?id=<?php echo $data['test_id']?>" class="btn btn-outline-primary" tabindex="-1" role="button" aria-disabled="true">View All Question</a>
        </div>
    </div>
</body>
</html>