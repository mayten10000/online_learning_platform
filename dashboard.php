<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: guest.php"); // Если нет сессии, отправляем на страницу гостей
    exit();
}

$user = $_SESSION['user']; // Получаем имя пользователя
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">LearnMatch</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<header class="hero">
    <div class="container text-center">
        <h1>Welcome, <?php echo htmlspecialchars($user); ?>!</h1>
        <p>Explore new courses and continue your learning journey.</p>
        <a href="courses.php" class="btn btn-light btn-lg btn-custom">Browse Courses</a>
    </div>
</header>

<footer class="footer">
    <p>&copy; 2025 LearnMatch. All rights reserved.</p>
</footer>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
