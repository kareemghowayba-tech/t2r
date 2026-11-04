<?php
require_once("server/db.php");
session_start();
if (isset($_SESSION['role'] , $_SESSION['sign']) && $_SESSION['role'] === "admin" ) {

$sql = "SELECT lang, id,title,content FROM lessons ORDER BY list ASC ,id ASC ";
  $select = $db->query($sql) ;
  $lessons = $select->fetchAll();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['addTitle'])) {
      $list =  trim($_POST['addId']) ;
      $title = trim( $_POST['addTitle'] ) ;
      $content = trim($_POST['addBody']) ;
      $lang = $_POST['lang'] ;
      $sql = "INSERT INTO lessons (list,title,content,lang) VALUES (:list,:title,:content,:lang)" ;
      $stmt = $db->prepare($sql);
      $stmt->execute([
      ":list" => $list,
      ":title" => $title,
      ":content" => $content ,
      ":lang" => $lang,

      ]);
      // echo $list . $title . $content ;
      header("Location:dashboard.php");
      exit();
  }

}


} elseif (isset($_SESSION['role'] , $_SESSION['sign']) && $_SESSION['role'] === "user" ) {
  header("Location:editor.php");
  exit();
} else {
  header("Location:signin.php");
  exit();
}

?>



<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>لوحة التحكم</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <main class="dashboard">
    <div class="lessons-container">
      <?php
      if($lessons) {
        $lists = 1;
      foreach($lessons as $lesson) { ?>
      <div class="lesson">
     <h3>   <?php echo htmlspecialchars($lesson['title']); ?> <span> [<?php echo $lists; ?>]</span>  </h3>
     <p><?php
     echo htmlspecialchars($lesson["content"]);
     ?></p>
     <span>( <?php echo htmlspecialchars($lesson['lang']); ?> )</span>
     <button class="editbtn btn-primary">عدل</button>
     <input type="hidden" name="hidden" class="hidden"data-id= "<?php echo $lesson['id'] ?>">
     </div>
      <?php $lists = $lists + 1; }} else{?> <h3>لا توجد دروس</h3>  <?php } ?>
   
</div>
    <!-- 1. نافذة التعديل المنبثقة -->
    <dialog id="editlessonalert">
      <form action="" method="post" class="editlessonform">
        <input type="text" name="editTitle" placeholder="العنوان" required>
        <input type="number" name="editId" placeholder="الترتيب" required >
        <input type="hidden" name="hiddenedit" class="hiddenedit">
        <textarea name="editBody" placeholder="المحتوى" required></textarea>
        <button id="editconfirm" class="btn-primary"> اكد </button>
        <button type="button" class="exit btn-primary">اخرج</button>
      </form>
    </dialog>
    
    <button id="addLessonbtn" class="btn-primary">اضف درس</button>
    
    <!-- 2. نافذة إضافة درس جديد المنبثقة -->
    <dialog id="addlessonalert">
      <form action="" method="post" class="addlessonform">
        <input type="number" name="addId" placeholder="الترتيب" required>
        <input type="text" name="addTitle" placeholder="العنوان" required>
        <select name="lang" id="lang" required>
          <option value="">اختر اللغه</option>
          <option value="html">html</option>

        </select>
        <textarea name="addBody" placeholder="المحتوى" required></textarea>
        <button id="addconfirm" class="btn-primary"> اكد </button>
        <button type="button" class="exit btn-primary">اخرج</button>
      </form>
    </dialog>
  </main>
  <script src="js/dashboard.js"></script>
</body>
</html>
