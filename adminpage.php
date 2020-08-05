<?php 
    session_start();
    include_once 'dbconnect.php';

    $query = "SELECT * FROM posts ORDER BY IdPosts DESC";
    $result = mysqli_query($conn,$query);

    //ป้องกันไม่ให้เข้าถึงหน้านี้โดยไม่ผ่าน Login
    if(!isset($_SESSION['emailadmin'])){
        header("location: index.php");
        return;
    }


    //delete record
    if(isset($_GET['id'])){
        $query = "DELETE FROM posts
                 WHERE IdPosts = ".$_GET['id'];
        
        mysqli_query($conn,$query);
        header("Location: adminpage.php");
    }

    
    


?>
 <!DOCTYPE html>
 <html>
 <head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <title>ส่วนการจัดการของแอดมิน</title>
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
 <nav class="navbar navbar-default" role="navigation">
     <div class="container-fluid">
     	<!-- add header -->
     	<div class="navbar-header">
     		<!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
         		<span class="sr-only">Toggle navigation</span>
         		<span class="icon-bar"></span>
         		<span class="icon-bar"></span>
         		<span class="icon-bar"></span>
    		</button> -->
     		<!-- <a class="navbar-brand" href="index.php">Admin : Manage Users</a> -->
     	</div>
     	<!-- menu items -->
     	<!-- <div class="collapse navbar-collapse" id="navbar1">
     		<ul class="nav navbar-nav navbar-right">
     			<li><a href="login.php">Login</a></li>
     			<li><a href="register.php">Sign Up</a></li>
     			<li class="active"><a href="admin_login.php">Admin</a></li>
     		</ul>
     	</div> -->
     </div>
 </nav>

 <div class="container">
     <div class="row">
         <div class="col-xs-8 col-xs-offset-2">
             <legend>แสดงรายชื่อนักศึกษาฝึกงาน</legend>
             <button class='btn btn-info' >
                <a href='guideadmin.php' style='color:white'>คู่มือการใช้ระบบจัดการนักศึกษา(สำหรับAdmin)</a>
            </button>
            <h1></h1>
            <br/>
            <div class="table-responsive">
             <table class="table table-bordered table-hover">
                 <thead>
                     <tr>
                         <th>ID</th>
                         <th>User Name</th>
                         <th>E-Mail</th>
                         <th>Password</th>
                         <th colspan="2" style="text-align:center">Actions</th>
                         <th >สถานะ</th>
                         <th>Resume File</th>
                         
                         
                     </tr>
                 </thead>
                 <tbody>
                 <tr>


                
                 <?php while ($row = mysqli_fetch_array($result)) {?>
                    <?php $id = $row['IdPosts']; $pass = $row['Pass']?>
                    <td><?php echo $row['IdPosts'];?></td>
                    <td><?php echo $row['username'];?> </td>
                    <td><?php echo $row['email'];?> </td>
                    <td><?php echo $row['password'];?> </td>
                    <td>
                    
                    <?php 
                    //ปุ๋มเปิดดูข้อมูล Users
                    $posts = "<div><h2><a href='detailuser.php?pid=$id' class='btn btn-success'>Open</a></h2></div>"; 
                    echo $posts; 
                    ?>

                    <!-- อันนี้มันทำค่า pid แล้วไล่ตาม $id ไม่ได้ เก็บไว้ก่อนเพื่อสามารถแก้ให้มันใช้ได้ -->
                    <!-- <input type="button" name="open" value="Open" class="btn btn-primary" onclick="open_user()" > -->
                   
                    </td>
                    <td>
                    <div style="line-height:135%;">
                        <br>
                    </div>
                    <input type="button" name="delete" value="Delete" class="btn btn-primary" onclick="delete_user(<?php echo $row['IdPosts'];?>)">
                    </td>
                    <td>
                    <?php
                    //ตั้งค่าการแสดงผล ในหน้าแอดมิน 1 คือ รับ 2 คือ ไม่รับ 0 คือ รอการพิจารณา
                        if($row['Pass'] == '1'){
                            echo "รับ";
                        }elseif($row['Pass'] == '2'){
                            echo "ไม่รับ";
                        }else{
                            echo "รอพิจารณา";
                        }
                    ?>
                    </td>

                    <td>
                    <?php
                    //ตั้งค่าการแสดงผล ในหน้าแอดมิน 0 คือ Insert ปกติ (ค่า Default) 1 คือ ปล่อยให้นักศึกษาสามารถUpdate File ได้ 
                    //และ 2 คือ กันไม่ให้นักศึกษา User อัพโหลดไฟล์หลังจากอัพโหลดไฟล์เสร็จสิ้นไปแล้ว
                        if($row['Fi'] == '0'){
                            echo "ยังไม่มีการอัพโหลด";
                        }elseif($row['Fi'] == '1'){
                            echo "ให้อัพเดทเพิ่ม";
                        }else{
                            echo "อัพโหลดไฟล์เรียบร้อย";
                        }
                    ?>
                    </td>

                 </tr>
                 <?php } ?>
                 </tbody>
             </table>
            </div>
            <h1><center><a href="logout.php" class='btn btn-danger'>Log out</a></center></h1>
            <!--display number of records -->
            <div class="panel-footer"></div>
         </div>
     </div>
 </div>
 <script>
    function delete_user(id){
        if (confirm('Confirm to delete this ID')){
            window.location.href="adminpage.php?id="+id;
        }
    }
 </script>
 </body>
 </html>
