<?php
/**
 * Plugin Name: My Tables
 * Description: Displays selected fields from <code>SHOW TABLE STATUS;</code>
 * Plugin URI: http://bimal.org.np/
 * Author: Bimal Poudel
 * Author URI: http://bimal.org.np/
 * Version: 1.0.0
 */

define('__MY_TABLES__', dirname(__FILE__));
require_once(__MY_TABLES__ . '/classes/class.my_tables.inc.php');
require_once(__MY_TABLES__ . '/classes/class.my_tables_processor.inc.php');

$my_tables_whoami = basename(__MY_TABLES__) . '/' . basename(__FILE__);
$my_tables = new my_tables();
$my_tables->init($my_tables_whoami);
