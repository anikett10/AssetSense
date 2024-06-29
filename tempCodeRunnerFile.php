<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are set
    if(isset($_POST['username']) && isset($_POST['password'])) {
        // Get the username and password entered by the user
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Dummy authentication logic (replace with your actual authentication logic)
        if ($username === 'Aniket' && $password === 'Aniket12345') {
            // If authentication is successful, redirect to the home screen
            header('Location: home2.php');
            exit;
        } else {
            // If authentication fails, show an error message
            echo '<script>alert("Invalid username or password. Please try again.");</script>';
        }
    }
}
?>