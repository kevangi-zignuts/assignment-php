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

<?php 
    require_once "./../../config/database.php"; 
    if(isset($_GET["id"])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM questions WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($result);
        if(!$data){
            echo "Test not found";
        }
    }else{
        echo "Test id not found";
    }

    if(isset($_POST["editQue"])){
        $question = $_POST["que"];
        $option1 = $_POST["op1"];
        $option2 = $_POST["op2"];
        $option3 = $_POST["op3"];
        $answer = $_POST["ans"];
        $testId = $data['test_id'];

    
        $errors = array();
        if(empty($question) OR empty($option1) OR empty($option2) OR empty($option3) OR empty($answer)){
            array_push($errors, "All fields are required");
        } 
        if(count($errors)>0){
            echo "<div class='alert alert-danger' role='alert'>$errors[0]</div>";
        }
    
        $sql = "UPDATE questions SET question = '$question', option1 = '$option1', option2 = '$option2', option3 = '$option3', answer = '$answer' WHERE id = '$id'";
        if($conn->query($sql)===TRUE){
            $_SESSION["admin"] = "yes";
            // header("Location: ./../adminDashboard.php");
            header("Location: viewQuestions.php?id=$testId");
            die();
        }else{
            die("Something went wrong");
        }
    }

?>



<body>
    <form method="post" action="editQue.php?id=<?php echo $id ?>">
    <div class="mx-auto form-width margin-top">
        <h1 class="text-center h1">Edit Question</h1>
        <div class="form-group">
            <label>Add Question :- </label>
            <input type="text" class="form-control" id="" name="que" value="<?php echo $data["question"] ?>">
            </div>
            <div class="form-group">
                <label>Add Option 1:-</label>
                <input type="text" class="form-control" name="op1" value="<?php echo $data["option1"] ?>">
            </div>
            <div class="form-group">
                <label>Add Option 2:-</label>
                <input type="text" class="form-control" name="op2" value="<?php echo $data["option2"] ?>">
            </div>
            <div class="form-group">
                <label>Add Option 3:-</label>
                <input type="text" class="form-control" name="op3" value="<?php echo $data["option3"] ?>">
            </div>
            <label>Add Answer</label>
            <select class="form-control" name="ans">
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
            </select>
            <button type="submit" class="btn btn-primary margin-top" name="editQue">Edit Question</button>
    </form>

</div>

</body>
</html>