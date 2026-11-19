<?php
$host = 'localhost';
$username = 'root';
$password = ''; // XAMPP mặc định để trống mật khẩu
$database = 'dreamtrip'; // Sửa thành 'DreamTrip' để khớp với phpMyAdmin của bạn

try {
    // Kết nối CSDL sử dụng PDO
    $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
    // Thiết lập chế độ báo lỗi
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
?>