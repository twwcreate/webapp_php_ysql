<?php //首先定義左php db的資料
//咁樣寫只係for測試用，不推薦真實上線使用，因為牽涉到安全問題。
$user = 'root';
$password = 'root';
$db = 'goals';
$host = 'localhost';
$port = 8889;

//以下係可以connect到database，並傳送資料
$link= mysqli_init();
$success = mysqli_real_connect(
    $link,
    $host,
    $user,
    $password,
    $db,
    $port
);

?>