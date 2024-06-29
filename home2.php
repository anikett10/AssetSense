<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Screen</title>
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
            padding: 20px;
        }

        .button-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            justify-items: center;
            padding: 20px;
        }

        button {
            background-color: #333;
            border: none;
            color: white;
            padding: 40px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 20px;
            cursor: pointer;
            transition-duration: 0.4s;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        button:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            .button-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .button-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<header>
    <h1>Asset Inventory Management</h1>
</header>
<main>
    <div class="button-container">
        <button onclick="window.location.href='search_assets.php'">Search Assets</button>
        <button onclick="location.href='add_assets.php'">Add Assets</button>
        <button onclick="location.href='delete_asset.php'">Delete Assets</button>
        <button onclick="location.href='view_inventory.php'">View Inventory</button>
        <button onclick="location.href='add_employee.php'">Add Employee</button>
        <button onclick="location.href='search_employee.php'">Search Employee</button>
        <button onclick="location.href='delete_employee.php'">Delete Employee</button>
        <button onclick="location.href='view_employee.php'">View Employees</button>
        <button onclick="location.href='asset_alloc.php'">View Asset Allocation</button>
        <button onclick="location.href='assign_asset.php'">Assign Assets</button>
        <button onclick="location.href='analysis.php'">View Data Analysis</button>
    </div>
</main>
</body>
</html>
