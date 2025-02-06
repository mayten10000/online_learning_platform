<?php
session_start();

// Если пользователь авторизован, перенаправляем его в личный кабинет
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
} else {
    // Если не авторизован, отправляем на гостевую страницу
    header("Location: guest.php");
}
exit();
?>
