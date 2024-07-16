<?php
    include("config.php");
    if (is_int(intval($_GET["id"]))) {
        $email_id = intval($_GET["id"]);
        $sql = "SELECT id, user_from, user_to, content, subject, created_at FROM emails WHERE id=$email_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_from_id = $row["user_from"];

            // Query to get the username
            $user_sql = "SELECT username FROM users WHERE id=$user_from_id";
            $user_result = $conn->query($user_sql);
            if ($user_result->num_rows > 0) {
                $user_row = $user_result->fetch_assoc();
                $user_from_username = $user_row["username"];
            } else {
                $user_from_username = "Unknown User";
            }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gmail | Email Detail</title>
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
        <!-- single mail -->
        <div class="detail-card">
            <div class="header">
                <div class='user-box'>
                    <img src="./images/user.png" alt="user">
                    <span>
                        <?php echo htmlspecialchars($user_from_username); ?>
                    </span>
                </div>
                <span>
                    <?php echo htmlspecialchars($row["created_at"]); ?>
                </span>
            </div>
            <hr>
            <div>
                <h5>
                    <?php echo htmlspecialchars($row["subject"]); ?>
                </h5>
                <p>
                    <?php echo htmlspecialchars($row["content"]); ?>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
        } else {
            echo "Email not found.";
        }
    } else {
        echo "404";
    }
?>
