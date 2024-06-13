<?php
// Thông tin kết nối cơ sở dữ liệu
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'projects';

// Tạo kết nối với MySQLi
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Thiết lập mã hóa UTF-8
if (!$conn->set_charset("utf8")) {
    echo "Error loading character set utf8: " . $conn->error;
    exit();
}
