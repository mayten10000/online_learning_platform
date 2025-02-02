<?php
header('Content-Type: application/json');

$hn = 'MySQL-8.0';  // Имя хоста
$un = 'root';       // Имя пользователя для подключения
$pw = '';           // Пароль пользователя
$db = 'learning_platform';  // Название базы данных

// Подключение к базе данных
try {
    $pdo = new PDO("mysql:host=$hn;dbname=$db", $un, $pw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit();
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

// Проверка на пустые поля
if (empty($name) || empty($email) || empty($password) || empty($role)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit();
}

// Хеширование пароля
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

try {
    // Вставка данных в таблицу
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $hashedPassword, $role]);

    // Ответ о успешной регистрации
    header("Location: index.html");} catch (PDOException $e) {
    // Обработка ошибки, если email уже существует
    if ($e->getCode() == 23000) {
        echo json_encode(['success' => false, 'message' => 'Email already exists.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'An unexpected error occurred: ' . $e->getMessage()]);
    }
}
?>

