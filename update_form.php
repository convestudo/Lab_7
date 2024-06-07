<?php
include 'Database.php';
include 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['matric'])) {
        $matric = $_GET['matric'];

        $database = new Database();
        $db = $database->getConnection();

        $user = new User($db);
        $userDetails = $user->getUser($matric);
        $db = null;
    } else {
        echo "Matric number is missing.";
        exit;
    }
} else {
    echo "Invalid request method.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .cancel-button {
            background-color: #0000FF;
            color: white;
            padding: 10px 40px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            display: inline-block;
            margin-top: 10px;
        }

        .cancel-button:hover {
            background-color: #0000FF;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>

</head>

<body>
    <form action="update.php" method="post">
        <input type="hidden" name="matric" value="<?php echo $userDetails['matric']; ?>"><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $userDetails['name']; ?>"><br>
        <br><label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="">Please select</option>
            <option value="Lecturer" <?php if ($userDetails['role'] == 'Lecturer') echo "selected"; ?>>Lecturer</option>
            <option value="Student" <?php if ($userDetails['role'] == 'Student') echo "selected"; ?>>Student</option>
        </select><br>
        <br><input type="submit" value="Update"><a href="read.php"><br><br>Cancel</a>
    </form>
</body>

</html>