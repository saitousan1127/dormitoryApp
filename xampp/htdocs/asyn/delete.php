<?php
/*************************************************
 * 非同期申請削除スクリプト
 * 
 */

define('_ROOT_DIR', __DIR__ . '/');
require_once _ROOT_DIR . '../../php_libs/init.php';
$controller = new DeleteController();
$controller->run();
exit;