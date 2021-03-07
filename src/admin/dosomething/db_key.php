<?php 
$db_host = '';
$db_name = 'project';
$db_user = 'admindhvHfDm';
$db_password = '';
$dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 

$db = new PDO($dsn, $db_user, $db_password, $options);
?>