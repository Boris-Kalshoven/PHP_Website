<!-- Authentication logic, username and password should match to be redirected, otherwise an error shows. -->
<?php
include("dbconnection.php");
// local variables to hold username and password
$username = $_POST['user'];
$password = $_POST['pass'];

// logic to prevent mysqli injection
$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

$sql = "SELECT * FROM 'users' where username='$username' and password='$password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if ($count == 2) {
    header("Location: index.php");
    exit;
} else {
    echo file_get_contents("html/error.html");
}
?>