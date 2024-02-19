<?php 
    session_start();
    // require_once "adminNavbar.php";
    if(isset($_SESSION["admin"])){
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
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="mx-auto form-width margin-top">
        <?php
            if(isset($_POST["login"])){
                $email = $_POST["email"];
                $password = $_POST["password"];
                require_once "config/database.php";
                $sql = "SELECT * FROM admin where email = '$email'";
                $result = mysqli_query($conn, $sql);
                $admin = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if($admin){
                    if($password === $admin["password"]){
                        $_SESSION["admin"] = "yes";
                        header("Location: adminDashboard.php");
                        die();
                    }else{
                        echo "<div class='alert alert-danger' role='alert'>Password Doesn't match</div>";
                    }
                }else{
                    echo "<div class='alert alert-danger' role='alert'>Invalid Email Id</div>";
                }
            }

        ?>


        <form action="adminLogin.php" method="post">
            <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
    </div>
</body>
</html>