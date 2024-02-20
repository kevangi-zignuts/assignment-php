<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../css/bootstrap/css/bootstrap.css">    
    <link rel="stylesheet" href="./../css/style.css">
</head>
<body>
    <div class="mx-auto form-width margin-top">
        <?php 
            if(isset($_POST["submit"])){
                $firstName = $_POST["firstName"];
                $lastName = $_POST["lastName"];
                $email = $_POST["email"];
                $phoneNo = $_POST["phoneNo"];
                $password = $_POST["password"];
                $confirmPassword = $_POST["cpassword"];

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $errors = array();
                if(empty($firstName) OR empty($lastName) OR empty($email) OR empty($password) OR empty($confirmPassword) OR empty($phoneNo)){
                    array_push($errors, "All fields are required");
                } 
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    array_push($errors, "Email is not valid");
                }
                if(strlen($password)<8){
                    array_push($errors, "Password must be 8 character long");
                }
                if($password !== $confirmPassword){
                    array_push($errors, "password does not match");
                }
                require_once "config/database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result =  mysqli_query($conn, $sql);
                $rowcount = mysqli_num_rows($result);
                if($rowcount>0){
                    array_push($errors, "Email already exists");
                }
                if(count($errors)>0){
                    foreach($errors as $error){
                        echo "<div class='alert alert-danger' role='alert'>$error</div>";
                    }
                }else{
                    $sql = "INSERT INTO users (first_name, last_name, email, phone_number, password) VALUES (?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    if($prepareStmt){
                        mysqli_stmt_bind_param($stmt, "sssss", $firstName, $lastName, $email,$phoneNo, $passwordHash,);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success' role='alert'>You are registred successfully</div>";
                    }else{
                        die("Something went wrong");
                    }
                }
            }
            
        ?>

        <h1 class="text-center h1">SignIn Form</h1>
        <form method="post" action="userSignIn.php">
            <div class="row">
                <div class="col">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="First name" name="firstName">
                </div>
                <div class="col">
                <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="Last name" name="lastName">
                </div>
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label>Phone No.</label>
                <input type="tel" class="form-control" id="" placeholder="Enter Phone No." name="phoneNo">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="" placeholder="Password" name="password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" id="" placeholder="Password" name="cpassword">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
        <p>Already Registered <a class="link-opacity-50-hover" href="userLogin.php">Login Here</a><p>
    </div>
</body>
</html>