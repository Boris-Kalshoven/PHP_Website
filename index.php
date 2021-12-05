<?php
// Include auth_session.php file on all user panel pages
include("auth_session.php");
include_once('dbconnection.php');
// Empty string to build message for uploading file
?>
<link rel="stylesheet" href="styles.css" />
<!-- Get the header file -->
<?php echo file_get_contents("html/header.html"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <!-- Grid container object -->
    <div class="grid-container">
        <div class="left">
            <h2>Hier komen fotos</h2>
            <p>yes this is content</p>
            <p>nog meer</p>


            

        </div>
        <!-- Grid template middle -->
        <section id="indexBody-middle">
            <p>Index page content</p>
            <p>Hello, <?php echo $_SESSION['username']; ?>!</p>
            <p>Welcome, you have landed on the home page.</p>

            <form method="post" action="" enctype="multipart/form-data">
                <input type="file" name="uploadfile" value="" />
                <div>
                    <button type="submit" name="upload">Upload</button>
                </div>
            </form>
        </section>
        <div class="right">
            <h2>hier kun je straks berichten plaatsen</h2>
            <form action="post-message.php" method="POST">
                <h1>Message to post on my website!</h1  >
                <input type="text" name="subject" placeholder="Subject">
                <input type="text" name="content" placeholder="Content">
                <button type="submit" name="postMessage" id="postMessageBtn">Post Message</button>
            </form>
            <!---->
            <?php
            

            // Show data of a post on website please :3
            $sql = "SELECT * FROM posts;";
            $result = mysqli_query($conn, $sql);
            $resultCheckPost = mysqli_num_rows($result);
            if($resultCheckPost > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo  $row['subject'] . "\t" . $row['content'] . "\t".  $row['date'] . "<br>";
                }
            }else{
                echo "Wat is het nog leeg hier. Plaats nu het eerste bericht en een gesprek met alle gebruikers";
            }


            ?>
            <p>yes this is content</p>
            <a href="https://medium.com/before-semicolon/50-css-best-practices-guidelines-to-write-better-css-c60807e9eee2">50 Best Practices CSS</a>
        </div>
    </div>
</body>

<!-- Turn off all error reporting -->
<?php error_reporting(0); ?>

<!-- Script for uploading an image -->
<?php
$msg = "";
// If upload button is clicked
if (isset($_POST['upload'])) {
    // The original name of the file on the client local machine
    $filename = $_FILES['uploadfile']['name'];
    // Temporary file name of which the uploaded file was stored on the server
    $tempname = $_FILES['uploadfile']['tmp_name'];
    // Size of the file
    $fileSize = $_FILES['uploadfile']['size'];
    // Any error the files might throw
    $fileError = $_FILES['uploadfile']['error'];
    // Reference variable for local image path
    $folder = "image/" . $filename;
    // Query to upload image to PHPMyAdmin
    $sql = "INSERT INTO image (filename) VALUES ('$filename')";

    // Execute query
    mysqli_query($db, $sql);

    // Move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        $msg = "Image uploaded successfully!";
    } else {
        $msg = "Failed to upload image...";
    }
}
?>

<!-- Get the footer file -->
<?php echo file_get_contents("html/footer.html"); ?>