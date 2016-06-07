<?php
header("Content-Type: text/html;charset=utf-8");

$user = $_GET['user'];

if (empty($user)) {
	$url   = 'http://';
	$url  .= $_SERVER['HTTP_HOST'];
	$url  .= $_SERVER['PHP_SELF'].'?';
	$url  .= 'user=[teacher|student]';
	exit('没有传递参数; '.'参数格式为'.$url);
}

if ($user != 'teacher' || $user !=='student') {
	$url   = 'http://';
	$url  .= $_SERVER['HTTP_HOST'];
	$url  .= $_SERVER['PHP_SELF'].'?';
	$url  .= 'user=[teacher|student]';
	exit('参数错误; '.'参数格式为'.$url);
}
if ($user == 'student') {
	require_once 'room.php';
}
if ($user == 'teacher') {
	require_once 'manage.php';
}
