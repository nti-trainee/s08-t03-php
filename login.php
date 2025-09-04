<?php

session_start();

include "./connect/db.php";

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("Location: index.php");
        exit(); 

    } else {

        $message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <h1>Login to Your Account</h1>

    <?php if (!empty($message)): ?>
        <div>
            <p style="color: red;"><?php echo $message; ?></p>
        </div>
    <?php endif; ?>

    <form method="post">
        <label for="username">Username:</label>
        <br>
        <input type="text" id="username" name="username" required>
        <br><br>

        <label for="password">Password:</label>
        <br>
        <input type="password" id="password" name="password" required>
        <br><br>

        <button type="submit">Login</button>
    </form>

    <br>
    <form action="register.php" method="get">
        <button type="submit">Register</button>
    </form>

</body>
</html>
