function getreq() {
            let userInput = document.getElementById("usernameInput").value;
            
            // الحل هنا: أضفنا .value لنأخذ النص الحقيقي للـ Token وليس العنصر
            let tokenValue = document.getElementById("bytes").value; 

            let form = new FormData();
            form.append("user", userInput);
            form.append("token", tokenValue); // إرسال القيمة النصية الصحيحة
            
            let myreq = new XMLHttpRequest();
            myreq.open("POST", "auth.php", true);
            
            myreq.onload = function() {
                if (myreq.status === 200) {
                    document.getElementById("result").innerHTML = myreq.responseText;
                }
            };

            myreq.send(form);
        }

        function getbytes() {
            let myreq = new XMLHttpRequest();
            myreq.open("GET", "auth.php", true);
            
            myreq.onload = function() {
                if (myreq.status === 200) {
                    // الحل هنا: تحديث حقل الـ input المخفي في الـ HTML مباشرة بالقيمة القادمة
                    document.getElementById("bytes").value = myreq.responseText;
                }
            };
            
            myreq.send();
        }

        // تشغيل دالة الجلب عند فتح الصفحة
        getbytes();

        <?php
session_start();
// $bytes =  ;
if ($_SERVER['REQUEST_METHOD'] === "GET") :
    if (!isset($_SESSION['cruf-token'])):
$_SESSION['cruf-token'] = bin2hex(random_bytes(32));
    endif;
echo $_SESSION['cruf-token'];
exit;
endif;

if ($_SERVER['REQUEST_METHOD'] === "POST") :

    $user = $_POST['user'];
    $token = $_POST['token'];
   
   if(hash_equals($_SESSION['cruf-token'],$token)) :
    echo 'true' ;
   else:
    echo 'false';
    exit(1);
   endif;
// echo "نجح";
exit(0);
endif;



// echo $bytes;




































// error_reporting(0)
// $allowedusers = ['kareem','ahmed'] ;
// if (isset($_POST['user'])) :
//   $user =    $_POST['user'];
//     if (in_array($user, $allowedusers)) :
//         echo $user ;
//     else:
//         echo 'notallow';
//     endif;
// endif;
// if (isset($_POST['user'])) :
//  $user =    $_POST['user'];
//     $userhash = password_hash($user,PASSWORD_DEFAULT);
    
//     if (password_verify($user,$userhash)) :
//         echo true . "===" . $userhash . "===/a" . password_verify($user,$userhash);
//         // $_SESSION['pass'] = $user;
//         // $_SESSION['hash'] = $userhash;
//         if (isset($_SESSION['pass'] )) :
//           if (  password_verify($_SESSION['pass'] , $_SESSION['hash']));
//           echo "kks sk ssxsxd";
//         endif;
//     endif;
// endif;