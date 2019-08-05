Тестовое задание на вакансию backend разработчика. Время выполения ~ 4-6 часов

Написать простой web-сервис обмена микросообщениями.

Сервис состоит из трех компонентов:
* web-сервер
* SQL БД (желательно postgresql)
* 3 клиента (первый пишет сообщения, второй отображает их в реальном времени, третий позволяет просмотреть список сообщений за последнюю минуту)

Все три клиентские части можно реализовать как отдельными web-приложениями, так и одним c разделение клиентов по url (как удобнее)

Каждое сообщение состоит из текста до 128 символов, метки даты/времени (устанавливается на сервере) и порядкового номера (приходит от клиента)

Схема работы системы следующая: 
* первый клиент пишет потоком произвольные (по контенту) сообщения в сервис (на одно сообщение один вызов к API)
* сервис обрабатывает каждое сообщение, записывает его в базу и перенаправляет его второму клиенту по веб-сокету
* второй клиент при считывает по веб-сокету поток сообщений от сервера и отображает их в порядке прихода с сервера (с отображением метки времени и порядкового номера)
* через третий клиент пользователь может отобразить историю сообщений за последние 10 минут

Дизайн не важен, т.к. это задание по большей части по backend-разработке. 
Главное, чтобы сообщения отображались и их можно было прочитать.
Клиентские приложения(е) - это по сути тестовые утилиты, которые должен уметь писать backend-разработчик.

Серверная часть имеет REST или GraphQL (на выбор) API c 2 методами:
* отправить одно сообщение
* получить список сообщений за диапозон дат

Желателено, сгенерить swagger-документацию (для REST-api).

Перечень языков для разработки: Php, Python, Go, C#
Архитектурные требования: 
* MVC или подобная
* Слой DAL без использования ORM
* Ведение логов, чтобы по ним можно было понять текущее состояние работы приложения (детальность логов на свое усмотрение, при этом качество логирования является одним из критериев оценки выполненного тестового задания)

Приложение нужно оформить в виде docker-образов и выложить на docker-hub.
Оформить docker-compose файл, при запуске которого стартуют все компоненты системы


