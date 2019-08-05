<?php

class Model_Message {
    public static function GetMessages($minute) {
        return DB::getArray('
            SELECT *
            FROM message
            WHERE date > DATE_SUB(NOW(), INTERVAL "' . $minute . '" MINUTE)
        ');
    }

    public static function PutMessage($text, $number) {
        $insert['table'] = 'message';
        $insert['value'] = [
            'text'      => $text, 
            'number'    => $number, 
            'date'      => 'NOW()'
        ];
        return DB::insert($insert);
    }
}