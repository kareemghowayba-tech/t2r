<?php
session_start();
if(!isset($_SESSION["sign"])) {
    header("Location: signin.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محرر الأكواد - تعلم طبق ترى</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
    .navlinks a {
        display:none;
    }
        </style>
</head>
<body>
    <?php include 'components/header.php'; ?>

    <main class="main">
      <?php include 'components/editorandlessons.php'; 
      include 'components/result.php';
      ?>
      
    </main>
    <?php include 'components/footer.php'; ?>
    <script src="js/main.js"></script>
    <script src="js/editor.js"></script>
</body>
</html>