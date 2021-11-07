<!-- Get the login file -->
<!-- <?php echo file_get_contents("html/login.html"); ?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <title>Login</title>
</head>

<body id="loginBody">
    <?php
    require('dbconnection.php');
    session_start();
    // When form submitted, check and create user session
    if (isset($_POST['username'])) {
        $username = stripcslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripcslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        // Check if user exists in database
        $query = "SELECT * FROM 'users' WHERE username='$username' AND password='" . md5($password) . "'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect user to user Index page.
            header("Location: index.php");
        } else {
            echo
            "<div class='form'>
             <h3>Incorrect Username/Password</h3></br>
             <p class='link'>Click here to<a href='login.php'>Login</a> again.</p>
             </div>'";
        }
    } else {
    ?>
    
    <form
          name="f1"
          action="authentication.php"
          onsubmit="return validation()"
          method="post"
        >
          <p>
            <label id="lblUsername">Username: </label>
            <input type="text" id="user" name="user"required title="Je weet het vast wel ;)"
              oninvalid="this.setCustomValidity('Vul ff in joh ^^')"
              onchange="this.setCustomValidity('')"/>
          </p>
          <p>
            <label id="lblPassword">Password: </label>
            <input type="password" id="pass" name="pass" required title="Deze is lastiger hea, al die keepass achtige applicaties tegenwoordig."
              oninvalid="this.setCustomValidity('Vergeet je deze ook niet? ^^')"
              onchange="this.setCustomValidity('')"/>
          </p>
          <p id="loginBtn">
            <input type="submit" id="btn" value="Login" />
          </p>
        <p class="link"><a href="registration.php">New Registration</a></p>
   </form>
   <script>
    function validation() {
      // get the value from the form to validate
      var un = document.f1.user.value;
      var pw = document.f1.pass.value;

      if (un.length == "" && pw.length == "") {
        alert("Username and password are empty.");
        return false;
      } else {
        if (un.length == "") {
          alert("Username is empty");
          return false;
        }
        if (pw.length == "") {
          alert("Password is empty");
          return false;
        }
      }
    }
  </script>
    <?php
    }
    ?>
</body>

</html>