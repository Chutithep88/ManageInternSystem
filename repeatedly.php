<?php
    session_start();
    include_once 'dbconnect.php';
    $iduseremail = $_SESSION['email'];
    
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
    <title>ไฟล์ซ้ำ</title>
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
    <h3><center>เจอไฟล์ซ้ำ</center></h3>
    <h4><center>คุณได้อัพโหลดไฟล์ไปแล้ว กรุณาแจ้งแอดมินถ้าต้องการอัพโหลดไฟล์เพิ่มเติม</center></h4>
    <h4><center>Tel : 000-000-000-000-000</center></h4>
    <div align="center">
        <button class='btn btn-danger' >
            <a href='detail.php' style='color:white' style=''>ย้อนกลับ</a>
        </button>
    </div>
    
</body>
</html>