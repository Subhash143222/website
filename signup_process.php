<?php
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

    $sql = "INSERT INTO signupnew (Roll_no, password) VALUES ('$Roll_no', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, wait for 1 second and then redirect
        echo "Registration successful";
        echo '<script>
                setTimeout(function(){
                    window.location.href = "index2.php";
                }, 1000);
              </script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
