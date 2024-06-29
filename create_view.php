<?php
include 'db_conn.php';


function createOrReplaceView($conn, $department) {
    
    $sql = "CREATE OR REPLACE VIEW employees_view AS 
            SELECT * FROM employee";

    if (!empty($department)) {
      
        $sql .= " WHERE `Department` = '$department'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "View created or replaced successfully";
    } else {
        echo "Error creating or replacing view: " . $conn->error;
    }
}

if (isset($_GET['department'])) {
    $department = $_GET['department'];
    createOrReplaceView($conn, $department);
} else {
  
    createOrReplaceView($conn, null);
}

$conn->close();
?>
