<?php
$database_host = 'localhost';
$database_port = 3306;
$database_username = 'root';
$database_password = '';
$database_name = 'library';
$pdo = new PDO("mysql:host=$database_host;port=$database_port;dbname=$database_name", $database_username, $database_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
