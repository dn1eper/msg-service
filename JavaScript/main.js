$(document).ready(function() {
    counter = 0; // счетчик сообщений

    // Отправка сообщения
    $("#message_send").on('click', function() {
        var text = $('#message_text').val();
        if (text) {
            $.get('SendMessage.php', {text: text, num: ++counter}, function(data) {
                try {
                    data = JSON.parse(data);
                    alert(data['text'])
                }
                catch(exc) {
                    alert("Ошибка сервера");
                } 
            });
        }
        else {
            alert("Введите текст сообщения");
        }
    });
    // Запросить сообщения за последнюю минуту
    $("#message_request_static").on('click', function() {
        $.get('GetMessage.php', function(data) {
            try {
                data = JSON.parse(data);
                if (data['type'] == 'success') {
                    $('#message_list_static').footable({
                        'empty': 'Нет сообщений',
                        'columns': [
                            {name:'date', title:'Дата'},
                            {name:'number', title:'Номер'},
                            {name:'text', title:'Текст'},
                        ],
                        'rows': data['text'],
                    });
                }
                else {
                    alert(data['text'])
                }
            }
            catch(exc) {
                alert("Ошибка сервера");
            } 
        });
    });
    
    openSocket();
});

function openSocket() {
    var socket = new WebSocket('ws://127.0.0.1:8888');

    socket.onerror = function(error) {
        debug("connection error. ");
        socket.close();
    };

    // Обработчик соединения
    socket.onopen = function() {
        debug("socket opened");
    };

    // Обработчик получения сообщения от сервера
    socket.onmessage = function(e) {
        debug("server answered: " + e.data);
        try {
            var data = JSON.parse(e.data);
            console.log(data);
        }
        catch(exc) {
            debug("bad server answer " + exc.name);
            debug(exc);
        }        
    }

    return socket;
}