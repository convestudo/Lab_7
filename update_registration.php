<?php
    include 'Database.php';
    include 'User.php';

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "GET") 
        // Retrieve the matric value from the GET request
        $matric = $_GET['matric'];

        // Process the update using the matric value
        // For example, you can fetch the user data using the matric value and display it in a form for updating
        // Create an instance of the Database class and get the connection
        $database = new Database();
        $db = $database->getConnection();

        $user = new User($db);
        $userDetails = $user->getUser($matric);

        $db->close();

        // Display the update form with the fetched user data
        // Example:
?>