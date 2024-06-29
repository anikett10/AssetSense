<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Asset Allocation</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        h2 {
            margin: 0;
            padding: 20px 0;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        .filter-container {
            text-align: center;
            margin-top: 20px;
        }

        select {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
        }

        .update-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }

        .update-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h2>Allocation List</h2>
    </header>
  
    <table id="employeeTable">
        <tr>
            <th>Device ID</th>
            <th>EmpID</th>
            <th>Asset ID</th>
            <th>Action</th>
        </tr>
        <?php
        include 'db_conn.php';

        $sql = "SELECT * FROM device";

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . (isset($row["Device ID"]) ? $row["Device ID"] : "") . "</td>";
                echo "<td>" . (isset($row["EmpID"]) ? $row["EmpID"] : "") . "</td>";
                echo "<td>" . (isset($row["Asset ID"]) ? $row["Asset ID"] : "") . "</td>";
                echo "<td><form method='post' action='update_device.php'><input type='hidden' name='device_id' value='" . (isset($row["Device ID"]) ? $row["Device ID"] : "") . "'><button type='submit' class='update-btn'>Update</button></form></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        $conn->close(); 
        ?>
    </table>

    <script>
        function filterEmployees() {
            var department = document.getElementById("department").value;
            if (department === "") {
                window.location.href = 'asset_alloc.php'; 
            } else {
                window.location.href = 'asset_alloc.php?department=' + encodeURIComponent(department);
            }
        }
    </script>
</body>
</html>
