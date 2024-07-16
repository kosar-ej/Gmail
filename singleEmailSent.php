<?php
    include("config.php");
    if (is_int(intval($_GET["id"]))) {
        $email_id = intval($_GET["id"]);
        $sql = "SELECT id, user_from, user_to, content, subject, created_at FROM emails WHERE id=$email_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_to_id = $row["user_to"];

            // Query to get the username of the recipient (user_to)
            $user_sql = "SELECT username FROM users WHERE id=$user_to_id";
            $user_result = $conn->query($user_sql);
            if ($user_result->num_rows > 0) {
                $user_row = $user_result->fetch_assoc();
                $user_to_username = $user_row["username"];
            } else {
                $user_to_username = "Unknown User";
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
                        <?php echo htmlspecialchars($user_to_username); ?>
                    </span>
                </div>
                <div class='flex-small'>
                    <a href="<?php echo "updateEmail.php?id=" . $row["id"] ?>" class="default-button-small">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#a27b5c" class="bi bi-pen-fill" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                    </svg>
                    </a>
                    <span>
                        <?php echo htmlspecialchars($row["created_at"]); ?>
                    </span>
                </div>
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
