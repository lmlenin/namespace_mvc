<?php

namespace core\error\error404;
/**
 * 
 */
class error404
{
	
	public function show()
	{
		echo php_strip_whitespace(__DIR__.DIRECTORY_SEPARATOR."error404_3.html");
	}
}

?>