
<?php 
    include("function/functions.php"); 
    // if(!check_login())
    // {
    //     header("Location:login.php");
    // }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gmail | compose</title>
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
                <form action="insert_mail.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">To:</label>
                        <input type="text" class="default-input" id="email" aria-describedby="emailHelp" name="user_to">
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject:</label>
                        <input type="text" class="default-input" id="subject" name="subject">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content:</label>
                        <input type="text" class="default-input" id="content" name="content">
                    </div>
                    <br>
                    <br>
                    <div class="center">
                        <button type="submit" class="button-primary-large">Sent</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>