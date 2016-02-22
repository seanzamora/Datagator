<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( session_status() == PHP_SESSION_NONE ) {
session_start();
}

// Autoload the required files
require_once (APPPATH."third_party/Dropbox/autoload.php");

use \Dropbox as dbx;

?>
