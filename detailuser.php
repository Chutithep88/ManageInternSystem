<?php
    session_start();
    include_once 'dbconnect.php';

    //$iduseremail = $_SESSION['email'];

    //admin
    //$sql ="SELECT * FROM admins WHERE email = '$iduseremail' ";

    //แสดงข้อมูล
    $query = "SELECT * FROM posts ORDER BY IdPosts DESC";
    $result = mysqli_query($conn,$query);

  
    ob_start();
   
    //ป้องกันไม่ให้เข้าถึงหน้านี้โดยไม่ผ่าน Login
    if(!isset($_SESSION['emailadmin'])){
        header("location: index.php");
        return;
    }

    //ฟังก์ชัน ส่งข้อความจากแอดมิน ถึง นักศึกษาฝึกงาน
    if(isset($_POST['send'])){
        $detail = $_POST['detail'];

        $ch = "SELECT * FROM comment ";
        $result = mysqli_query($conn,$ch) or die(mysqli_error($conn));

        $query = "INSERT INTO comment(Content)
                  VALUES('" . $detail . "'   )";
                  



                  if (mysqli_query($conn, $query)) {
                    //$msg_success = "<br/><br/><h3><center><font color='white'>Successfully registered! <br/>Please check your email to activate account</font></center></h3>";
                    echo "ส่งข้อความเสร็จสิ้น";
                    //ปุ๋มล็อกอินของเก่า
                    //<br/><br/><center><button class='login100-form-btn'><a href='index.php'>Click here to login</a></button></center>
    
                    //ส่งอีเมล์ไปยัง user เพื่อแจ้งให้ Activate ID
    
                    //$Uid = mysqli_insert_id($conn);
                    
    
                    // $strTo = $_POST['email'];
                    // $strSubject = "Activate Member account";
                    // $strHeader = "Content-type: text/html; charset=UTF-8";
                    // $strHeader .= "From: phptestlnwza@gmail.com\nReply-To: phptestlnwza@gmail.com";
                    // $strMessage= "";
                    // $strMessage .= "Welcome : ".$_POST['username']." <br/>";
                    // $strMessage .= "=================================<br>";
                    // $strMessage .= "Activate account click here.<br/>";
                    // $strMessage .= "http://localhost/pharmacyintern/activate.php?sid=".session_id()."&uid=".$Uid."<br>";
                    // $strMessage .= "=================================<br>";
                    // $strMessage .= "PharmacyIntern PSU.com";
    
                    // $flgSend = mail($strTo,$strSubject,$strMessage,$strHeader);
    
    
                    //ส่งเมล์แจ้งเตือนไปยัง Admin ว่ามี User ได้สมัครเข้ามาในระบบแล้ว
    
                    // $strTo = phptestlnwza@gmail.com;
                    // $strSubject = "มี User เข้ามาสมัครแล้ว";
                    // $strHeader = "Content-type: text/html; charset=UTF-8";
                    // $strHeader .= "From: phptestlnwza@gmail.com\nReply-To: phptestlnwza@gmail.com";
                    // $strMessage= "";
                    // $strMessage .= "Welcome : ".$_POST['username']." <br/>";
                    // $strMessage .= "=================================<br>";
                    // $strMessage .= "นักศึกษา.<br/>";
                    // $strMessage .= "http://localhost/pharmacyintern/activate.php?sid=".session_id()."&uid=".$Uid."<br>";
                    // $strMessage .= "=================================<br>";
                    // $strMessage .= "PharmacyIntern PSU.com";
    
                    // $flgSend = mail($strTo,$strSubject,$strMessage,$strHeader);
    
    
                    
    
                    } else {
                        // $msg_error = "<br/><br/><h3><center><font color='white'>Error in registration, please try again!</font></center></h3>
                        // <br/><br/><center><button class='login100-form-btn'><a href='register.php'>Click here to Register again</a></button></center>";
                        
                        //when user cant register correctly. it'll sent to failregister.php
                        echo "มีปัญหา กรุณาลองใหม่อีกครั้ง";
                    }
                
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ข้อมูลของนักศึกษา</title>
   
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



    .label {
    width: 150px;
    }
    .field, .label {
        float: left;
        border: 1px solid white;   
        padding: 40px;
        margin: 4px;
    }

    .clear {
        clear:both;   
    }

    #left {
    float:left;
    width:100px;
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

    $pid = $_GET['pid'];
    $sql ="SELECT * FROM posts WHERE IdPosts = '$pid' ";
    $res = mysqli_query($conn , $sql) or die(mysqli_error($conn));

    //เมื่อกดแล้วจะทำการเปลี่ยน field in posts , 0 = default , 1=accept , 2=Notaccept
    if(isset($_POST['Asubmit'])){
        $pid = $_GET['pid'];
        $sqlup =  "UPDATE posts SET Pass = '1' WHERE IdPosts = '$pid' ";
        $res1 = mysqli_query($conn, $sqlup);
        header("location: adminpage.php");

        // เมื่่อแอดมินกดรับจะทำการส่งเมล์แจ้งเตือนว่า User ได้ถูกรับเข้าฝึกงานแล้ว
            // $strTo = $_POST['email'];
            // $strSubject = "ยินดีด้วย! คุณได้รับเข้าฝึกงานแล้ว";
            // $strHeader = "Content-type: text/html; charset=UTF-8";
            // $strHeader .= "From: phptestlnwza@gmail.com\nReply-To: phptestlnwza@gmail.com";
            // $strMessage= "";
            // $strMessage .= "Welcome : ".$_POST['username']." <br/>";
            // $strMessage .= "=================================<br>";
            // $strMessage .= "ได้รับเข้าฝึกงานแล้ว คลิ้กเว็บเพื่อเข้าระบบตรวจสอบอีกทีหนึ่ง.<br/>";
            // $strMessage .= "http://localhost/pharmacyintern/index.php"<br>";
            // $strMessage .= "=================================<br>";
            // $strMessage .= "PharmacyIntern PSU.com";

            // $flgSend = mail($strTo,$strSubject,$strMessage,$strHeader);

    }
    if(isset($_POST['Nsubmit'])){
        $pid = $_GET['pid'];
        $sqlup =  "UPDATE posts SET Pass = '2' WHERE IdPosts = '$pid' ";
        $res1 = mysqli_query($conn, $sqlup);
        header("location: adminpage.php");

        // เมื่่อแอดมินกดรับจะทำการส่งเมล์แจ้งเตือนว่า User ไม่ได้ถูกรับเข้าฝึกงานแล้ว
            // $strTo = $_POST['email'];
            // $strSubject = "ขอแสดงความเสียใจ คุณไม่ได้รับการเข้าฝึกงาน";
            // $strHeader = "Content-type: text/html; charset=UTF-8";
            // $strHeader .= "From: phptestlnwza@gmail.com\nReply-To: phptestlnwza@gmail.com";
            // $strMessage= "";
            // $strMessage .= "Welcome : ".$_POST['username']." <br/>";
            // $strMessage .= "=================================<br>";
            // $strMessage .= "คุณไม่ได้รับเข้าฝึกงานที่ศูนย์เทคโนโลยีสารสนเทศ คณะเภสัชศาสตร์ คลิ้กลิ้งเพื่อตรวจสอบเพิ่มเติม<br/>";
            // $strMessage .= "http://localhost/pharmacyintern/index.php"<br>";
            // $strMessage .= "=================================<br>";
            // $strMessage .= "PharmacyIntern PSU.com";

            // $flgSend = mail($strTo,$strSubject,$strMessage,$strHeader);


    }

    if(isset($_POST['Dsubmit'])){
        $pid = $_GET['pid'];
        $sqlup =  "UPDATE posts SET Pass = '0' WHERE IdPosts = '$pid' ";
        $res1 = mysqli_query($conn, $sqlup);
        header("location: adminpage.php");

    }


    if(isset($_POST['update'])){
        $pid = $_GET['pid'];
        $sqlup =  "UPDATE posts SET Fi = '1' WHERE IdPosts = '$pid' ";
        $res1 = mysqli_query($conn, $sqlup);
        header("location: adminpage.php");

        // เมื่่อแอดมินกดรับจะทำการส่งเมล์แจ้งเตือนว่า User ได้ถูกรับเข้าฝึกงานแล้ว
            // $strTo = $_POST['email'];
            // $strSubject = "ยินดีด้วย! คุณได้รับเข้าฝึกงานแล้ว";
            // $strHeader = "Content-type: text/html; charset=UTF-8";
            // $strHeader .= "From: phptestlnwza@gmail.com\nReply-To: phptestlnwza@gmail.com";
            // $strMessage= "";
            // $strMessage .= "Welcome : ".$_POST['username']." <br/>";
            // $strMessage .= "=================================<br>";
            // $strMessage .= "ได้รับเข้าฝึกงานแล้ว คลิ้กเว็บเพื่อเข้าระบบตรวจสอบอีกทีหนึ่ง.<br/>";
            // $strMessage .= "http://localhost/pharmacyintern/index.php"<br>";
            // $strMessage .= "=================================<br>";
            // $strMessage .= "PharmacyIntern PSU.com";

            // $flgSend = mail($strTo,$strSubject,$strMessage,$strHeader);

    }



    
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

            }
        
           
            
            

        }else{
            echo "<center><br/>There are no posts to display!</center>";
            echo "<center><br/><a href='logout.php'>Logout</a></center>";
        }
        
    
    ?>


   <br/>
                <table style='width:100%' >
               
                    <tr>
                    <th>หัวข้อ</th>
                    <th>ข้อมูล</th>
                    </tr>

                    <tr>
                    <td>Username:</td>
                    <td><?php echo $username; ?></td>
                    </tr>

                    <tr>
                    <td>Email:</td>
                    <td><?php echo $email; ?></td>
                    </tr>

                    
                    <tr>
                    <td>ชื่อ:</td>
                    <td><?php echo $Fname; ?></td>
                    </tr>

                    
                    <tr>
                    <td>นามสกุล:</td>
                    <td><?php echo $lname; ?></td>
                    </tr>

                    
                    <tr>
                    <td>การศึกษา:</td>
                    <td><?php echo $education; ?></td>
                    </tr>

                    
                    <tr>
                    <td>ความสนใจในการฝึกงาน:</td>
                    <td><?php echo $resume; ?></td>
                    </tr>

                    <tr>
                    <td>รายละเอียดเกี่ยวกับตัวเอง:</td>
                    <td><?php echo $detail; ?></td>
                    </tr>

                </table>

                <!-- ระบบกรอกข้อคาวามเพื่อให้ขึ้นไปโผล้หน้าของ User ยังไม่สมบูรณ์จึงไม่นำมาใช้ออกมาก่อน -->
                <!-- <div class='field'>
                    <form role="form" action="detailuser.php?pid=<?php //echo $id;?>" method="post" name="signupform">
                        <h3>กรอกข้อความ</h3>
                        <textarea class="input" type="text" name="detail" wrap="hard" id="txt" onkeyup="checknum(document.getElementById('txt').value,document.getElementById('shownum'));"></textarea>
                        <input type="submit" name="send" value="Send" class="input input--submit" />
                    </form>
                </div> -->

                <?php
                $query = $conn->query("SELECT * FROM images WHERE IdImg = '$pid' ");
                if($query->num_rows > 0){
                    while($row = $query->fetch_assoc()){
                        $fileURL = 'uploads/'.$row["Filen"];
                    }
    
                    if($query = $pid){
                        $msgdl = "<a href='$fileURL' download>Download PDF file</a>";
                    }
                    else{
                        $msgno = "None of PDF FIle";
                        echo $msgno;
                    }
    
                }

               

                $posts = "
                
               
                

                <br/>

                <div>
                    <form action='detailuser.php?pid=$id' method='post' name='form1'>
                        <div class='field'>
                            <h4>ส่วนของการจัดการ รับ ไม่รับ หรือตั้งรอพิจารณา นักศึกษาฝึกงาน</h4>
                            <br/>
                            <button type='submit' name='Asubmit' value='รับ' class='btn btn-success' >
                            รับ
                            </button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type='submit' name='Nsubmit' value='ไม่รับ' class='btn btn-warning' style='color:white'>
                            ไม่รับ
                            </button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type='submit' name='Dsubmit' value='ตั้งให้เป็นรอการพิจารณา' class='btn btn-info' >
                            ตั้งให้เป็นรอการพิจารณา
                            </button>
                        </div>
                        
                        
                        <div class='field'>
                            <h4>ส่วนการตั้งค่า การอัพโหลดไฟล์ หรือ อัพทเดทไฟล์ Resume ของนักศึกษา</h4>
                            <br/>
                            <button type='submit' name='update' value='Update' class='btn btn-success' style='color:white'>
                            ตั้งให้ Update
                            </button>
                        </div>
                        
                        <div class='field'>
                            <h4>ส่วนการโหลดไฟล์ Resume ของนักศึกษา</h4>
                            <h5 style='color:red'>*ถ้าขึ้นแจ้งเตือนด้านใต้ตารางประมาณว่า</h5>
                            <h5 style='color:red'>Notice: Undefined variable: fileURL in C:\xampp\htdocs\PharmacyIntern\detailuser.php on line...</h5>
                            <h5 style='color:red'>หมายความว่านักศึกษายังไม่มีการอัพโหลดไฟล์เข้าระบบ*</h5>
                            <h5 style='color:green'>**แต่ถ้าไม่ขึ้นแจ้งเตือนและกดโหลดไฟล์ได้แสดงว่านักศึกษาได้อัพโหลดไฟล์แล้ว**</h5>
                            <br/>
                            <button class='btn btn-primary' >
                                <a href='$fileURL' style='color:white' download>Download PDF file</a>
                            </button>
                        </div>

                        <div class='field'>
                            <h4>ย้อนกลับ หรือ ออกจากระบบ</h4>
                            <br/>
                            <button class='btn btn-danger' >
                            <a href='logout.php' style='color:white'>ออกจากระบบ</a>
                            </button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button class='btn btn-default' >
                            <a href='adminpage.php' style='color:black'>ย้อนกลับ</a>
                            </button>
                        </div>


                        

                        
                        
                    </form>

                   
                   
                </div>

                









                   
                   
                </div>
                
                
                
                
                ";
                

            
        
                echo $posts;
                ?>
            
                
    
</body>
</html>