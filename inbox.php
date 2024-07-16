<div>
    <h1 class="text-center title">
        Inbox
    </h1>
</div>
<br>
<!--select data from emails and users table-->
<?php
    include("config.php"); 
    $sql = "SELECT id ,user_from ,user_to ,content ,subject ,created_at FROM emails WHERE user_to=1";
    $result = mysqli_query($conn, $sql);            
?>
<!-- show inbox mails -->
<?php
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
?>
    <div class="default-card">
        <a href="<?php echo "singleEmailInbox.php?id=" . $row["id"] ?>">
            <h5 class="card-title">
                <?php echo $row["subject"] ?>
            </h5>
            <p class="card-text">
                <?php echo $row["content"] ?>
            </p>
        </a>
        <div>
            <a href="<?php echo "deleteInbox.php?id=" . $row["id"] ?>" class="default-button-small">
                <img src="./images/trash.png" alt="">
            </a>
        </div>
    </div>
    <br>
<?php       
    } 
    } else {
    echo "0 results";
    }
    mysqli_close($conn);
?>