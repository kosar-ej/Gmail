<?php
    session_start();
    include("function/functions.php"); 
    if(check_login())
    {
        header("Location:home.php");
    }
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
        <!-- form -->
        <div class="center">
            <div class="form-card">
                <form action="insert_user.php" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="default-input" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="default-input" id="email" aria-describedby="emailHelp" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">PhoneNumber:</label>
                        <input type="tel" class="default-input" id="mobile" name="mobile">
                    </div>
                    <div class="mb-3">
                        <label for="birthday" class="form-label">Birthday:</label>
                        <input type="date" class="default-input" id="birthday" name="birthday">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="default-input" id="password" name="password">
                    </div>
                    <br>
                    <br>
                    <div class="center">
                        <button type="submit" class="button-primary-large">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>