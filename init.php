<?php
// Инклуды)
use GuzzleHttp\Client;
include('vendor/autoload.php');
include('telegramBot.php');

//Получаем данные
$telegramApi = new TelegramBot();

// Вычный цикл, обработчик
while (true) {
sleep(2);
$updates = $telegramApi->getUpdates(); // Получаем обновление, методом getUpdates
foreach ($updates as $update){
if (isset($update->message->text)) { // Проверяем Update, на наличие текста

$text = $update->message->text; // Переменная с текстом сообщения
$chat_id = $update->message->chat->id; // Чат ID пользователя
$first_name = $update->message->chat->first_name; //Имя пользователя
$fd = fopen("/var/www/html/testbot/history/history$chat_id.txt", 'a') or die("не удалось создать файл");
fwrite($fd, $text . PHP_EOL);
fclose($fd);
if ($text == '/start'){ // Если пользователь подключился в первый раз, ему поступит приветствие
$telegramApi->sendMessage($chat_id, 'Привет'. ' ' . $first_name . '!' .'Введите ваш номер телефона'); //Приветствует Пользователя
} else
if (preg_match('/^(8|\+7)?[0-9]{10,10}+$/', $text)) {// Если номер введен правильно
$text1 = substr("$text", -10);
$telegramApi->sendMessage($chat_id, 'УРА!'. ' ' . $first_name . '!' .'Мы готовы к работе'); //Приветствует Пользователя
$fd = fopen("/var/www/html/testbot/Num/7$text1.txt", 'w') or die("не удалось создать файл");
fwrite($fd, $chat_id);
fclose($fd);
}
else
{
if (preg_match('/^(7)?[0-9]{10,10}+$/', $text)) {// Если номер введен правильно
$telegramApi->sendMessage($chat_id, 'УРА!'. ' ' . $first_name . '!' .'Ид'. ' ' . $chat_id . '!' .'Мы готовы к работе'); //Приветствует Пользователя
$fd = fopen("/var/www/html/testbot/Num/$text.txt", 'w') or die("не удалось создать файл");
fwrite($fd, $chat_id);
fclose($fd);
}
else
{

$telegramApi->sendMessage($chat_id, $first_name . '! Введите еще раз' ); // Введите еще раз
}
}
}
}
}
