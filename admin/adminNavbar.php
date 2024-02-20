<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- <li class="nav-item active">
                    <a class="nav-link" href="adminDashboard.php">Home</a>
                </li> -->
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo getRelativePath('adminDashboard.php') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo getPath('admin/testModule/create.php') ?>">Create Test</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo getRelativePath('adminLogout.php') ?>">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <script src="../css/bootstrap/js/bootstrap.js"></script>
</body>
</html>



<?php
function getRelativePath($target){
    $currentPage = ltrim($_SERVER['PHP_SELF'], '/');
    $target = ltrim($target, '/');
    $depth = substr_count($currentPage, '/');

    if(strpos($currentPage, 'admin/') === 0){
        $depth--;
    }

    $relativePath = str_repeat('../', $depth).$target;

    return $relativePath;
}

function getPath($target){
    $basePath = rtrim(str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__), '/');
    $targetPath = rtrim($target, '/');

    $relativePath = '/' . ltrim(str_replace($basePath, '', $targetPath), '/');

    return $relativePath;
}

?>