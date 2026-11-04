<?php
session_start();
if(isset($_SESSION["sign"])) {
    header("Location: editor.php");
}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعلم طبق ترى - T2R | منصة تعلم برمجة الويب</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- استدعاء الهيدر -->
    <?php include 'components/header.php'; ?>

    <!-- الأقسام الرئيسية -->
    <main class="main2">
        <?php include 'components/hero.php'; ?>
        <?php include 'components/about.php'; ?>
    </main>

    <!-- استدعاء الفوتر -->
    <?php include 'components/footer.php'; ?>
    
    <!-- ملف الجافا سكريبت -->
    <script src="js/main.js"></script>
</body>
</html>