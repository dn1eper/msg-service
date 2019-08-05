--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `message_id`  INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `number`      INT(10) NOT NULL,
  `text`        VARCHAR(128) NOT NULL,
  `date`        DATETIME NOT NULL
)