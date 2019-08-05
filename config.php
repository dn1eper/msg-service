<?php
# Настройки БД
define('HOST', "localhost");
define('USER', "root");
define('PASS', "");
define('DB',   "chat_service");

# Определение путей
define('DIR',  pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_DIRNAME) . '/');
define('LOG',  DIR . 'Log/');

# Сокет
define('SOCKET_PORT', 8888);