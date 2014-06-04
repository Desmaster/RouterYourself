<?php

class Configuration {

	public static function loadByFile($path) {
		if (file_exists($path)) {

			if (!is_dir($path)) {
				if (substr($path, -4) == '.ini') {

					$ini_array = parse_ini_file($path);
					foreach ($ini_array as $key => $value) {
						$key = trim($key);
						$value = trim($value);
						$key = strtoupper($key);

						define($key, $value);
					}

				}
			} else {
				Configuration::logError('Path is a dir');
			}
		}
	}

	public static function loadByFolder($path) {
		if (file_exists($path)) {

			$files = scandir($path);
			foreach ($files as $file) {

				if (!is_dir($file)) {
					if (substr($file, -4) == '.ini') {

						$ini_array = parse_ini_file($path . DIRECTORY_SEPARATOR . $file);
						foreach ($ini_array as $key => $value) {
							$key = trim($key);
							$value = trim($value);

							$key = strtoupper($key);

							define($key, $value);
						}

					} elseif (!($file == '.' || $file == '..')) {
						Configuration::loadByFolder($path . DIRECTORY_SEPARATOR . $file);
					}
				}

			}

		}
	}

}

?>