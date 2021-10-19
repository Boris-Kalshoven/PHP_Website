<!-- Get the header file -->
<?php echo file_get_contents("html/header.html"); ?>

<!-- Get the body file -->
<?php echo file_get_contents("html/indexBody.html"); ?>
<!-- Turn off all error reporting -->
<?php error_reporting(0); ?>
<!-- Script for uploading an image -->
<?php
// Empty string to build message for uploading file
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



    // Database connection 
    $db = mysqli_connect("localhost", "root", "", "photos") or die("Unable to connect");
    echo "Connected!";

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

<!-- Copyright message with auto -->
<p>Copyright © Boris Kalshoven <?php echo date("Y") ?></p>