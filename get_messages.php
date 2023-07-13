<?php
    // Connect to the MySQL database
    $con = mysqli_connect("sql1.njit.edu", "mp272", "Infiniti2004!", "mp272");
    if (mysqli_connect_errno()) {
        echo "<script>alert('Failed to connect to MySQL: " . mysqli_connect_error() . "');</script>";
        return false;
    }
    
    $log = mysqli_query($con, 'SELECT * FROM `ChatBot`');
    if (!$log) {
        echo "<script>alert('Failed to find table.');</script>";
        return false;
    }
    
    while ($row = $log->fetch_assoc()) {
        echo '<div id="singleMessage">';
        echo '<div id="time">' . substr($row['Time'], 10) . '</div>';
        echo '<div id="divider">&nbsp-&nbsp</div>';
        echo '<div id="username">' . $row['Username'] . '</div>';
        echo "<br>";
        echo '<div id="message">' . $row['Message'] . '</div>';
        echo "<br><br>";
        echo '</div>';
    }
?>
