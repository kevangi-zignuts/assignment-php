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
                    require_once "config/database.php";
                    $query = "SELECT * FROM test";
                    $result = $conn->query($query);
                    while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["test_name"] ?></td>
                            <td><?php echo $row["level"] ?></td>
                            <td><p><a href="view.php?id=<?php echo $row["id"]?>" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View</a></p></td>
                            <td><p><a href="edit.php?id=<?php echo $row["id"]?>" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Edit</a></p></td>
                            <td><p><a href="delete.php?id=<?php echo $row["id"]?>" class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Delete</a></p></td>
                        </tr>
                    <?php endwhile; ?>
            </tbody>
        </table>
    </div>


</body>
</html>