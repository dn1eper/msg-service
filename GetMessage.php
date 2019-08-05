<?php

include_once 'main.php';

$min = 1;
$messages = Model_Message::GetMessages($min);

if ($messages) {
    $answer['type'] = 'success';
    $answer['text'] = $messages;
}
else {
    $answer['type'] = 'danger';

    if (is_array($messages)) {
        $answer['text'] = 'За последние ' . $min . ' минут нет сообщений';
    }
    else {
        $answer['text'] = 'Ошибка обращения к базе данных';
    }
}

echo json_encode($answer);
