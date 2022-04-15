<?php
/* 登陆处理 */
header('Content-type:text/html; charset=utf-8');

session_start();

$username = trim($_POST['username']);
$password = trim($_POST['password']);

// 账号验证
if ($username !== 'test') {
    header('refresh: 3,url=login.html');
    die('用户名不正确！');
}
if ($password !== '123') {
    header('refresh: 3,url=login.html');
    die('密码不正确！');
}

// 设置session
$_SESSION['username'] = $username;
$_SESSION['token'] = md5($password);

// 设置cookie
setcookie('username', $username);

if ($_POST['remember'] == '1') {
    setcookie('username', $username, $_SERVER['REQUEST_TIME']+600);
}

// 跳转登陆成功页面
header('location:index.php');