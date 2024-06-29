<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Inventory</title>
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

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        main {
            padding: 20px;
        }

        .filter-container {
            text-align: center;
            margin-bottom: 20px;
        }

        select {
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>View Inventory</h1>
    </header>
    <main>
        <div class="filter-container">
            <label for="category">Filter by Category:</label>
            <select name="category" id="category" onchange="filterInventory()">
                <option value="">All Categories</option>
                <?php
             
                include 'db_conn.php';

         
                $sql = "SELECT DISTINCT `Category` FROM assets";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["Category"] . "'>" . $row["Category"] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Asset Barcode</th>
                    <th>Asset ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Asset Image ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM assets";

                if (isset($_GET['category']) && $_GET['category'] !== "") {
                    $category = $_GET['category'];
                    $sql .= " WHERE `Category` = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $category);
                    $stmt->execute();
                    $result = $stmt->get_result();
                } else {
                    $result = $conn->query($sql);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Asset Barcode"] . "</td>";
                        echo "<td>" . $row["Asset ID"] . "</td>";
                        echo "<td>" . $row["Product Name/Asset details"] . "</td>";
                        echo "<td>" . $row["Category"] . "</td>";
                        echo "<td>" . $row["Brand"] . "</td>";
                        echo "<td>" . $row["Asset Image ID"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No inventory data available</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </main>

    <script>
        function filterInventory() {
            var category = document.getElementById("category").value;
            if (category === "") {
                window.location.href = 'view_inventory.php'; 
            } else {
                window.location.href = 'view_inventory.php?category=' + encodeURIComponent(category);
            }
        }
    </script>
</body>
</html>
