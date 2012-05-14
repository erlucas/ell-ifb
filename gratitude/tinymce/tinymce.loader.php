<?php

/*-----------------------------------------------------------------------------------*/
/*	Paths Defenitions
/*-----------------------------------------------------------------------------------*/

define('ZEN_TINYMCE_PATH', ZEN_FILEPATH . '/tinymce');
define('ZEN_TINYMCE_URI', ZEN_DIRECTORY . '/tinymce');


/*-----------------------------------------------------------------------------------*/
/*	Load TinyMCE dialog
/*-----------------------------------------------------------------------------------*/

require_once( ZEN_TINYMCE_PATH . '/tinymce.class.php' );		// TinyMCE wrapper class
new zen_tinymce();											// do the magic

?>