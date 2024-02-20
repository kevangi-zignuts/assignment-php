<?php 
    session_start();
    require_once "../adminNavbar.php";
    if(!isset($_SESSION["admin"])){
        header("Location: view.php");
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

<?php
    require_once "./../../config/database.php";
    if(isset($_GET["id"])){
        $id = $_GET['id'];
    }else{
        echo "Test id not found";
    }
    if(isset($_POST["add"])){
        $question = $_POST["que"];
        $option1 = $_POST["op1"];
        $option2 = $_POST["op2"];
        $option3 = $_POST["op3"];
        $answer = $_POST["ans"];


        $errors = array();
        if(empty($question) OR empty($option1) OR empty($option2) OR empty($option3) OR empty($answer)){
            array_push($errors, "All fields are required");
        } 

        
        $sql = "INSERT INTO questions (test_id, question, option1, option2, option3, answer) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if($prepareStmt){
            mysqli_stmt_bind_param($stmt, "ssssss", $id, $question, $option1, $option2, $option3, $answer);
            mysqli_stmt_execute($stmt);
            $_SESSION["admin"] = "yes";
            header("Location: viewQuestions.php?id=$id");
            die();
        }else{
            die("Something went wrong");
        }
    }
?>

<body>
    <div class="mx-auto form-width margin-top">
    <h1 class="text-center h1">Add New Question</h1>
        <form method="post" action="add.php?id=<?php echo $id?>">
            <div class="form-group">
                <label>Add Question :- </label>
                <input type="text" class="form-control" id="" name="que">
            </div>
            <div class="form-group">
                <label>Add Option 1:-</label>
                <input type="text" class="form-control" name="op1">
            </div>
            <div class="form-group">
                <label>Add Option 2:-</label>
                <input type="text" class="form-control" name="op2">
            </div>
            <div class="form-group">
                <label>Add Option 3:-</label>
                <input type="text" class="form-control" name="op3">
            </div>
            <label>Add Answer</label>
            <select class="form-control" name="ans">
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
            </select>
            <button type="submit" class="btn btn-primary margin-top" name="add">Add Question</button>
        </form>
    </div>

</body>
</html>