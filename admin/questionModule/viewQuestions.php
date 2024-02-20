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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./../../css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./../../css/style.css">
</head>
<body>
<div class="mx-auto form-width margin-top">
    <h1 class="text-center h1">All Questions</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Question :- </th>
                    <th scope="col">Option 1 :- </th>
                    <th scope="col">Option 2 :- </th>
                    <th scope="col">Option 3 :- </th>
                    <th scope="col">Answer :- </th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once "./../../config/database.php";
                    if(isset($_GET["id"])){
                        $id = $_GET['id'];
                    }else{
                        echo "Test id not found";
                    }
                    $query = "SELECT * FROM questions WHERE test_id = $id";
                    $result = $conn->query($query);
                    while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["question"] ?></td>
                            <td><?php echo $row["option1"] ?></td>
                            <td><?php echo $row["option2"] ?></td>
                            <td><?php echo $row["option3"] ?></td>
                            <td><?php echo $row["answer"] ?></td>
                            <td><a href="viewQue.php?id=<?php echo $row["id"] ?>"><i class="fa-solid fa-clipboard-question"></i></i></a></td>
                            <td><a href="editQue.php?id=<?php echo $row["id"] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            <td><a href="deleteQue.php?id=<?php echo $row["id"] ?>"><i class="fa-sharp fa-solid fa-trash"></i></a></td>
                        </tr>
                    <?php endwhile; ?>
            </tbody>
        </table>
        <div class="margin-top">
        <a href="./../testModule/view.php?id=<?php echo $id?>" class="btn btn-outline-primary" tabindex="-1" role="button" aria-disabled="true">Test Details</a>
        <a href="add.php?id=<?php echo $id?>" class="btn btn-outline-primary" tabindex="-1" role="button" aria-disabled="true">Add Question</a>
        </div>
    </div>
</body>
</html>