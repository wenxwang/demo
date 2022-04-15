<?php
/* 首页 */
header('Content-type:text/html; charset=utf-8');

session_start();

if (isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['isLogin'] = 1;
}

if ($_SESSION['isLogin'] == 1) {
    echo '你好，'.$_SESSION['username'].'，欢迎'.PHP_EOL;
    echo "<a href='logout.php'>注销</a>";
} else {
    echo '你还未登陆，请前往';
    echo "<a href='login.html'>登陆</a>";
}