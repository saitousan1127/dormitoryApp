<?php
/*************************************************
 * 初期設定ファイル
 *
 */

//----------------------------------------------------
// デバッグ表示 true / デバッグ表示オフfalse
//----------------------------------------------------

// define("_DEBUG_MODE", true); 

define("_DEBUG_MODE", false);

//----------------------------------------------------
// エラー表示
//----------------------------------------------------
// php.iniや .htaccessで設定していない場合ここで設定
// ini_set( "display_errors", "On");

// 開発中
ini_set( "error_reporting", E_ALL );

// 運用中
//ini_set( "error_reporting", E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED );

//----------------------------------------------------
// データベース関連
//----------------------------------------------------

// データベース接続ユーザー名
define("_DB_USER", "root");

// データベース接続パスワード
define("_DB_PASS", "S@yho3110M");

// データベースホスト名
define("_DB_HOST", "localhost");

// データベース名
define("_DB_NAME", "shoindb");

// データベースの種類
define("_DB_TYPE", "mysql");

// データソースネーム
define("_DSN", _DB_TYPE . ":host=" . _DB_HOST . ";dbname=" . _DB_NAME. ";charset=utf8");


//----------------------------------------------------
// セッション名
//----------------------------------------------------

// 会員用セッション名
define("_MEMBER_SESSNAME", "PHPSESSION_MEMBER");

// 管理者用セッション名
define("_SYSTEM_SESSNAME", "PHPSESSION_SYSTEM");

// 教員用セッション名
define("_TEACHER_SESSNAME", "PHPSESSION_TEACHER");

// 外泊願用セッション名
define("_GAIHAKU_SESSNAME", "PHPSESSION_GAIHAKU");

// 寮監用セッション名
define("_RYOUKAN_SESSNAME", "PHPSESSION_RYOUKAN");

// 欠食届用セッション名
define("_KESSYOKU_SESSNAME", "PHPSESSION_KESSYOKU");

// 給食業者用セッション名
define("_CATERER_SESSNAME", "PHPSESSION_CATERER");

// 会員用認証情報 保管変数名
define("_MEMBER_AUTHINFO", "userinfo");

// 管理者用認証情報 保管変数名
define("_SYSTEM_AUTHINFO", "systeminfo");

// 教員用認証情報 保管変数名
define("_TEACHER_AUTHINFO", "teacherinfo");

// 外泊願用認証情報 保管変数名
define("_GAIHAKU_AUTHINFO", "gaihakuinfo");

// 寮監用認証情報 保管変数名
define("_RYOUKAN_AUTHINFO", "ryoukaninfo");

// 欠食届用認証情報 保管変数名
define("_KESSYOKU_AUTHINFO", "kessyokuinfo");

// 給食業者用認証情報 保管変数名
define("_CATERER_AUTHINFO", "catererinfo");



//----------------------------------------------------
// 会員・管理者　処理分岐用
//----------------------------------------------------

// 会員用フラッグ
define("_MEMBER_FLG", false);

// 管理者フラッグ
define("_SYSTEM_FLG", true);


//----------------------------------------------------
// ファイル設置ディレクトリ
//----------------------------------------------------

// 関連ファイルを設置するディレクトリ
define( "_PHP_LIBS_DIR", _ROOT_DIR . "../../php_libs/");

// クラスファイル
define( "_CLASS_DIR", _PHP_LIBS_DIR . "class/");

// 環境変数 
define( "_SCRIPT_NAME", $_SERVER['SCRIPT_NAME']);

//----------------------------------------------------
// Smarty関連設定
//----------------------------------------------------

//  Smartyのlibsディレクトリ
define( "_SMARTY_LIBS_DIR",         _PHP_LIBS_DIR . "smarty/libs/");

//  Smartyのテンプレートファイルを保存したディレクトリ
define( "_SMARTY_TEMPLATES_DIR",    _PHP_LIBS_DIR . "smarty/templates/");

//  Smartyのコンパイル用ディレクトリ Webサーバから書き込めるようにします。、
define( "_SMARTY_TEMPLATES_C_DIR",  _PHP_LIBS_DIR . "smarty/templates_c/");

//  Smartyの設定ディレクトリ 未使用
define( "_SMARTY_CONFIG_DIR",       _PHP_LIBS_DIR . "smarty/configs/");

//  Smartyのキャッシュディレクトリ Webサーバから書き込めるようにします。、
define( "_SMARTY_CACHE_DIR",        _PHP_LIBS_DIR . "smarty/cache/");


//----------------------------------------------------
// 汎用ライブラリの読み込み
//----------------------------------------------------
// PEARファイル設置ディレクトリ
define( "_PEAR_PATH1", _PHP_LIBS_DIR . "PEAR/");
define( "_PEAR_PATH2", _PHP_LIBS_DIR . "PEAR/Pager/");

// ファイル読み込みディレクトリ
ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . _PEAR_PATH1 .PATH_SEPARATOR . _PEAR_PATH2);

// 入力フォーム機能を使用
require_once("HTML/QuickForm2.php");
require_once("HTML/QuickForm2/Renderer.php");

// Smartyテンプレートエンジンを使用
require_once(_SMARTY_LIBS_DIR . "Smarty.class.php");

//----------------------------------------------------
// 自作クラスファイルの読み込み
//----------------------------------------------------
// 読み込みの順番を変えると動作しません。
require_once( _CLASS_DIR      . "BaseController.php");
require_once( _CLASS_DIR      . "BaseModel.php");
require_once( _CLASS_DIR      . "Auth.php");
require_once( _CLASS_DIR      . "MemberController.php");
require_once( _CLASS_DIR      . "MemberModel.php");
require_once( _CLASS_DIR      . "PrememberController.php");
require_once( _CLASS_DIR      . "PrememberModel.php");
require_once( _CLASS_DIR      . "PreteacherController.php");
require_once( _CLASS_DIR      . "PreteacherModel.php");
require_once( _CLASS_DIR      . "SystemController.php");
require_once( _CLASS_DIR      . "SystemModel.php");
require_once( _CLASS_DIR      . "tplModel.php");
require_once( _CLASS_DIR      . "gaihakuModel.php");
require_once( _CLASS_DIR      . "TeacherController.php");
require_once( _CLASS_DIR      . "TeacherModel.php");
require_once( _CLASS_DIR      . "RyoukanController.php");
require_once( _CLASS_DIR      . "RyoukanlogModel.php");
require_once( _CLASS_DIR      . "kessyokuModel.php");
require_once( _CLASS_DIR      . "AppController.php");
require_once( _CLASS_DIR      . "OpenController.php");
require_once( _CLASS_DIR      . "roomModel.php");
require_once( _CLASS_DIR      . "KgroupModel.php");
require_once( _CLASS_DIR      . "DeleteController.php");
require_once( _CLASS_DIR      . "holidayModel.php");
require_once( _CLASS_DIR      . "longVacationModel.php");
require_once( _CLASS_DIR      . "CatererController.php");
require_once( _CLASS_DIR      . "CatererModel.php");
require_once( _CLASS_DIR      . "TenkoModel.php");
require_once( _CLASS_DIR      . "AbsenteeModel.php");
