<?php
// Инклуды
use GuzzleHttp\Client;
include('vendor/autoload.php');
include('telegramBot.php');

if(isset($_GET['nomer']) && $_GET['nomer'] != ''){
$wqe = $_GET['nomer'];
if(isset($_GET['messag']) && $_GET['messag'] != ''){
$qwe = $_GET['messag'];
//Получаем данные
$telegramApi = new TelegramBot();

$filename = "/var/www/html/testbot/Num/$wqe.txt";
if (file_exists($filename)) {
	$chat_id = file($filename);
       	$chat_id[0] = str_replace('\n', '', $chat_id[0]);
	$telegramApi->sendMessage($chat_id[0], 'Вам пришло сообщение: ' . $qwe); //Приветствует Пользователя
	echo " messag nomeru: ", $wqe, " otpravlena";
	echo "\ntext message: ", $qwe;
} else {
	echo " nomera: ", $wqe, " net", " message: ", $qwe, " ne otpravleno";
}
} else {
echo "vvedite messag";
}
} else 
{
echo "pusto";
}


