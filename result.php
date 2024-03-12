<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Result</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-top: 50px;
}

h2, h3 {
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

    </style>
</head>
<body>

    <div class="container">
        <h2>Attendance Result</h2>

        <?php
        session_start();

       
        if (isset($_SESSION["data_201"]) && !empty($_SESSION["data_201"])) {
            echo "<h3>Professor_id='201' Data:</h3>";
            echo "<table>";
            echo "<tr><th>Date</th><th>Status</th></tr>";
            foreach ($_SESSION["data_201"] as $row) {
                echo "<tr><td>{$row['date']}</td><td>{$row['status']}</td></tr>";
            }
            echo "</table>";
        }

        if (isset($_SESSION["data_202"]) && !empty($_SESSION["data_202"])) {
            echo "<h3>Professor_id='202' Data:</h3>";
            echo "<table>";
            echo "<tr><th>Date</th><th>Status</th></tr>";
            foreach ($_SESSION["data_202"] as $row) {
                echo "<tr><td>{$row['date']}</td><td>{$row['status']}</td></tr>";
            }
            echo "</table>";
        }
        session_unset();
        session_destroy();
        ?>

        <p><a href="index.php">Go back to the main page</a></p>
    </div>

</body>
</html>
