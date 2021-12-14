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
    <script src="js/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- Grid container object -->
    <div class="grid-container">
        <!-- Grid table left -->
        <div class="left">

            <p>Index page content</p>
            <p>Hello, <?php echo $_SESSION['username']; ?>!</p>
            <p>Welcome back, you have landed on the home page.</p>
            <p>Browse around and connect with other people</p>

            <form method="post" action="" enctype="multipart/form-data">
                <input type="file" name="uploadfile" value="" />
                <div>
                    <button type="submit" name="upload">Upload</button>
                </div>

                <h2>Hier komen fotos</h2>
                <p>yes this is content</p>
                <p>nog meer</p>
            </form>
        </div>
        <!-- Grid template middle -->
        <section id="indexBody-middle">
            <p>Here will the post/reply system come into place</p>
            <div class="comment-form-container">
                <div class="input-row">
                <input type="hidden" name="comment_id" id="commentId" placeholder="Name" />
                </div>
                <div class="input-row">
                    <textarea class="form-control" type="text" name="comment" id="comment" placeholder="Add a comment" required>  </textarea>
                </div>
                <div>
                    <input type="button" class="btn" id="submitButton" value="Publish">
                    <div id="comment-message">Comments Added Succesfully!</div>
                </div>
            </div>
            <div class="output"></div>
        </section>
        <!-- Grid template right -->
        <div class="right">
            <p>yes this is content</p>
            <a href="https://medium.com/before-semicolon/50-css-best-practices-guidelines-to-write-better-css-c60807e9eee2">50 Best Practices CSS</a></br>
            <a href="https://codepen.io/GeorgePark/pen/ZoaRrV">Code Pen Border customization</a></br>
            <a href="https://speedysense.com/create-registration-login-system-php-mysql/">Login system used for this website</a></br>
            <a href="https://codewithawa.com/posts/creating-a-comment-and-reply-system-php-and-mysql">Message system used</a>
        </div>
    </div>
    <script src="js/main.js"></script>

    <!-- Get the footer file -->
<?php echo file_get_contents("html/footer.html"); ?>

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

