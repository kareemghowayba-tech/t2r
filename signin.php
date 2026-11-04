<?php
session_start();

require_once("server/db.php");

$result = "هنا سيتم عرض اي خطأ او نجاح";

if(isset($_SESSION["sign"])) {
    header("Location: editor.php");
    exit();
} else {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['username'] , $_POST['password'])  && trim($_POST['password']) !== "" ) {
            $username = trim($_POST['username']);
            $cleanpass = trim($_POST['password']);
            
            if (mb_strlen($cleanpass, "UTF-8") >= 8 && mb_strlen($username, "UTF-8") >= 8) {
                $hashedpass = password_hash($cleanpass, PASSWORD_DEFAULT);
                
                try {
                    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
                    $stmt = $db->prepare($sql);
                    
                    // نقوم بالتنفيذ أولاً قبل تفعيل الجلسة للتأكد من عدم وجود خطأ مكرر
                    $stmt->execute([
                        ':username' => $username, // استخدم المتغير النظيف الممسوح منه المسافات trim
                        ':password' => $hashedpass
                    ]);
                    
                    // إذا وصلنا هنا فهذا يعني أن الإدخال نجح تماماً بدون أخطاء تكرار
                    $_SESSION["sign"] = true;
                    $_SESSION['role'] = "admin" ;
                    header("Location: editor.php");
                    exit(); // مهم جداً لإيقاف السكريبت بعد التوجيه
                    
                } catch (PDOException $e) {
                    // التحقق من كود انتهاك القيود وتكرار الحقل اليونيك (1062)
                    if ($e->getCode() == '23000' && isset($e->errorInfo[1]) && $e->errorInfo[1] == 1062) {
                        $result = "اسم المستخدم هذا مسجل بالفعل، يرجى اختيار اسم آخر.";
                    } else {  
                        $result = "عذراً، حدث خطأ غير متوقع أثناء معالجة طلبك. يرجى المحاولة لاحقاً.";
                    }
                }

            } else  {
                $result = "كلمة المرور أو اسم المستخدم يجب ألا يقل عن 8 أحرف.";
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - T2R</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body">
    
    <main class="login-main">
        <div class="login-card">
            <h2 class="login-title">انشاء حساب</h2>
            <form  method="POST" class="login-form">
                <input type="text" name="username" placeholder="اسم المستخدم" required class="login-input">
                <input type="text" name="password" placeholder="كلمة المرور" required class="login-input">
                <div class="login-input"><?php echo $result; ?></div>
                <button type="submit" class="btn-primary login-btn">دخول</button>
            </form>
        </div>
    </main>

</body>
</html>