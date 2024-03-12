<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll_no = $_POST["roll_no"];
    $date = $_POST["date"];
    $status = $_POST["status"];

   
    $servername = "127.0.0.1:3307";
    $username = "root"; 
    $password = "root"; 
    $dbname = "attendancetraking"; 

    
    $conn = new mysqli($servername, $username, $password, $dbname);

   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   
    $sql = "INSERT INTO attendance_table (Roll_no, date, status, Professor_id) VALUES ('$roll_no', '$date', '$status','203')";

    
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
        echo '<meta http-equiv="refresh" content="2;url=index.html">';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>