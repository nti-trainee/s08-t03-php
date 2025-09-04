<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    die("You are not logged in. Please <a href='login.php'>login</a> to continue.");
}

include "./connect/db.php";

$message = '';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {

    $new_username = $_POST['username'];

    $sql = "UPDATE users SET username = '$new_username' WHERE id = $user_id";

    if (mysqli_query($conn, $sql)) {

        $_SESSION['username'] = $new_username;
        $message = "Username updated successfully!";
    } else {

        $message = "Error updating username: " . mysqli_error($conn);
    }
}

$sql_select = "SELECT username FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql_select);
$user = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
</head>
<body>

    <h1>Update Your Profile</h1>

    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>!</p>

    <?php if (!empty($message)): ?>
        <p><strong><?php echo $message; ?></strong></p>
    <?php endif; ?>

    <form method="post">
        <label for="username">New Username:</label>
        <br>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        <br><br>
        <button type="submit">Update Username</button>
    </form>

    <hr>

    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

</body>
</html>
