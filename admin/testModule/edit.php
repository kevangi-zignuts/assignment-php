<?php 
    session_start();
    require_once "./../adminNavbar.php";
    if(!isset($_SESSION["admin"])){
        header("Location: ./../adminDashboard.php");
        exit();
    }
?>

<?php 
    require_once "./../../config/database.php"; 
    if(isset($_GET["id"])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM test WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($result);
        if(!$data){
            echo "Test not found";
        }
    }else{
        echo "Test id not found";
    }

    if(isset($_POST["edit"])){
        $testName = $_POST["name"];
        $description = $_POST["desc"];
        $level = $_POST["level"];
    
        $errors = array();
        if(empty($testName) OR empty($description) OR empty($level)){
            array_push($errors, "All fields are required");
        } 
        if(count($errors)>0){
            echo "<div class='alert alert-danger' role='alert'>$errors[0]</div>";
        }
    
        $sql = "UPDATE test SET test_name = '$testName', description = '$description', level = '$level' WHERE id = '$id'";
        if($conn->query($sql)===TRUE){
            echo "success";
            $_SESSION["admin"] = "yes";
            header("Location: ./../adminDashboard.php");
            die();
        }else{
            die("Something went wrong");
        }
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
        <h1 class="text-center h1">Edit Test</h1>
        <form method="post" action="edit.php?id=<?php echo $id?>">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="" placeholder="" name="name" value="<?php echo $data["test_name"] ?>">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" id="" rows="3" name="desc"></textarea>
            </div>
            <select class="form-control" name="level">
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
            <button type="submit" class="btn btn-primary margin-top" name="edit">Edit Test</button>
        </form>
    </div>
</body>
</html>