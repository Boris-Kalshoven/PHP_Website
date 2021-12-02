<?php 
require('dbconnection.php');
include('auth_session.php');
?>
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

<body id="profileBody">

<p>TODO: hier moet eeen overzicht komen van de gegevens van de gebruiker vanuit de database</p>
<p>zodat er gegevens aangepast kunnen worden</p>

<!-- Get the footer file -->
<?php echo file_get_contents("html/footer.html"); ?>

<!-- cool script voor agenda -->
 <!-- <input id="date" type="date" /> 
                    <script>
                    var date = new Date();
                    var currentDate = date.toISOString().slice(0,10);
                    var currentTime = date.getHours() + ':' + date.getMinutes();
                    
                    document.getElementById('date').value = currentDate;
                    </script></footer>