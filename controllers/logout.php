<?php
// При нажатии на кнопку "Выход"
if (isset($_POST['logout'])) {
    // Удаляем куки
    setcookie("user", "", time() - 3600, "/"); // Устанавливаем значение пустым и time в прошлое
    // Здесь также можете удалить другие куки, если они есть
    header("Location: ../index.php"); // Перенаправление на страницу входа
}