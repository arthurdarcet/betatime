<?php
session_start();
session_unset();
session_destroy();
include('conf/config.php');
$ip = $_SERVER['REMOTE_ADDR'];
mysql_query("UPDATE bt_connectes SET session = 0 WHERE ip = '".$ip."' ");
header("location:msg_info.php?class=membres&id=2");
?>