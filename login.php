<?php 
    session_start();
    include("function/functions.php");
    if(check_login())
    {
        header("Location:home.php");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $username="";
        $password="";

        if (isset($_POST["username"]))
        {
            if (!empty($_POST["username"])){
                $username=$_POST["username"];
            }
        }
        if (isset($_POST["password"]))
        {
            if (!empty($_POST["password"])){
                $password=$_POST["password"];
            }
        }
        var_dump($username);
        var_dump($password);
        if (empty($username) || empty($password)){
            $_SESSION['message']="you must enter username and password";
            return header("Location:login.php");
        }

        if (!do_login($username,$password)){
            return header("Location:login.php");
        }
        return header("Location:home.php");
    }
    // var_dump(@$_SESSION['message']);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gmail | register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <!-- navbar -->
    <?php 
        include("navbar.php"); 
    ?>
    <div class="container-xl">
        <br>
        <!-- form -->
        <div class="center">
            <div class="form-card">
                <form action="login.php" method="post" enctype="application/x-www-form-urlencoded">
                    <?php
                        if(isset($_SESSION['message'])):
                            if(!empty($_SESSION['message'])):

                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION['message'] ?>
                    </div>
                    <?php 
                            endif;
                        endif;
                        $_SESSION['message']=""
                    ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <br>
                        <input type="email" class="default-input" id="email" aria-describedby="emailHelp" name="username">
                    </div>
            
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <br>
                        <input type="password" class="default-input" id="password" name="password">
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="center">
                        <button type="submit" class="button-primary-large">Login</button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</body>
</html>