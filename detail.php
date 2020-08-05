<?php
    session_start();
    include_once 'dbconnect.php';
    $iduseremail = $_SESSION['email'];
    

   

    //ป้องกันไม่ให้เข้าถึงหน้านี้โดยไม่ผ่าน Login
    if(!isset($_SESSION['email'])){
        header("location: index.php");
        return;
    }

    if(isset($_POST['submit'])){
        //upload file
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $targetFilePath = $target_dir . $target_file;
        $target_file1 = basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


        
        //โค้ดสำหรับเช็คว่าที่อัพโหลดเป็นรูปใช่หรือไม่ (ทำให้เป็นคอมเม้นท์เนื่องจากเราไม่ได้ต้องการให้อัพโหลดแค่รูปถ่ายอย่างเดียว)
        // // Check if image file is a actual image or fake image
        // if(isset($_POST["submit"])) {
        //     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        //     if($check !== false) {
        //         echo "File is an image - " . $check["mime"] . ".";
        //         $uploadOk = 1;
        //     } else {
        //         echo "File is not an image.";
        //         $uploadOk = 0;
        //     }
        // }


        // Check if file already exists
        //ไปใช้สำหรับการ INSERT = 1 , UPDATE = 2 , DEFAULT = 0
        // if (file_exists($target_file)) {
        //     echo "Sorry, file already exists.";
        //     $uploadOk = 0;
        // }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "doc") {
            echo "Sorry, only JPG, JPEG, PNG GIF PDF DOC files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        }else{
            //ระบบ update การอัพโหลด Resume กรณีที่ต้องการอัพโหลดแก้ไฟล์ Resume (ยังใช้งานไม่ได้)
            //$Ids = mysqli_real_escape_string($conn,$_SESSION["email"]);
            //echo $Id;
            //exit();
            //mysqli_real_escape_string($iduseremail);
            $em = $_SESSION['email'];
            $po = "SELECT * FROM posts WHERE email = '$em' ";
            //echo $po;
            //exit();
            $res = mysqli_query($conn,$po);
            while ($row = $res->fetch_assoc()) {
                // echo $row['Fi'];
                // exit();
                    if($row['Fi'] == '0'){
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
                            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " ได้อัพโหลดเข้าไปยังระบบแล้ว.";
                            $insert = $conn->query("INSERT into images (Filen,uploaded_on) VALUES ('".$target_file1."', NOW())");
                            $update = $conn->query("UPDATE posts SET Fi = '2' WHERE email = '$em' ");
                        }
                    }
                    if($row['Fi'] == '1'){
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
                            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " อัพเดทไฟล์เรียบร้อยแล้ว.";
                            $id = $row['IdPosts'];
                            $update = $conn->query("UPDATE images SET Filen = '$target_file1' WHERE IdImg = '$id' ");
                            $update = $conn->query("UPDATE posts SET Fi = '2' WHERE email = '$em' ");
                        }
                    }
                    if($row['Fi'] == '2'){
                        header("location: repeatedly.php");
                        $uploadOk = 0;
                    }
                    // if($row['Fi'] == '1'){
                    //     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
                    //         echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " อัพเดทไฟล์เรียบร้อยแล้ว.";
                    //         $update = $conn->query("UPDATE images SET Filen = '$target_file1' WHERE IdImg = '$iduseremail' ");
                    //         $update = $conn->query("UPDATE posts SET Fi = '2' WHERE email = '$em' ");
                    //     }
                    // }
                    // if($row['Fi'] == '2'){
                    //         echo "เจอไฟล์ซ้ำ";
                    //         $uploadOk = 0;
                    //         exit();
                    // }else{
                    //     echo "ขัดข้องจ้า";
                    //     exit();
                    // }
                   
            }






            // if(mysqli_num_rows($res) > 0){
            //     while($row = mysqli_fetch_assoc($res)){
            //         $fi = $row['Fi'];
            //         echo $fi;
            //         exit();
            //         if($fi == '0'){
            //             if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //                 echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " ได้อัพโหลดเข้าไปยังระบบแล้ว.";
            //                 $insert = $conn->query("INSERT into images (Filen,uploaded_on) VALUES ('".$target_file1."', NOW())");
                       
            //             }
            //         }elseif($fi == '1'){
            //             if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //                 echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " อัพเดทไฟล์ในระบบแล้ว.";
            //                 $update = $conn->query("UPDATE images SET Filen = '$target_file1' WHERE IdImg = '$iduseremail' ");
            //             }
            //         }else{
            //             if(file_exists($target_file)){
            //                 echo "Sorry, file already exists.";
            //                 $uploadOk = 0;
            //             }
            //         }
                    
            //     }
            // }
        
            




            // $pid = $row['IdPosts']; 
            // $imgs = "SELECT * FROM images WHERE IdImg = '$pid' ";
            // $sqlqImg = mysqli_query($conn,$imgs);
            // if(mysqli_num_rows($sqlqImg)> 0){
            //     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //         echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been updated.";
            //         $insert = $conn->query("UPDATE images SET IdImg = '$pid' WHERE Filename");
            //     }
            // else{
            //     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //         echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            //         $insert = $conn->query("INSERT into images (Filen,uploaded_on) VALUES ('".$target_file1."', NOW())");
            //     } else {
            //         echo "Sorry, there was an error uploading your file.";
            //     }

            // }

            // }


            //dd
            // if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //     echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            //     $insert = $conn->query("INSERT into images (Filename,uploaded_on) VALUES ('".$target_file1."', NOW())");
            // } else {
            //     echo "Sorry, there was an error uploading your file.";
            // }


            
        }

    }


   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ข้อมูลประวัติส่วนตัว</title>
   
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="scripts/bootstrap.min.js"></script>

    <!--===============================================================================================-->	
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
    <meta name="description" content="A free template from http://ws-templates.com">
    <meta name="keywords" content="keyword1,keyword2"/>
    <link  href="css/screen.css" media="screen" rel="stylesheet"/>
    <link  href="css/style.css" media="screen" rel="stylesheet"/>
    <link rel="stylesheet" href="nivo-slider/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="nivo-slider/default/nivo-slider.css" type="text/css" media="screen" />
    <style type="text/css">
    #content{
   	width: 50%;
   	margin: 20px auto;
   	border: 0px solid #cbcbcb;
   }
   #content1{
   	width: 50%;
   	margin: 20px auto;
   	border: 1px solid #cbcbcb;
   }
   form{
   	width: 50%;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	float: left;
   	margin: 5px;
   	width: 300px;
   	height: 140px;
   }
   a.p_Button{
	display: block;
	height:26px;
	width:70px;
	background-color:#84cdf7;
	padding:8px 15px; 
	font-size:14px;
	color:white; 
	margin-bottom: 15px;
	text-align: center;
    }
   a.p_Button2{
	display: block;
	height:26px;
	width:70px;
	background-color:#878c8f;
	padding:8px 15px; 
	font-size:14px;
	color:white; 
	margin-bottom: 15px;
    text-align: center;
    }
    a.red{
        color:red; 
    }



    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
    th, td {
    padding: 5px;
    text-align: left;
    }
    </style>
    <script src="js/script.js"></script>


    
