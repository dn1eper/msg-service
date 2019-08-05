<?
    spl_autoload_register(function($class) {
        $class = str_replace('_', '/', $class) . '.php';
            if (file_exists($class)) {
                include_once $class;
            }
    });

    function writeLog($file, $text) {
		$date = date('y_m_d', time());
		if (!file_exists(LOG)) {
			mkdir(LOG, 755);
		}
		if (!file_exists(LOG . date('y_m_d', time()) . '_log.html')) {
			$pattern = file_get_contents(LOG . 'pattern.html');
			file_put_contents(LOG . $date . '_log.html', $pattern);
		}
		$err  = fopen(LOG . $date . '_log.html', 'a');
		$text = '
		<tr class="db">
			<td>' . date('H:i:s', time()) . '</td>
			<td>' . $file  . ' </td>
			<td>' . $text  . ' </td>
		</tr> ';
		fwrite ($err, $text);
		fclose ($err);
	}

	include_once 'config.php';
	include_once 'Database/Db.php';
	