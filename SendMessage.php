<?php

include_once 'main.php';

if (!empty($_GET) && isset($_GET['text'])) {
    $text = $_GET['text'];
    $num = isset($_GET['num']) ? $_GET['num'] : 0;

    if (Model_Message::PutMessage($text, $num)) {
        Controller_Socket::notify($text);
        $answer['type'] = 'success';
        $answer['text'] = 'Сообщение успешно доставлено';
    }
    else {
        $answer['type'] = 'danger';
        $answer['text'] = 'Ошибка обращения к базе данных';
    }
}
else {
    $answer['type'] = 'error';
    $answer['text'] = 'Не указан текст сообщения';
}

echo json_encode($answer);
