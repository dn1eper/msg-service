<?php

class Controller_Socket {
    public static function notify($text) {
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        $data = ['type' => 'message-all', 'text' => $text];
        $json = json_encode($data);
        socket_sendto($sock, $json, strlen($json), 0, '127.0.0.1', SOCKET_PORT);
        socket_close($sock);
    }
}