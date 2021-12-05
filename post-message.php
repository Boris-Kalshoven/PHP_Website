<?php
    include_once('dbconnection.php');

// Local variables to insert into DB from post form
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$content = mysqli_real_escape_string($conn, $_POST['content']);

    // Insert Data into DB
    $sql = "INSERT INTO posts (subject,content,date)
        VALUES ('$subject','$content', CURRENT_TIMESTAMP())";
    $result = mysqli_query($conn, $sql);

    header("Location: index.php?signup=success");



    //TODO: Fix berichten met User id erbij zodat je weet wie het bericht geplaatst heeft. Hier moet nog naar gekeken worden

//      $_SESSION['username'] = $username;

//     $uid = $username;

//     $subject = mysqli_real_escape_string($conn, $_POST['subject']);
// $content = mysqli_real_escape_string($conn, $_POST['content']);

// // Insert Data into DB
// $sql = "INSERT INTO postmessages (uid,subject,content,date)
// VALUES ('$uid','$subject','$content', CURRENT_TIMESTAMP())";
// $result = mysqli_query($conn, $sql);

// header("Location: index.php?signup=success");