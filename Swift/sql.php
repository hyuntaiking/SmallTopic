<?php
$host = '127.0.0.1';
$db = 'iii';
$user = 'root';
$passwd = 'root';
$driver = 'mysql';
$charset = 'utf8';
$dsn = "{$driver}:hosts={$host};dbname={$db};charset={$charset}";
$opt = [pdo::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_BOTH];
$pdo = @new PDO($dsn, $user, $passwd, $opt);