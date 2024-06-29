<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
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

        .add-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"],
        input[type="date"],
        select {
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

        select {
            text-align: left;
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
            margin-top: 10px;
            cursor: pointer;
            transition-duration: 0.4s;
            border-radius: 8px;
            width: 30%;
            box-sizing: border-box;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
            margin-left: auto;
            margin-right: auto;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 20px;
        }

        .success {
            color: green;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<header>
    <h1>Add Employee</h1>
</header>
<main>
    <div class="add-container">
        <?php
        include 'db_conn.php';
        $error_message = "";
        $success_message = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $employee_id = $_POST["employee_id"];
            $email = $_POST["email"];
            $employee_name = $_POST["employee_name"];
            $contact_number = $_POST["contact_number"];
            $company_id = $_POST["company_id"];
            $assigned_date = date('Y-m-d', strtotime($_POST["assigned_date"])); // Format date as yyyy-mm-dd
            $department = $_POST["department"];
            $age = $_POST["age"];

            $stmt = $conn->prepare("CALL VerifyCompanyID(?, ?)");
            $stmt->bind_param("ss", $employee_id, $company_id);

            if (!$stmt->execute()) {
                $error_message = "Error: Invalid Company ID format. It must contain 'EDR' followed by 3 digits.";
            } else {
                $check_sql = "SELECT * FROM employee WHERE `EmpID` = '$employee_id'";
                $check_result = $conn->query($check_sql);

                if ($check_result->num_rows > 0) {
                    $error_message = "Employee ID already exists.";
                } else {
                    $sql = "INSERT INTO employee (`EmpID`, `username`, `Emp Name`, `Contact Details`, `Company ID`, `Assigned Date`, `Department`, `Age`) 
                            VALUES ('$employee_id', '$email', '$employee_name', '$contact_number','$company_id', '$assigned_date', '$department', '$age')";

                    if ($conn->query($sql) === TRUE) {
                        $success_message = "Employee added successfully.";
                    } else {
                        $error_message = "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }

            $stmt->close();
        }
        ?>
        
        

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="employee_id" placeholder="Employee ID" required>
            <input type="text" name="email" placeholder="Enter Email" required>
            <input type="text" name="employee_name" placeholder="Employee Name" required>
            <input type="text" name="contact_number" placeholder="Contact Number" required>
            <input type="text" name="company_id" placeholder="Company ID" required>
            <input type="date" name="assigned_date" placeholder="Assigned Date" required>
            <select name="department" required>
                <option value="">Select Department</option>
                <option value="Research & development">Research & Development</option>
                <option value="sales">Sales</option>
                <option value="Human Resources">Human Resources</option>
            </select>
            <input type="text" name="age" placeholder="Age">
            <button type="submit">Add Employee</button>
        </form>
    </div>
</main>
</body>
</html>
