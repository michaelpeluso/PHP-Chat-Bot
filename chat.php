<?php
    session_start();
    setcookie("username", $_GET['username']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat Bot</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <style>
        body {
            font-family: 'Nunito Sans', sans-serif;
            margin: 5%;
        }
        
        #singleMessage {
            display: block;
        }
        
        #time, #username, #message, #divider {
            float: left;
            font-size: smaller;
        }
        
        #message {
            font-size: large;
        }
    </style>

</head>
  <body>
    <h1>Chat App</h1>

    <div id="conatiner">
        <div id="chatSend"></div>
        
        <input type="text" id="messageInput" name="message" placeholder="Say something...">
        <button type="submit" id="send">Send & Refresh</button>
        <button type="loginagain" id="loginagain">Back to Log In</button>
        
        <br><br>
        <div id="chat">
            <?php
              
                //Connect to the MySQL database
                $login_file = 'login_info.txt';
                $lines = file($file, FILE_IGNORE_NEW_LINES);
                $con = mysqli_connect($lines[0], $lines[1], $lines[2], $lines[3]);
                if (mysqli_connect_errno()) {
                    echo "<script>alert('Failed to connect to MySQL: ".mysqli_connect_error()."');</script>";
                    return false;
                }
                
                if (isset($_GET['message'])) {
                    if ($_GET['message'] != "") {
                        $query = mysqli_query($con, 'INSERT INTO `ChatBot` (`log ID`, `Username`, `Message`, `Time`) VALUES (NULL, "'.$_SESSION['username'].'", "'.$_GET['message'].'", CURRENT_TIME)');
                        if (!$query) { echo "<script>alert('Failed to find table.');</script>"; }
                    }
                }
                
                
                $log = mysqli_query($con, 'SELECT * FROM `ChatBot`');
                    if (!$log) { echo "<script>alert('Failed to find table.');</script>"; }
                
                    /*
                while ($row = $log->fetch_assoc()) {
                        echo '<div id="singleMessage">';
                            echo '<div id="time">'.substr($row['Time'], 10).'</div>';
                            echo '<div id="divider">&nbsp-&nbsp</div>';
                            echo '<div id="username">'.$row['Username'].'</div>';
                            echo "<br>";
                            echo '<div id="message">'.$row['Message'].'</div>';
                            echo "<br><br>";
                        echo '</div>';
                }*/

                while ($row = $log->fetch_assoc()) {
                    echo '<div id="singleMessage">';
                    echo '<div id="time">'.substr($row['Time'], 10).'</div>';
                    echo '<div id="divider">&nbsp-&nbsp</div>';
                    echo '<div id="username">'.$row['Username'].'</div>';
                    echo "<br>";
                    echo '<div id="message">'.$row['Message'].'</div>';
                    echo "<br><br>";
                    echo '</div>';
                }
        
            ?>
        </div>
        
    </div>

    <script>
    
        //let username = document.URL.substring(65, document.URL.indexOf('&'));
        //console.log(username);
            
        //on button click
        document.getElementById("send").addEventListener('click', function() {
             var string = "chat.php?message=" + document.getElementById("messageInput").value;
            window.open(string, "_self");
        });
        
        document.getElementById("loginagain").addEventListener('click', function() {
            window.open("index.php", "_self");
        });

        function updateChat() {
            $.ajax({
                url: 'get_messages.php',
                success: function(data) {
                    $('#chat').html(data);
                },
                complete: function() {
                    setTimeout(updateChat, 2000);
                }
            });
        }
        
        $(document).ready(function() {
            updateChat();
        });

    </script>
    </body>

</html>


