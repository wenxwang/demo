<?php
/* 注销页面 */
header('Content-type:text/html;charset=utf-8');

session_start();

$username = $_SESSION['username'];
session_destroy();

setcookie('username', '', $_SERVER['REQUEST_TIME'] - 1);
setcookie('token', '', $_SERVER['REQUEST_TIME'] - 1);

echo '欢迎下次光临,' . $username;
echo "<a href='login.html'>重新登陆</a>";