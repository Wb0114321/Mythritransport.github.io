<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Home</title>
</head>
<body>

    <h2>Welcome to Mythri Infrastructure Mining India Pvt Ltd</h2>
    <p>You are logged in as <?php echo $_SESSION['user_id']; ?>.</p>
    <a href="logout.php">Logout</a>

</body>
</html>
