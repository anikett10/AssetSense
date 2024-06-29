<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employees</title>
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
    </style>
</head>
<body>
    <header>
        <h2>Employee List</h2>
    </header>
    <div class="filter-container">
        <label for="department">Filter by Department:</label>
        <select name="department" id="department" onchange="filterEmployees()">
            <option value="">All Departments</option>
            <option value="Research &amp; Development">Research &amp; Development</option>
            <option value="Sales">Sales</option>
            <option value="Human Resources">Human Resources</option>
        </select>
    </div>
    <table id="employeeTable">
        <tr>
            <th>Employee ID</th>
            <th>Email</th>
            <th>Employee Name</th>
            <th>Contact Number</th>
            <th>Company ID</th>
            <th>Assigned Date</th>
            <th>Department</th>
            <th>Age</th>
        </tr>
        <?php
        include 'db_conn.php';

        $sql = "SELECT * FROM employee";

        if (isset($_GET['department'])) {
            $department = $_GET['department'];
            if (!empty($department)) {
                $sql .= " WHERE `Department` = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $department);
                $stmt->execute();
                $result = $stmt->get_result();
            }
        } else {
            $result = $conn->query($sql);
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["EmpID"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["Emp Name"] . "</td>";
                echo "<td>" . $row["Contact Details"] . "</td>";
                echo "<td>" . $row["Company ID"] . "</td>";
                echo "<td>" . $row["Assigned Date"] . "</td>";
                echo "<td>" . $row["Department"] . "</td>";
                echo "<td>" . $row["Age"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>

    <script>
        function filterEmployees() {
            var department = document.getElementById("department").value;
            if (department === "") {
                window.location.href = 'view_employee.php'; 
            } else {
                window.location.href = 'view_employee.php?department=' + encodeURIComponent(department);
            }
        }
    </script>
</body>
</html>
