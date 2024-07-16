<?php
include("function/functions.php");
include("config.php");  // Include the database connection file

$email_id = null;
if (isset($_GET["id"]) && is_int(intval($_GET["id"]))) {
    $email_id = intval($_GET["id"]);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email_id"])) {
    $subject = $_POST["subject"];
    $content = $_POST["content"];
    $email_id = intval($_POST["email_id"]);

    if ($email_id && $subject && $content) {
        // Prepare an SQL statement for safe execution
        $query = "UPDATE emails SET subject=?, content=? WHERE id=?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("ssi", $subject, $content, $email_id);
            if ($stmt->execute()) {
                $message = "Email updated successfully.";
                echo "<script>
                        alert('$message');
                        window.location.href = 'singleEmailSent.php?id=$email_id';
                      </script>";
                exit();
            } else {
                $message = "Error updating email.";
            }
            $stmt->close();
        } else {
            $message = "Error preparing statement.";
        }
    } else {
        $message = "Please fill in all fields.";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gmail | Update</title>
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
                <?php if ($message): ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>
                <form action="" method="post">
                    <input type="hidden" name="email_id" value="<?php echo htmlspecialchars($email_id); ?>">
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
                    <br>
                    <div class="center">
                        <button type="submit" class="button-primary-large">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
