<?php

session_start();
require_once 'functions.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    $result = queryMysql("SELECT * FROM members WHERE user='$user'");

    if ($result->num_rows) {
        $row = $result->fetch_assoc();

        if (password_verify($pass, $row['password'])) {
            $_SESSION['user'] = $user;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<form method="post">
    <label>Username:</label>
    <input type="text" name="user" required>

    <label>Password:</label>
    <input type="password" name="pass" required>

    <button type="submit">Login</button>
</form>
<p><?php echo $error; ?></p>

