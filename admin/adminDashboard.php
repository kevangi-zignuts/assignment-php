<?php 
    session_start();
    require_once "adminNavbar.php";
    if(!isset($_SESSION["admin"])){
        header("Location: adminLogin.php");
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
</head>
<body>
    <div class="mx-auto form-width margin-top">
    <h1 class="text-center h1">All Tests</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Level</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once "../config/database.php";
                    $query = "SELECT * FROM test";
                    $result = $conn->query($query);
                    while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["test_name"] ?></td>
                            <td><?php echo $row["level"] ?></td>
                            <td><p><a href="testModule/view.php?id=<?php echo $row["id"]?>">View</a></p></td>
                            <td><p><a href="testModule/edit.php?id=<?php echo $row["id"]?>"><i class="fa-solid fa-pen-to-square"></i></a></p></td>
                            <td><a href="testModule/delete.php?id=<?php echo $row["id"]?>"><i class="fa-sharp fa-solid fa-trash"></i></a></td>
                        </tr>
                    <?php endwhile; ?>
            </tbody>
        </table>
    </div>


</body>
</html>