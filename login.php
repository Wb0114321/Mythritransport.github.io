<?php
// Start the session
session_start();

// Step 1: Connect to MySQL database
$servername = "localhost";  // your MySQL server
$username = "root";         // your MySQL username
$password = "";             // your MySQL password (leave empty for default)
$dbname = "users_db";       // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    // Step 3: Prepare the SQL query to get the hashed password
    $sql = "SELECT password_hash FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($password_hash);
    $stmt->fetch();

    // Step 4: Verify the password
    if ($stmt->num_rows > 0) {
        if (password_verify($password, $password_hash)) {
            // Password is correct, log in the user
            $_SESSION['user_id'] = $user_id;
            
            // Redirect to home_details.php
            header('Location: home_details.php');
            exit();
        } else {
            // Password is incorrect
            echo "Invalid password!";
        }
    } else {
        // Username doesn't exist
        echo "User not found!";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
