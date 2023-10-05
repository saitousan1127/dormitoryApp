<?php
/*************************************************
 * 給食業者実行スクリプト
 * 
 */

define('_ROOT_DIR', __DIR__ . '/');
require_once _ROOT_DIR . '../../php_libs/init.php';
$controller = new CatererController();
$controller->run();
exit;