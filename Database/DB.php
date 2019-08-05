<?php

class DB {
    static private $_connect = NULL;
    
    static function connect() {
        if (self::$_connect === NULL) {
        self::$_connect = mysqli_connect(HOST, USER, PASS, DB);
        if (mysqli_connect_errno()) {
            writeLog(__FILE__, mysqli_connect_error(self::$_connect));
        }
        else {
            mysqli_set_charset(self::$_connect, 'utf8');
            mysqli_query(self::$_connect, 'SET lc_time_names = "ru_RU";');
        }
        }
    }
    
    static function getArray($sql) {
        self::connect();
        
        $info = mysqli_query(self::$_connect, $sql);
        
        if (mysqli_errno(self::$_connect)) {
            $data = debug_backtrace();
            writeLog($data[0]['file'], mysqli_error(self::$_connect));
            return false;
        }
        else {
            if (mysqli_num_rows($info)) {
                return mysqli_fetch_all($info, MYSQLI_ASSOC);
            }
            else {
                return array();
            }
        }
    }
    
    static function insert($arr = array()) {
        $exception = array('NOW()', 'null');
        self::connect();
        extract($arr, EXTR_OVERWRITE);
        
        if (!isset($table) OR !isset($value)) {
            return false;
        }
        else {
            $cols = '';
            $vals = '';
            
            foreach ($value as $col => $val) {
                $cols.= self::escape($col) . ",";
                $vals.= (in_array($val, $exception) ? $val : '"' . self::escape($val) . '"')  . ',';
            }
            
            $cols  = trim($cols, ',');
            $vals  = trim($vals, ',');
            $vals = str_replace('""', 'NULL', $vals);
            
            $sql = 'INSERT INTO ' . self::escape($table) . '(' . $cols . ') VALUES(' . $vals . ');';
            mysqli_query(self::$_connect, $sql);
            if (mysqli_errno(self::$_connect)) {
                $data = debug_backtrace();
                writeLog($data[0]['file'], mysqli_error(self::$_connect));
                return false;
            }
            else {
                return mysqli_insert_id(self::$_connect);
            }
        }
    }
    
    static function escape($str) {
        self::connect();
        $str = htmlspecialchars($str);
        return mysqli_real_escape_string(self::$_connect, $str);
    }
}
?>