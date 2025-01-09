<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 1: Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    // Step 2: Hash the password before storing
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Step 3: Prepare SQL query to insert the user
    $sql = "INSERT INTO users (user_id, password_hash) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user_id, $password_hash);
    
    // Step 4: Execute the query and check for success
    if ($stmt->execute()) {
        echo "User registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!-- HTML form to register users -->
<form method="POST" action="register.php">
    <label for="user_id">User ID:</label>
    <input type="text" name="user_id" required><br><br>
    <label for="password">Password:</label>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Register">
</form>
