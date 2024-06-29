<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_conn.php';

    $empID = $_POST['empID'];
    $assetID = $_POST['assetID'];

    if (!empty($empID) && !empty($assetID)) {
        $checkEmpQuery = "SELECT * FROM employee WHERE EmpID = '$empID'";
        $resultEmp = $conn->query($checkEmpQuery);

        $checkAssetQuery = "SELECT * FROM assets WHERE `Asset ID` = '$assetID' AND `Asset ID` NOT IN (SELECT `Asset ID` FROM device)";
        $resultAsset = $conn->query($checkAssetQuery);

        if ($resultEmp->num_rows > 0 && $resultAsset->num_rows > 0) {
            $prefix = 'D';
            $query = "SELECT MAX(CAST(SUBSTRING_INDEX(`Device ID`, 'D', -1) AS UNSIGNED)) AS max_id FROM device";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $max_id = ($row['max_id']) ? $row['max_id'] + 1 : 1;
            $deviceID = $prefix . str_pad($max_id, 3, '0', STR_PAD_LEFT); 

            $sql = "INSERT INTO device (`Device ID`, EmpID, `Asset ID`) VALUES ('$deviceID', '$empID', '$assetID')";

            if ($conn->query($sql) === TRUE) {
                echo "Asset assigned successfully. Device ID: $deviceID";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Employee ID does not exist or Asset is already assigned.";
        }
    } else {
        echo "Both Employee ID and Asset ID are required.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Assets</title>
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

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 18px;
            margin-bottom: 10px;
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

        .notification {
            color: #f44336; /* Red */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #f44336;
            border-radius: 8px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <header>
        <h1>Asset Assign to Employee</h1>
    </header>
    <main>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="empID">Employee ID:</label>
            <input type="text" name="empID" id="empID">
            <br>
            <label for="assetID">Asset ID:</label>
            <input type="text" name="assetID" id="assetID">
            <br>
            <button type="submit">Assign Asset</button>
        </form>
    </main>
</body>
</html>
