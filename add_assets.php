<?php
include 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {    $asset_id = $_POST["asset_id"];
    $product_details = isset($_POST["product_details"]) ? $_POST["product_details"] : "";
    $category = $_POST["category"];
    $brand = $_POST["brand"];
    $asset_barcode = isset($_POST["asset_barcode"]) ? $_POST["asset_barcode"] : "";
    $asset_image_id = $_POST["asset_image_id"];

  
    $sql = "INSERT INTO assets (`Asset ID`, `Product Name/Asset details`, `Category`, `Brand`, `Asset Barcode`, `Asset Image ID`) 
            VALUES ('$asset_id', '$product_details', '$category', '$brand', '$asset_barcode', '$asset_image_id')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Asset added successfully');</script>";
    } else {
        if ($conn->errno == 1062) {
            echo "<script>alert('Error: Duplicate entry for Asset ID \"$asset_id\". Please use a unique Asset ID.');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Asset</title>
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

        input[type="text"] {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin-bottom: 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 18px;
            border-radius: 8px;
        }

        select {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin-bottom: 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 18px;
            border-radius: 8px;
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
    width: 100%; 
    box-sizing: border-box;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    
    margin-left: auto;
    margin-right: auto;
}


        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Add Asset</h1>
    </header>
    <main>
        <div class="add-container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="asset_id" id="asset_id" placeholder="Enter Asset ID....">
                <input type="text" name="product_details" id="product_details" placeholder="Enter Product Name/Asset details....">
                <div>
                    <label for="category"></label>
                    <select id="category" name="category" onchange="showBrands()">
                        <option value="">Select Category</option>
                        <option value="laptops">Laptops</option>
                        <option value="mice">Mice</option>
                        <option value="printers">Printers</option>
                        <option value="wifi_routers">WiFi Routers</option>
                        <option value="headphones">Headphones</option>
                        <option value="keyboard">Keyboard</option>
                    </select>
                </div>
                <div id="brands" style="display:none;">
                    <label for="brand"></label>
                    <select id="brand" name="brand">
                        <option value="">Select Brand</option>
                    </select>
                </div>
                <input type="text" name="asset_barcode" id="asset_barcode" placeholder="Enter Asset Barcode....">
                <input type="text" name="asset_image_id" placeholder="Enter Asset Image ID....">
                <button type="submit" name="submit">Add Asset</button>
            </form>
        </div>
    </main>

    <script>
        function showBrands() {
            var category = document.getElementById("category").value;
            var brandsDropdown = document.getElementById("brands");
            var brandsSelect = document.getElementById("brand");
            brandsSelect.innerHTML = "<option value=''>Select Brand</option>";
            if (category) {
                brandsDropdown.style.display = "block";
                if (category === "laptops") {
                    addOptions(["HP", "Dell", "Apple", "Lenovo", "RedGear"], brandsSelect);
                } else if (category === "mice") {
                    addOptions(["Logitech", "Razer", "SteelSeries", "Corsair", "Microsoft"], brandsSelect);
                } else if (category === "printers") {
                    addOptions(["HP", "Epson", "Canon", "Brother", "Samsung"], brandsSelect);
                } else if (category === "wifi_routers") {
                    addOptions(["TP-Link", "Netgear", "Linksys", "ASUS", "D-Link"], brandsSelect);
                } else if (category === "headphones") {
                    addOptions(["Sony", "Bose", "Sennheiser", "JBL", "Audio-Technica"], brandsSelect);
                }
            } else {
                brandsDropdown.style.display = "none";
            }
        }

        function addOptions(options, selectElement) {
            options.forEach(function (option) {
                var optionElement = document.createElement("option");
                optionElement.text = option;
                optionElement.value = option;
                selectElement.appendChild(optionElement);
            });
        }
    </script>
</body>
</html>
