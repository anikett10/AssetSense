<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Device</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            width: 50%;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Update Device</h2>
    <?php
    include 'db_conn.php';

    $device_id = $emp_id = $asset_id = "";
    $device_id_err = $emp_id_err = $asset_id_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST["device_id"]))) {
            $device_id_err = "Please enter device ID.";
        } else {
            $device_id = trim($_POST["device_id"]);
        }

        $emp_id = isset($_POST["emp_id"]) ? trim($_POST["emp_id"]) : "";
        $asset_id = isset($_POST["asset_id"]) ? trim($_POST["asset_id"]) : "";

        if (empty($emp_id)) {
            $emp_id_err = "Please enter employee ID.";
        }

        if (empty($asset_id)) {
            $asset_id_err = "Please enter asset ID.";
        }

        if (empty($device_id_err) && empty($emp_id_err) && empty($asset_id_err)) {
            $sql = "UPDATE device SET EmpID=?, `Asset ID`=? WHERE `Device ID`=?";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("sss", $param_emp_id, $param_asset_id, $param_device_id);

                $param_emp_id = $emp_id;
                $param_asset_id = $asset_id;
                $param_device_id = $device_id;

                if ($stmt->execute()) {
                    echo "Device updated successfully.";
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                $stmt->close();
            }
        }

        $conn->close();
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>Device ID</label>
            <input type="text" name="device_id" value="<?php echo $device_id; ?>">
            <span><?php echo $device_id_err; ?></span>
        </div>
        <div>
            <label>Employee ID</label>
            <input type="text" name="emp_id" value="<?php echo $emp_id; ?>">
            <span><?php echo $emp_id_err; ?></span>
        </div>
        <div>
            <label>Asset ID</label>
            <input type="text" name="asset_id" value="<?php echo $asset_id; ?>">
            <span><?php echo $asset_id_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Update">
        </div>
    </form>
</body>
</html>
