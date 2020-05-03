<?
$_host = 'localhost';
$_db = 'virushack';
$_user = 'root';
$_pass = '';
$_charset = 'utf8';

$_dsn = "mysql:host=$_host;dbname=$_db;charset=$_charset";
$_opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