</head>
<body>
    <br/>
    <h1><center>Welcome to User Page!</center></h1>
    <br/>
    <h2><center>รายละเอียดของนักศึกษา</center></h2>
    <?php
    $sql ="SELECT * FROM posts WHERE email = '$iduseremail' ";
    $res = mysqli_query($conn , $sql) or die(mysqli_error($conn));
   

        if(mysqli_num_rows($res)> 0){
            while($row = mysqli_fetch_assoc($res)){
                $id = $row['IdPosts'];
                $username = $row['username'];
                $email = $row['email'];
                $Fname = $row['Firstname'];
                $lname = $row['Lastname'];
                $education = $row['Education'];
                $resume = $row['Resume'];
                $detail = $row['Detail'];

                
                // <!--ไว้กด upload image ยังไม่สมบูรณ์ ไม่มี PHP-->
                // เป็น HTML แยกออกมาเก็บไว้ก่อน
                // <div class='middel_div_right' align='center'>
                //     <form method='post' enctype='multipart/form-data'>
                //         <input type='hidden' value='1000000' name='MAX_FILE_SIZE' />
                //         <input type='file' name='uploadfile' />
                //         <input type='submit' name='submit' value='Upload' style='margin-top:10px; height:35px; width:75px;' />
                //     </form>
                // </div>

                // ฟอร์มดั้งเดิมที่ไม่ใช้แล้ว
                // <br/>
                // <div><center>
                // <h2>Username : $username</h2><br/>
                // <h3>Email : $email</h3><br/><br/><br/>
                // <h3>ชื่อ : $Fname</h3><br/>
                // <h3>นามสกุล : $lname</h3><br/>
                // <h3>การศึกษา : $education</h3><br/>
                // <h3>ความสนใจในการฝึกงาน : $resume</h3><br/>
                // <br/>

                // <h3>อัพโหลดResume : <h5><form action='detail.php' method='post' enctype='multipart/form-data'>
                // Select file to upload:
                // <input type='file' name='fileToUpload' id='fileToUpload'>
                // <input type='submit' value='Upload Image' name='submit'>
                // </form></h5>
                // </h3>


                // <br/>
                // <h3>รายละเอียดเกี่ยวกับตัวเอง : $detail</h3><br/>
                // <br/>

                $posts = "
                <br/>
                <table style='width:100%' >
               
                <tr>
                <th>หัวข้อ</th>
                <th>ข้อมูล</th>
                </tr>

                <tr>
                <td>Username : </td>
                <td>$username</td>
                </tr>

                <tr>
                <td>Email : </td>
                <td>$email</td>
                </tr>

                
                <tr>
                <td>ชื่อ : </td>
                <td>$Fname</td>
                </tr>

                
                <tr>
                <td>นามสกุล : </td>
                <td>$lname</td>
                </tr>

                
                <tr>
                <td>การศึกษา : </td>
                <td>$education</td>
                </tr>

                
                <tr>
                <td>ความสนใจในการฝึกงาน : </td>
                <td>$resume</td>
                </tr>

                <tr>
                <td>อัพโหลดResume : </td>
                <td><h5><form action='detail.php' method='post' enctype='multipart/form-data'>
                Select file to upload:
                <input type='file' name='fileToUpload' id='fileToUpload'>
                <input type='submit' value='Upload File' name='submit' class='btn btn-info'>
                </form></h5></td>
                </tr>

                

                <tr>
                <td>รายละเอียดเกี่ยวกับตัวเอง : </td>
                <td>$detail</td>
                </tr>

                </table>
                
                
                
                
                    <div class='container-login100-form-btn'>
                        <button class='btn btn-warning' >
                            <a href='editdetail.php' style='color:white'>Edit</a>
                        </button>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <button class='btn btn-danger' >
                            <a href='logout.php' style='color:white'>Logout</a>
                        </button>
                    </div>

                    

                </div>";
                

            }
            
            echo $posts;

        }else{
            echo "<center><br/>There are no posts to display!</center>";
            echo "<center><br/><a href='logout.php'>Logout</a></center>";
        }
    
    ?>
</body>
</html>