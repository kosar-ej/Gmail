<?php
include("config.php");

$user_from = 1;
$user_to_email = $_POST['user_to'];
$subject = $_POST['subject'];
$content = $_POST['content'];

if (empty($user_to_email) || empty($subject) || empty($content)) {
    echo "<script type='text/javascript'>alert('لطفاً تمامی فیلدها را پر کنید!');</script>";
    exit();
}

$user_check_query = "SELECT Id FROM users WHERE username = '$user_to_email'";
$result = mysqli_query($conn, $user_check_query);

if (mysqli_num_rows($result) == 0) {
    echo "<script type='text/javascript'>alert('کاربر مورد نظر وجود ندارد!');</script>";
    exit();
}

$row = mysqli_fetch_assoc($result);
$user_to_id = $row['Id'];

$sql = "INSERT INTO emails (user_from, user_to, subject, content) VALUES ('$user_from', '$user_to_id', '$subject', '$content')";

if (mysqli_query($conn, $sql)) {
    echo "<h1>ایمیل با موفقیت ارسال شد</h1>";
} else {
    echo "خطا: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
header('Location: sent.php');
?>
