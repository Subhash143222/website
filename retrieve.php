<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Result</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2, h3 {
            color: #343a40;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #dee2e6;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #ffffff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e0f7fa;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #218838;
        }
        .home-button {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
        }

        .home-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Attendance Result</h2>

        <?php
session_start();

$servername = "127.0.0.1:3307";
$username = "root";
$password = "root";
$dbname = "attendancetraking";

// Check if "Roll_no" is provided in the session
if (isset($_SESSION["Roll_no"])) {
    $Roll_no = $_SESSION["Roll_no"];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $Roll_no = $conn->real_escape_string($Roll_no);

    $professors = [
        '201' => 'Dr Sanjeet kumar nayak',
        '202' => 'Dr Selvajyothi K',
        '203' => 'Dr kashfull Orra',
        '204' => 'Dr N Rino Nelson'
    ];

    $no_records_found = true;

    foreach ($professors as $professor_id => $professor_name) {
        $sql = "SELECT date, status FROM attendance_table WHERE Roll_no = '$Roll_no' AND Professor_id='$professor_id'";
        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                echo "<h3>$professor_name :</h3>";
                echo "<table>";
                echo "<tr><th>Date</th><th>Status</th></tr>";
                $totalDays = 0;
                $presentDays = 0;

                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['date']}</td><td>{$row['status']}</td></tr>";
                    $totalDays++;
                    if ($row['status'] == 'present') {
                        $presentDays++;
                    }
                }

                echo "</table>";
                $attendancePercentage = ($presentDays / $totalDays) * 100;
                echo "<p>Attendance Percentage: $attendancePercentage%</p>";

                $no_records_found = false;
            }
        }
    }

    if ($no_records_found) {
        echo "No records found for Roll number $Roll_no and any of the Professors";
    }

    $conn->close();
} else {
    echo "Roll Number not provided";
}
?>
<a href="index.html" class="home-button">Go back to the home page</a>
</body>
</html>

