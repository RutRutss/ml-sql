<?php

$host = 'localhost'; // เช่น localhost
$username = 'root';
$password = '';
$database = 'ml_sql';

// ทำการเชื่อมต่อฐานข้อมูล
$conn = new mysqli($host, $username, $password, $database);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
