<?php
$host = 'localhost';
$dbname = 't2r_db'; // اسم مناسب لمشروعك التعليمي
$username = 'root';
$password = '';

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // تفعيل إظهار الأخطاء
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // جلب البيانات في شكل Associative Array منظم
);

try {
    $db = new PDO($dsn, $username, $password, $options);
    // تم الاتصال بنجاح
    // echo "Database Connected Successfully!";

} catch (PDOException $e) {
    // إظهار الخطأ بشكل آمن للمبرمج
    echo "Connection Failed: " . $e->getMessage();
}