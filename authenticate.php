<?php

include 'Database.php';
include 'User.php';

if (isset($_POST['submit']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    // Create database connection
    $database = new Database();
    $db = $database->getConnection();

    // Sanitize inputs using mysqli_real_escape_string
    $matric = $db->real_escape_string($_POST['matric']);
    $password = $db->real_escape_string($_POST['password']);

    // Validate inputs
    if (!empty($matric) && !empty($password)) {
        $user = new User($db);
        $userDetails = $user->getUser($matric);

        // Check if user exists and verify password
        if ($userDetails && password_verify($password, $userDetails['password'])) 
        {
            echo 'Login Successful';
            echo "<script>setTimeout(\"location.href = 'read.php';\",2000);</script>";
        } else 
        {
            echo 'Invalid username or password, you will be redirect to login page. ';
            echo "<script>setTimeout(\"location.href = 'login.php';\",2000);</script>";
        }
    
    } else 
    {
        echo 'Please fill in all required fields.';
    }
}