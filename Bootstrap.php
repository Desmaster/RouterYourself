<?php

class Bootstrap {

	public static function load($path) {
		if (file_exists($path)) {
			$files = scandir($path);
			foreach ($files as $file) {
				if (!is_dir($file)) {
					if (substr($file, -4) == '.php') {
						require_once $path . DIRECTORY_SEPARATOR . $file;
					} else {
						if (!($file == '.' || $file == '..')) {
							Bootstrap::load($path . DIRECTORY_SEPARATOR . $file);
						}
					}
				}
			}
		}
	}

}