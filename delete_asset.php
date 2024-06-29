<?php
include 'db_conn.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the password form is submitted
    if (isset($_POST['password'])) {
        // Get the entered password
        $password = $_POST['password'];

        // Dummy authentication logic (replace with your actual authentication logic)
        if ($password === 'Aniket12345') { // Change the password here
            // Proceed with asset deletion if Asset ID is provided
            if (isset($_POST['asset_id'])) {
                // Process form submission
                $asset_id = $_POST["asset_id"];

                // Check if the asset exists before deleting
                $check_sql = "SELECT * FROM assets WHERE `Asset ID` = '$asset_id'";
                $check_result = $conn->query($check_sql);

                if ($check_result->num_rows > 0) {
                    // Asset exists, proceed with deletion
                    $sql = "DELETE FROM assets WHERE `Asset ID` = '$asset_id'";
                    // Execute SQL query using your database connection
                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Asset deleted successfully');</script>"; // Alert notification
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "<script>alert('No asset found with ID: $asset_id');</script>"; // Alert notification for no asset found
                }
            } else {
                echo "<script>alert('Please enter the Asset ID.');</script>"; // Alert notification for missing Asset ID
            }
        } else {
            echo '<script>alert("Invalid password. Please try again.");</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Asset</title>
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
    <h1>Delete Asset</h1>
</header>
<main>
    <form id="deleteForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p>Enter the Admin Password:</p>
        <input type="password" id="password" placeholder="Admin Password" name="password" />
        <p>Enter the Asset ID you want to delete:</p>
        <input type="text" id="asset_id" name="asset_id" placeholder="Asset ID....">
    </form>
            <button type="button" onclick="confirmDelete()">Delete Asset</button>

</main>
<script>
    function confirmDelete() {
        var password = document.getElementById("password").value;
        var assetId = document.getElementById("asset_id").value;
        if (password.trim() !== "") {
            if (assetId.trim() !== "") {
                var confirmMessage = "Are you sure you want to delete asset with ID: " + assetId + "?";
                if (confirm(confirmMessage)) {
                    document.getElementById("deleteForm").submit();
                }
            } else {
                alert("Please enter the Asset ID.");
            }
        } else {
            alert("Please enter the Admin Password.");
        }
    }
</script>
</body>
</html>
