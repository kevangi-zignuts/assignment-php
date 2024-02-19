<?php 
    session_start();
    require_once "adminNavbar.php";
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
</head>
<body>
    <div class="mx-auto form-width margin-top">
    <h1 class="text-center h1">Add New Question</h1>
        <form>
            <div class="form-group">
                <label>Add Question :- </label>
                <input type="text" class="form-control" id="">
            </div>
            <div class="form-group">
                <label>Add Option 1:-</label>
                <input type="text" class="form-control" >
            </div>
            <div class="form-group">
                <label>Add Option 2:-</label>
                <input type="text" class="form-control" >
            </div>
            <div class="form-group">
                <label>Add Option 3:-</label>
                <input type="text" class="form-control" >
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>
</html>