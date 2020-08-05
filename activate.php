<?php
    include_once 'dbconnect.php';
	
	$strSQL = "SELECT * FROM posts WHERE SID = '".trim($_GET['sid'])."' AND IdPosts = '".trim($_GET['uid'])."' ";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
			echo "Activate Invalid !";
	}
	else
	{	
			$strSQL = "UPDATE posts SET Active = 'Yes'  WHERE SID = '".trim($_GET['sid'])."' AND IdPosts = '".trim($_GET['uid'])."' ";
			$objQuery = mysql_query($strSQL);

		echo "Activate Successfully !";
	}

	mysql_close();
?>