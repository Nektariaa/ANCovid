<?php
	include ("connect.php");
	
	if($_GET['q']==1) // form signup user
	{
		$sql="insert into user(username,email,password) values('$_POST[usr]','$_POST[email]','$_POST[pwd]')";
		
		if(mysqli_query($db,$sql))
		{
			echo "ok";
		
		}
		else
		{
			echo "Error";
		
		}
	}
	
	
	if($_GET['q']==2) // form login
	{
		$sql="select * from user where username='$_POST[usr]' and password='$_POST[pwd]'";
		$res=mysqli_query($db,$sql);
		if(mysqli_num_rows($res)>0)
		{
			$_SESSION['usr']=$_POST['usr'];
			echo "ok";
		
		}
		else
		{
		$_SESSION['usr']="";
			echo "Error";
		
		}
	}

?>