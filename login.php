<?php
session_start();

$servername = "127.0.0.1:3307";
$username = "root";
$password = "root";
$dbname = "attendancetraking";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Roll_no = $_POST["Roll_no"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM signupnew WHERE Roll_no = '$Roll_no' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Authentication successful
        $_SESSION["Roll_no"] = $Roll_no;
        
        // Redirect to retrieve.php
        header("Location: retrieve.php");
        exit();
    } else {
        // Authentication failed
        echo "Invalid Roll Number or Password";
    }
}

$conn->close();
?>
