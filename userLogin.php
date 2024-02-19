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
                $sql = "SELECT * FROM users where email = '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC); 
                if($user){
                    if(password_verify($password, $user["password"])){
                        echo "<div class='alert alert-success' role='alert'>You are Login successfully</div>";
                    }else{
                        echo "<div class='alert alert-danger' role='alert'>Password Doesn't match</div>";
                    }
                }else{
                    echo "<div class='alert alert-danger' role='alert'>Invalid Email Id</div>";
                }
            }

        ?>

        <h1 class="text-center h1">Login Form</h1>
        <form method="post" action="userLogin.php">
            <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
        <p>Not registered yet <a class="link-opacity-50-hover" href="userSignIn.php">Register Here</a><p>
    </div>
</body>
</html>