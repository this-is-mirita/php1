<?php
require_once(__DIR__ . "/../../controllers/error.php");
require_once(__DIR__ . "/../../Model/dbConnection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim(filter_var($_POST["name"], FILTER_SANITIZE_SPECIAL_CHARS));
    $comm = trim(filter_var($_POST["comment"], FILTER_SANITIZE_SPECIAL_CHARS));

}
$loginCokies = $_COOKIE["user"];
$sql = "SELECT id FROM `users` WHERE login = ?";
/** @var $pdo */
// Подготавливаем запрос
$query = $pdo->prepare($sql);
// выполнение команды
$query->execute([$loginCokies]);
// Получаем данные пользователя
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $user_id = $user['id']; // Получаем ID пользователя
} else {
    exit("Ошибка: Пользователь не найден.");
}


$sql = "INSERT INTO comments_on_index_page (user_id, name, comment) VALUES (?,?,?)";
/** @var $pdo */
// Подготавливаем запрос
$query = $pdo->prepare($sql);
// выполнение команды
$query->execute([$user_id, $name, $comm]);
header("Location: /first-sait/");
