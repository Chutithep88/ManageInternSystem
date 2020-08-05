<?php
    include_once 'dbconnect.php';
    session_start();
    

    if (isset($_POST['signup'])) {
		//3.save data into posts table เก็บข้อมูลไว้ในตัวแปรของ posts table
        $name = mysqli_real_escape_string($conn,$_POST['username']);
		$email = $_POST['email'];
		$passwd = $_POST['password'];
        $cpasswd = $_POST['confirmpassword'];
        $Fname = $_POST['firstname'];
        $Lname = $_POST['lastname'];
        $edu = $_POST['education'];

        //ตัวนี้ไม่ใช้ตัวรับข้อมูล resume แต่เป็นการเก็บข้อมูล "ความสนใจในการฝึกงาน"
        $resume = $_POST['resume'];

        $detail = $_POST['detail'];
        
       

        
        //เพิ่มข้อมูล(เช็คว่ามีการกรอกพาสเวิสเหมือนกันหรือไม่ และ ไอดี พาสเวิส รายละเอียดของนักศึกษาฝึกงานเข้าไปในดาต้าเบส)
		if ($passwd != $cpasswd) {
			$passwd_error = "Password and Confirm Password ไม่ตรงกัน!";
		} else {
            //ตั้งให้ตัวแปรมีการเก็บค่า username and email เพื่อไปเช็คใน DB ว่ามีช้อมูลเดิมอยู่แล้วรึไม่
            $chuser = "SELECT * FROM posts WHERE username = '$name' ";
            $result1 = mysqli_query($conn,$chuser) or die(mysqli_error($conn));
            $chemail = "SELECT * FROM posts WHERE email = '$email' ";
            $result2 = mysqli_query($conn,$chemail) or die(mysqli_error($conn));
            
            if(mysqli_num_rows($result2) > 0){
                echo "อีเมล์นี้มีคนใช้แล้ว กรุณากรอกอีเมล์ใหม่ค่ะ";
                $emailmiss = "<br/><br/><a href='register.php'>Click to Register again</a> ";
                echo $emailmiss;
                exit();
            }else if(mysqli_num_rows($result1) > 0){
                echo "นามแฝงนี้มีคนใช้แล้ว กรุณากรอกนามแฝงใหม่ค่ะ";
                $emailmiss = "<br/><br/><a href='register.php'>Click to Register again</a> ";
                echo $emailmiss;
                exit();
            }else{
                echo "นามแฝงและอีเมล์ไม่ซ้้ำค่ะ";
            }

 
            //เพิ่มข้อมูลลง DB
			$query = "INSERT INTO posts(username,email,password,Firstname,Lastname,Education,Resume,Detail,SIDd,Active,Pass)
				  VALUES('" . $name . "','" . $email . "','"
                  . md5($passwd) . "' , 
                  '" . $Fname . "' , '" . $Lname . "' ,
                   '" . $edu . "' , '" . $resume . "' , 
                   '" . $detail . "','" .session_id() . "','" . 'No' . "' , '" . '0' . "'   )";

			if (mysqli_query($conn,$query)) {
                //$msg_success = "<br/><br/><h3><center><font color='white'>Successfully registered! <br/>Please check your email to activate account</font></center></h3>";
                header("location: successregister.php");
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

			}else{
                // $msg_error = "<br/><br/><h3><center><font color='white'>Error in registration, please try again!</font></center></h3>
                // <br/><br/><center><button class='login100-form-btn'><a href='register.php'>Click here to Register again</a></button></center>";
                
                //when user cant register correctly. it'll sent to failregister.php
                header("location: failregister.php");
			}
		}
        
       
					 
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>สมัครสมาชิก</title>
    <link rel="stylesheet" href="css/w3.css">
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
		margin-top: -19em;
		cursor: default;
		}

		.form {
		margin-top: -13.0em;
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
		background: url(img/register.jpg) center;
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
	
	<label><b><center><h1 style="background-color:#FCF3CF;" >สมัครสมาชิก</h1></center></b></label>

	<form role="form" action="register.php" method="post" name="signupform" class="form form--login framed">
        <input class="input" type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password" class="input" />
        <input class="input" type="password" name="confirmpassword" placeholder="ConfirmPassword">
        <span class="text-danger">
		<?php 
			if (isset($passwd_error)){
			echo $passwd_error;
			}
		?>
		</span>
        <input type="email" name="email" placeholder="Email" class="input input--top" />
        <input class="input" type="text" name="firstname" placeholder="ชื่อ">
        <input class="input" type="text" name="lastname" placeholder="นามสกุล">
        <input class="input" type="text" name="education" placeholder="การศึกษา">
        <input class="input" type="text" name="resume" placeholder="ความสนใจในการฝึกงาน">
		<textarea class="input" type="text" name="detail" placeholder="รายละเอียดเกี่ยวกับตัวเอง(ไม่เกิน 300 ตัวอักษร)" wrap="hard" id="txt" onkeyup="checknum(document.getElementById('txt').value,document.getElementById('shownum'));"></textarea>
		<span id="shownum"></span>
        <input type="submit" name="signup" value="Register" class="input input--submit" />
        
		
		<label><b><a href="index.php"><center>Login</center></a></b></label>
	</form>
	



	<div class="fullscreen-bg"></div>

		
    </form>
                <!--display message -->
                <span class="text-success">
                    <?php
                        if (isset($msg_success)) {
                            echo $msg_success;
                        }
                    ?>
                </span>
                <span class="text-danger">
                    <?php 
                        if (isset($msg_error)) {
                            echo $msg_error;
                        }
                    ?>
                </span>






<!-- <div class="limiter">
		<div class="container-login100" style="background-image: url('');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" role="form" action="register.php" method="post" name="signupform">
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Register
					</span>

					<div class="wrap-input100 validate-input" data-validate="Enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter confirmpassword">
						<input class="input100" type="password" name="confirmpassword" placeholder="ConfirmPassword">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
                        <span class="text-danger">
						
						</span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter email">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>
                    
                    <div class="wrap-input100 validate-input" data-validate = "Enter firstname">
						<input class="input100" type="text" name="firstname" placeholder="ชื่อ">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Enter lastname">
						<input class="input100" type="text" name="lastname" placeholder="นามสกุล">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Enter education">
						<input class="input100" type="text" name="education" placeholder="การศึกษา">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <!- name ยังคงเป็นตัวแปร resume เหมือนเดิม ของจริงคือ ตัวเก็บข้อมูล ความสนใจในการฝึกงาน-->
                    <!-- <div class="wrap-input100 validate-input" data-validate = "Enter resume">
						<input class="input100" type="text" name="resume" placeholder="ความสนใจในการฝึกงาน">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div> -->
                    

                    <!-- <div class="wrap-input100 validate-input" data-validate = "Enter datail">    
                            <textarea class="input100" type="text" name="detail" placeholder="รายละเอียดเกี่ยวกับตัวเอง"  
                            rows="10" cols="45"></textarea> -->
                        <!-- <form action="#" method="post" enctype="multipart/form-data">
                            <textarea placeholder="Content" name="content" rows="10" cols="45"></textarea><br />
                        </form> -->
						<!-- <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>
                   
                    <br />
                    <br/> -->

					

					<!-- <div class="container-login100-form-btn">
						<button type="submit" name="signup" value="Sign Up and Upload Image"  class="login100-form-btn">
                            Confirm
                        </button>
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <button class="login100-form-btn">
                            <a href="index.php">Cancel</a>
                        </button>
					</div> -->

					
                </form>
                <!--display message -->
                <span class="text-success">
                    <?php
                        if (isset($msg_success)) {
                            echo $msg_success;
                        }
                    ?>
                </span>
                <span class="text-danger">
                    <?php 
                        if (isset($msg_error)) {
                            echo $msg_error;
                        }
                    ?>
                </span>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

    <script>
        var passwd = document.getElementById("password").value
        var cpasswd = document.getElementById("confirmpassword").value
        if (passwd != cpasswd) {
            document.getElementById("msg-cpasswd").innerHTML = "Password not match!"
        }
    </script>


	<script>
		function checknum(txt,span){
			var len=txt.length;
			document.getElementById('shownum').innerHTML=len;
		}
	</script>
</body>
</html>