<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Assets</title>
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
        <h1>Asset Search</h1>
    </header>
    <main>
        <div class="search-container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="asset_id" placeholder="Enter Asset ID....">
                <button type="submit">Search</button>
            </form>
        </div>

        <?php
        include 'db_conn.php';

        $searchResult = ""; 

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $asset_id = $_POST["asset_id"];

            $sql = "SELECT * FROM assets WHERE `Asset ID` = '$asset_id'";

            if ($result = $conn->query($sql)) {
                if ($result->num_rows > 0) {
             
                    $searchResult .= "<table>";
                    $searchResult .= "<tr><th>Asset ID</th><th>Product Name/Asset details</th><th>Category</th><th>Brand</th><th>Asset Barcode</th><th>Asset Image ID</th></tr>";

                    while ($row = $result->fetch_assoc()) {
                        $searchResult .= "<tr>";
                   
                        $searchResult .= "<td>" . (isset($row['Asset ID']) ? $row['Asset ID'] : 'N/A') . "</td>";
                        $searchResult .= "<td>" . (isset($row['Product Name/Asset details']) ? $row['Product Name/Asset details'] : 'N/A') . "</td>";
                        $searchResult .= "<td>" . (isset($row['Category']) ? $row['Category'] : 'N/A') . "</td>";
                        $searchResult .= "<td>" . (isset($row['Brand']) ? $row['Brand'] : 'N/A') . "</td>";
                        $searchResult .= "<td>" . (isset($row['Asset Barcode']) ? $row['Asset Barcode'] : 'N/A') . "</td>";
                        $searchResult .= "<td>" . (isset($row['Asset Image ID']) ? $row['Asset Image ID'] : 'N/A') . "</td>";
                        $searchResult .= "</tr>";
                    }

                    $searchResult .= "</table>";
                } else {
                   
                    echo "<script>alert('No assets found');</script>";
                }
                $result->free(); 
            } else {
                $searchResult = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        ?>

        <div class="result-container">
            <?php echo $searchResult; ?>
        </div>
    </main>
</body>
</html>
