<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat Bot</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script>
    
        function login() {
            if ($("#name").val() == "") {
                alert("Please complete the form below.");
            }
            else {
                window.open("index.php?username=" + $("#name").val(), "_self");
            }
        }
        
    </script>
    
    <style>
        body {
            font-family: 'Nunito Sans', sans-serif;
            margin: 5%;
        }
    </style>

</head>
<body class="indexClass">

    <div id="container">
    
        <h1>Join the Chat</h1>
        
        <p id="input">Username</p>
        <input type="text" id="name">
        
        <br><br>
        <input type="button" id="login" value="Log In" onclick="login()">
        
    </div>
    
    <?php
    
        //on button press
        if ($_GET['username'] != "") {
        
        $_COOKIE['username'] = $_GET['username'];
        $_SESSION['username'] = $_GET['username'];
            
            //connect to database
            $con = mysqli_connect("sql1.njit.edu", "mp272","Infiniti2004!","mp272");
            if (mysqli_connect_errno()) {
                echo "<script>alert('Failed to connect to MySQL: ".mysqli_connect_error()."');</script>";
                return false;
            }
        
            //add to table
            $query = mysqli_query($con, 'INSERT INTO `ChatBot` (`log ID`, `Username`, `Message`, `Time`) VALUES (NULL, "'.$_GET['username'].'", "'.$_GET['username'].' joined the chat.", CURRENT_TIME)');
            echo "<script>alert('Sign Up successful. Username: ".$_GET['username']."');</script>";
            
            header("Location:chat.php?username=".$_GET['username']);
            exit();
            
        }
    ?>
    
    
    
</body>
</html>




