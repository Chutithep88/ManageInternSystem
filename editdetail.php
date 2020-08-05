<?php
    session_start();
    include_once 'dbconnect.php';
    $idemail = $_SESSION['email'];

    //ป้องกันไม่ให้เข้าถึงหน้า edit โดยไม่ผ่านการ Login
    if(!isset($_SESSION['email'])){
        header("location: index.php");
        return;
    }

    if(isset($_POST['update'])){
        //ทำการเก็บค่าไว้ในตัวแปร PHP
        $Fname = strip_tags($_POST['Firstname']);
        $lname = strip_tags($_POST['Lastname']);
        $education = strip_tags($_POST['Education']);
        $resume = strip_tags($_POST['Resume']);
        $detail = strip_tags($_POST['Detail']);

        //ป้องกันการ SQL Injection
        $Fname1 = mysqli_real_escape_string($conn,$Fname);
        $lname1 = mysqli_real_escape_string($conn,$lname);
        $education1 = mysqli_real_escape_string($conn,$education);
        $resume1 = mysqli_real_escape_string($conn,$resume);
        $detail1 = mysqli_real_escape_string($conn,$detail);


        //นำตัวแปรที่มีการป้องกันการ SQL Injection มา query ในตัวแปร $sql
        $sql = "UPDATE posts SET Firstname='$Fname1' , Lastname='$lname1' , 
        Education='$education1' , Resume = '$resume1' , Detail = '$detail1'
         WHERE email = '$idemail' ";

        if($Fname1 == "" || $lname1 == ""){
            echo "Please complete your post!";
            return;
        }

        mysqli_query($conn,$sql);

        header("location: detail.php");


    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>แก้ไขข้อมูลประวัติส่วนตัว</title>
   
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="scripts/bootstrap.min.js"></script>
    
</head>
<body>
<div id="content1">
        <div>
            <br/>
            <font color="#8B4513"><h1><center>Edit Post</center></h1></font>
        </div>
    <?php
        $sql_get = "SELECT * FROM posts WHERE email = '$idemail' ";
        $res = mysqli_query($conn,$sql_get);

        if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)){
                $Fname = $row['Firstname'];
                $lname = $row['Lastname'];
                $education = $row['Education'];
                $resume = $row['Resume'];
                $detail = $row['Detail'];

                echo"<form action='editdetail.php' method='post' enctype='multipart/form-data'>";
                echo"<b><center>ชื่อ :</b> <input placeholder='กรอกชื่อ' name='Firstname' type='text' value='$Fname' autofocus size='48'></center><br /><br />";
                echo"<b><center>นามสกุล :</b> <input placeholder='กรอกนามสกุล' name='Lastname' type='text' value='$lname' autofocus size='48'></center><br /><br />";
                echo"<b><center>การศึกษา :</b> <input placeholder='กรอกการศึกษา' name='Education' type='text' value='$education' autofocus size='48'></center><br /><br />";
                echo"<b><center>ความสนใจในการฝึกงาน :</b> <input placeholder='กรอกresume' name='Resume' type='text' value='$resume' autofocus size='48'></center><br /><br />";
                echo"<b><center>รายละเอียดเกี่ยวกับตัวเอง : </b> <textarea placeholder='กรอกข้อมูลที่เหลือ' name='Detail' type='text' value='$detail' rows='10' cols='45'></textarea></center><br /><br />";
                //echo"<input placeholder='Content' name='content' rows='20' cols='50'>$content</textarea><br />";





                //แบบเดิม เผื่อนำ css มาตกแต่ง
                // echo"<form action='editdetail.php' method='post' enctype='multipart/form-data'>";
                // echo"<b>ชื่อ :</b> <input placeholder='กรอกชื่อ' name='Firstname' type='text' value='$Fname' autofocus size='48'><br /><br />";
                // echo"<b>นามสกุล :</b> <input placeholder='กรอกนามสกุล' name='Lastname' type='text' value='$lname' autofocus size='48'><br /><br />";
                // echo"<b>การศึกษา :</b> <input placeholder='กรอกการศึกษา' name='Education' type='text' value='$education' autofocus size='48'><br /><br />";
                // echo"<b>ความสนใจในการฝึกงาน :</b> <input placeholder='กรอกresume' name='Resume' type='text' value='$resume' autofocus size='48'><br /><br />";
                // echo"<b>รายละเอียดเกี่ยวกับตัวเอง : </b> <textarea placeholder='กรอกข้อมูลที่เหลือ' name='Detail' type='text' value='$detail' rows='10' cols='45'></textarea><br /><br />";
               
               

            }
        }


    ?>
        <div align="center">
            <input name="update" type="submit" value="Update">
            <a href="detail.php" style="font-size:12px;">&nbsp; &nbsp; ย้อนกลับ</a>

        </div>
        

        <!-- 
        <input name="update" type="submit" value="Update">
        <a href="detail.php" style="font-size:12px;">&nbsp; &nbsp; ย้อนกลับ</a> -->
    </form>
</div>
</body>
</html>