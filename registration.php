<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Registration</title>
    <link rel="stylesheet" href="styles.css" />
</head>

<body id="registrationBody">
    <?php
    require('dbconnection.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($conn, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into users (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($conn, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
    ?>
        <form class="registration-form" action="" method="post">
            <h1 class="login-title">Registration</h1>
            <input type="text" class="registration-input" name="reg-username" placeholder="Username" required />
            <input type="text" class="registration-input" name="reg-email" placeholder="Email Adress">
            <input type="password" class="registration-input" name="reg-password" placeholder="Password">
            <input type="submit" name="reg-submit" value="Register" class="registration-button">
            <p><a href="login.php"><<< Back to Login</a></p>
        </form>
    <?php
    }
    ?>
</body>

</html>