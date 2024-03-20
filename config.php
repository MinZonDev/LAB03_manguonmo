<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', ''); // Thay 'your_password_here' bằng mật khẩu thực của bạn
   define('DB_DATABASE', 'ecommerce');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   // Kiểm tra kết nối
   if ($db === false) {
       die("Lỗi kết nối: " . mysqli_connect_error());
   }
?>
