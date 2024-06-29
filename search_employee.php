<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Employee</title>
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

        h1 {
            margin: 0;
        }

        main {
            text-align: center;
            padding: 20px;
        }

        .search-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"] {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 60%;
            border: 0;
            margin-bottom: 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 18px;
            border-radius: 8px;
        }

        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        button {
            background-color: #333;
            border: none;
            color: white;
            padding: 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            transition-duration: 0.4s;
            border-radius: 8px;
            width: 30%;
            box-sizing: border-box;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<header>
    <h1>Search Employee</h1>
</header>
<main>
    <div class="search-container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="employee_id" placeholder="Enter Employee ID">
            <button type="submit">Search</button>
        </form>
    </div>

    <?php
    include 'db_conn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $employee_id = $_POST["employee_id"];

        $sql = "SELECT * FROM employee WHERE `EmpID` = '$employee_id'";

     
        if ($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Employee ID</th><th>Employee Name</th><th>Contact Number</th><th>Company ID</th><th>Assigned Date</th><th>Department</th><th>Age</th></tr>";
                while ($row = $result->fetch_assoc()) {
                   
                    echo "<tr>";
                    echo "<td>" . $row["EmpID"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["Contact Details"] . "</td>";
                    echo "<td>" . $row["Company ID"] . "</td>";
                    echo "<td>" . $row["Assigned Date"] . "</td>";
                    echo "<td>" . $row["Department"] . "</td>";
                    echo "<td>" . $row["Age"] . "</td>";
                    echo "</tr>";
                    
                }
                echo "</table>";
            } else {
                echo "<script>alert('No Employee found');</script>"; 
            }
            $result->free(); 
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</main>
</body>
</html>
