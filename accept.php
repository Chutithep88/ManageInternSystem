<?php
    session_start();
    include_once 'dbconnect.php';


    //ป้องกันไม่ให้เข้าถึงหน้านี้โดยไม่ผ่าน Login
    if(!isset($_SESSION['email'])){
        header("location: index.php");
        return;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accept</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="scripts/bootstrap.min.js"></script>
</head>
<body>
    <br/>
    <h1 style='color:green'><center>คุณ <u>ได้</u> รับการเข้าฝึกงาน</center></h1>
    <h2><center>ที่ ศูนย์เทคโนโลยีสารสนเทศ คณะเภสัชศาสตร์</center></h2>
    <h3><center>เบอร์ติดต่อสอบถามเพิ่มเติม : 000-000-000</center></h3>
    <h3><center><a href="logout.php" class="btn btn-danger">ออกจากระบบ</a></center></h3>
    
</body>
</html>