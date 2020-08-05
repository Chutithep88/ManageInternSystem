<?php 
    session_start();
    include_once 'dbconnect.php';

    //ป้องกันไม่ให้เข้าถึงหน้านี้โดยไม่ผ่าน Login
    if(!isset($_SESSION['emailadmin'])){
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
    <title>คู่มือการเข้าใช้งานระบบจัดการนักศึกษาฝึกงาน</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="scripts/bootstrap.min.js"></script>

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

    
    </style>
    <script src="js/script.js"></script>

</head>
<body>
    <br>
    <center>
        <h3>คู่มือการเข้าใช้งานระบบของแอดมิน</h3>
    </center>
    
    <table style='width:100%' border="1">
                    <b>ส่วนของการใช้งานเบื้องต้น</b>
                    <tr>
                        <td style="color:red">เมื่อเข้าระบบมาแล้วสามารถทำอะไรได้บ้าง</td>
                        <td style="color:green">สามารถดูรายชื่อนักศึกษาที่สมัครเข้ามาในระบบ , 
                        กดดูข้อมูลเพิ่มเติมได้ Open , 
                        Delete ลบข้อมูนักศึกษาได้,
                        ดูคู่มือการจัดการระบบแอดมิน ,
                        ตรวจสอบการสถานะการอัพโหลดไฟล์ของนักศึกษาได้ ,
                        ถ้ารับนักศึกษาแล้วก็ตรวจสอบตรง 'สถานะ' ว่ารับหรือยัง ,
                        Logout เพื่อออกจากระบบ
                        </td>
                    </tr>
                    <tr>
                        <td style="color:red">เมื่อ Open เข้าไปดูจะมีรายการจัดการเพิ่มขึ้นมา</td>
                        <td style="color:green">1.ส่วนของการจัดการ รับ ไม่รับ หรือตั้งรอพิจารณา นักศึกษาฝึกงาน
                        ->กดรับ ไม่รับ นักศึกษา</td>
                    </tr>
                    <tr>
                        <td style="color:red">เมื่อ Open เข้าไปดูจะมีรายการจัดการเพิ่มขึ้นมา</td>
                        <td style="color:green">2.ส่วนการตั้งค่า การอัพโหลดไฟล์ หรือ อัพทเดทไฟล์ Resume ของนักศึกษา
                        ->เมื่อนักศึกษาอัพโหลดไฟล์แต่ต้องการแก้ไขไฟล์เพิ่มเติม เมื่อกดปุ๋มจะเป็นการอนุญาติให้นักศึกษาอัพโหลดไฟล์ใหม่ได้อีกครั้ง
                        (นักศึกษาอัพโหลดไฟล์ได้แค่ครั้งเดียว ถ้าต้องการอัพโหลดแก้ไขต้องให้แอดมินอนุญาติ)</td>
                    </tr>
                    <tr>
                        <td style="color:red">เมื่อ Open เข้าไปดูจะมีรายการจัดการเพิ่มขึ้นมา</td>
                        <td style="color:green">3.ส่วนการโหลดไฟล์ Resume ของนักศึกษา</td>
                    </tr>
                    <tr>
                        <td style="color:red">เมื่อ Open เข้าไปดูจะมีรายการจัดการเพิ่มขึ้นมา</td>
                        <td style="color:green">4.ย้อนกลับ หรือ ออกจากระบบ</td>
                    </tr>
        



    </table>
    <br/>  
            <table style='width:100%' border="1">
                 <tbody>
                 <b>ส่วนของปัญหา</b>
                    <tr>
                        <td style="color:red">ทำไมโหลดไฟล์ไม่ใช้ไฟล์ Resumeของนักศึกษา?</td>
                        <td style="color:green">เพราะนักศึกษายังไม่ได้อัพโหลดไฟล์เข้าระบบ ตรวจสอบการสถานะการอัพโหลดไฟล์ของนักศึกษาได้ในหน้าจัดการแอดมิน</td>
                    </tr>
                </tbody>
             </table>
    <br/>
   
    <center>
        <button class='btn btn-primary' >
            <a href='adminpage.php' style='color:white'>ย้อนกลับ</a>
        </button>
    </center>
 
    <br><br>

    <center>
        <button class='btn btn-danger' >
            <a href='logout.php' style='color:white'>Logout</a>
        </button>
    </center>
    
    
    
</body>
</html>