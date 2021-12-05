<?php 
require('dbconnection.php');
include('auth_session.php');
?>
<!-- Get the header file -->
<?php echo file_get_contents("html/header.html"); ?>

<body id="profileBody">

<p>TODO: hier moet eeen overzicht komen van de gegevens van de gebruiker vanuit de database</p>
<p>zodat er gegevens aangepast kunnen worden</p>

<?php
// Show all users from DB
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo $row['username']."\t" ,$row['email']."<br>";
        }
    }

    

?>

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