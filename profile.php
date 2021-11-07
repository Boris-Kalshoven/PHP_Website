<?php 
require('dbconnection.php');
include('auth_session.php');
?>
<!-- Get the header file -->
<?php echo file_get_contents("html/header.html"); ?>

<!-- Get the body file -->
<?php echo file_get_contents("html/profileBody.html"); ?>

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