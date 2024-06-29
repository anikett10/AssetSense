<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee</title>
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

        p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"] {
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
    <h1>Delete Employee</h1>
</header>
<main>
    <form method="post" id="deleteForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p>Enter the Admin Password:</p>
        <input type="password" id="password" placeholder="Admin Password" name="password" />
        <p>Enter the Employee ID you want to delete:</p>
        <input type="text" id="employeeId" name="employee_id" placeholder="Employee ID....">
    </form>
            <button type="button" onclick="confirmDelete()">Delete Employee</button>

</main>

<?php
include 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['password'])) {
        $password = $_POST['password'];

        if ($password === 'Aniket12345') { 
            if (isset($_POST['employee_id'])) {
                $employee_id = $_POST["employee_id"];

                $check_sql = "SELECT * FROM employee WHERE `EmpID` = '$employee_id'";
                $check_result = $conn->query($check_sql);

                if ($check_result->num_rows > 0) {
                    $sql = "DELETE FROM employee WHERE `EmpID` = '$employee_id'";
                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Employee deleted successfully');</script>"; 
                    } else {
                        echo "<script>alert('Error deleting employee: " . $conn->error . "');</script>"; 
                    }
                } else {
                    echo "<script>alert('No employee found with ID: $employee_id');</script>"; 
                }
            } else {
                echo "<script>alert('Please enter the Employee ID.');</script>"; 
            }
        } else {
            echo '<script>alert("Invalid password. Please try again.");</script>'; 
        }
    }
}
?>

<script>
    
    function confirmDelete() {
        var password = document.getElementById("password").value;
        var employeeId = document.getElementById("employeeId").value;
        if (password.trim() !== "") {
            if (employeeId.trim() !== "") {
                var confirmMessage = "Are you sure you want to delete employee with ID: " + employeeId + "?";
                if (confirm(confirmMessage)) {

                    document.getElementById("deleteForm").submit();
                }
            } else {
                alert("Please enter the Employee ID.");
            }
        } else {
            alert("Please enter the Admin Password.");
        }
    }
</script>
</body>
</html>
