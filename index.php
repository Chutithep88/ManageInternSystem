<?php
	//start using session
	session_start();

	//connect with database
	include_once 'dbconnect.php';

	//check if form is submitted
	if (isset($_POST['login'])) {
		//ส่วน user
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$passwd = mysqli_real_escape_string($conn,$_POST['password']);

		//ส่วน admin
		$emailadmin = mysqli_real_escape_string($conn,$_POST['email']);
		$passwdadmin = mysqli_real_escape_string($conn,$_POST['password']);

		//sql command and ตั้งให้ ถ้า จะล็อกอิน ไอดีนั้นๆ ต้องมีค่า Active = Yes เท่านั้นมิเช่นนั้นจะ Login ไม่ได้
		//ส่วน user
		$query = "SELECT * FROM posts WHERE 
				  email ='" . $email . "' AND 
				  password ='" . md5($passwd) . "'     ";

				//เก็บไว้ใช้เมื่อระบบ ล็อกอิน แบบยืนยันผ่านเมล์เสร็จ
				//AND Active = '" . 'Yes' . "' 

		//ส่วน admin	
		$queryadmin = "SELECT * FROM admins WHERE 
		emailadmin ='" . $emailadmin . "' AND 
		password ='" . md5($passwdadmin) . "'     ";

				  
		//execute sql command
		$result = mysqli_query($conn, $query);
		$resultadmin = mysqli_query($conn, $queryadmin);
		//check whether there is result from table
		if ($row = mysqli_fetch_array($result)) {
			//store name in php session เทียบไอดีพาสในส่วนของ users
			$_SESSION['email'] = $row['email'];
			$em = $_SESSION['email'];
			$rs = "SELECT * FROM posts";
			$res = mysqli_query($conn ,$rs);
			//em คือตัวแปรที่มีค่าเซสชั่น email ตอนล็อกอิน ใช้ฟังชั้นก์ if เพื่อดูคอลั่ม Pass วันอันไหนเป็นสถานะอะไร
			// 0 คือ รอการพิจารณา , 1 คือ รับ , 2 คือ ไม่รับ
			if($em){
				if($row['Pass'] == '1'){
					header("location: accept.php");
				}
				if($row['Pass'] == '2'){
					header("location: notaccept.php");
				}
				if($row['Pass'] == '0'){
					header("location: detail.php");
				}
			}
		} elseif ($row = mysqli_fetch_array($resultadmin)){
			//เทียบไอดีพาสในส่วนของ admins
			$_SESSION['emailadmin'] = $row['emailadmin'];
			header("location: adminpage.php");
		} else {
			$error_msg = "Incorrect email or password!";
			echo $error_msg;
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ระบบนักศึกษาฝึกงาน-PharmacyIntern</title>
    <link rel="stylesheet" href="css/bootstrap.min">
    <script src="scripts/bootstrap.min.js"></script>
  
	<style>
		html, body {
		width: 100%;
		height: 100%;
		margin: 0;
		font-family: Helvetica, Arial, sans-serif;
		overflow: hidden;
		}

		.ghost {
		position: absolute;
		left: -100%;
		}

		.framed {
		position: absolute;
		top: 50%; left: 50%;
		width: 25rem;
		margin-left: -12.5rem;
		}

		.logo {
		margin-top: -12em;
		cursor: default;
		}

		.form {
		margin-top: -4.5em;
		transition: 1s ease-in-out;
		}

		.input {
		-moz-box-sizing: border-box;
			box-sizing: border-box;
		font-size: 1.125rem;
		line-height: 3rem;
		width: 100%; height: 3rem;
		color: #444;
		background-color: rgba(255,255,255,.9);
		border: 0;
		border-top: 1px solid rgba(255,255,255,0.7);
		padding: 0 1rem;
		font-family: 'Open Sans', sans-serif;
		}
		.input:focus {
			outline: none;
		}
		.input--top {
			border-radius: 0.5rem 0.5rem 0 0;
			border-top: 0;
		}
		.input--submit {
			background-color: rgba(92,168,214,0.9);
			color: #fff;
			font-weight: bold;
			cursor: pointer;
			border-top: 0;
			border-radius: 0 0 0.5rem 0.5rem;
			margin-bottom: 1rem;
		}

		.text {
		color: #fff;
		text-shadow: 0 1px 1px rgba(0,0,0,0.8);
		text-decoration: none;
		}
		.text--small {
			opacity: 0.85;
			font-size: 0.75rem;
			cursor: pointer;
		}
			.text--small:hover {
			opacity: 1;
			}
		.text--omega {
			width: 200%;
			margin: 0 0 1rem -50%;
			font-size: 1.5rem;
			line-height: 1.125;
			font-weight: normal;
		}
		.text--centered {
			display: block;
			text-align: center;
		}
		.text--border-right {
			border-right: 1px solid rgba(255,255,255,0.5);
			margin-right: 0.75rem;
			padding-right: 0.75rem;
		}

		.legal {
		position: absolute;
		bottom: 1.125rem; left: 1.125rem;
		}

		.photo-cred {
		position: absolute;
		right: 1.125rem; bottom: 1.125rem;
		}

		.fullscreen-bg {
		position: fixed;
		z-index: -1;
		top:0; right:0; bottom:0; left:0;
		background: url(img/index.png) center;
		background-size: cover;
		}

		#toggle--login:checked ~ .form--signup { left:200%; visibility:hidden; }
		#toggle--signup:checked ~ .form--login { left:-100%; visibility:hidden; }

		@media (height:300px){.legal,.photo-cred{display:none}}
	</style>

</head>
<body>
	<input type="radio" checked id="toggle--login" name="toggle" class="ghost" />
	<input type="radio" id="toggle--signup" name="toggle" class="ghost" />
	

	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	
	<label><b><center><h1 style="background-color:#FCF3CF;" >ระบบจัดการนักศึกษาฝึกงาน</h1></center></b></label>
		
	
	<form role="form" action="index.php" method="post" name="loginform" class="form form--login framed">
		
		<input type="email" name="email" placeholder="Email" class="input input--top" />
		<input type="password" name="password" placeholder="Password" class="input" />
		<input type="submit" name="login" value="Log in" class="input input--submit" />
		<label><b><a href="register.php"><center>Sign up</center></a></b></label>

		<label><b><a href="guide.php"><center>คู่มือการเข้าใช้ระบบ(สำหรับนักศึกษา)</center></a></b></label>
		<label><b><a href="about.php"><center>เกี่ยวกับผู้พัฒนาระบบจัดการนักศึกษาฝึกงาน</center></a></b></label>
	</form>
	
	
	<div class="fullscreen-bg"></div>


	
</body>
</html>