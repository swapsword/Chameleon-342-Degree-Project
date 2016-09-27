<?php
session_start(); // Starting Session
$username = 'admin';
$password = 'admin';
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) && empty($_POST['password'])) {
        // error message if username/password fields are empty
        echo '<div class="ui error message">
                        <i class="close icon"></i>
                        <div class="header">Please enter Username/Password</div>
                        <ul class="list">
                            <li>Username & Password field are empty.</li>
                        </ul>
                     </div>';
    } else {
        if ($username != $_POST['username'] || $password != $_POST['password']){// Define $username and $password
            echo '<div class="ui error message">
                        <i class="close icon"></i>
                        <div class="header">Username/Password are invalid</div>
                        <ul class="list">
                            <li>Please enter valid Username & Password.</li>
                        </ul>
                     </div>';
        } else {
            // Set session variables
            $_SESSION["username"] = $_POST['username'];
            $_SESSION["password"] = $_POST['password'];
            //redirecting to admin panel (login successful)
            header('Location: http://localhost/includes/admin-inside.php/');
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <!-- Meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?php include 'includes/logo.php';?>
    <title>Chameleon-342</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <!-- Load CSS -->
    <link rel="stylesheet" type="text/css" href="/semantic/out/semantic.min.css">
    <link href="css/admin.css?<?php time();?>" rel="stylesheet" type="text/css" />
    <!-- Load Fonts -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold" type="text/css" />
    <!-- Load jQuery library -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <!-- Load custom js -->
    <script type="text/javascript" src="/js/custom.js<?php time();?>"></script>
    <script src="/semantic/out/semantic.min.js"></script>
</head>
<script type="text/javascript">
    $(document).ready(function() {
        $(".close.icon").click(function(){
            $(this).parent().hide();
        });
        });
</script>
<body>
    <div>
        <div id="main">
            <a href="http://cisco.com" class="ui large image">
                <img src="images/cisco_logo.png">
            </a>
            <!-- Main Input -->
            <h1>@Admin login Panel(only for admin):</h1>
            <form class="ui form" method="POST" name="login-form" action="">
                <div class=" required field">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="username">
                </div>
                <div class=" required field">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="password">
                </div>
                <button class="ui button" name="submit" type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
