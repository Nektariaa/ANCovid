<?php
	include ("connect.php");
	
	
	
	
	if($_GET['q']==1) //login admin
	{
		$sql="select * from admin where username='$_POST[usr]' and password='$_POST[pwd]'";
		$res=mysqli_query($db,$sql);
		if(mysqli_num_rows($res)>0)
		{
			$_SESSION['admin']=$_POST['usr'];
			echo "ok";
		
		}
		else
		{
		$_SESSION['admin']="";
			echo "Error";
		
		}
	}
	
	if($_GET['q']==2) //gia to upload 
	{
		$filename=$_FILES["file1"]['name'];
		$tmpname=$_FILES["file1"]['tmp_name'];
		
		if(move_uploaded_file($tmpname,"../upload/$filename"))
		{
		
		$data=file_get_contents("../upload/$filename");
		$jsdata=json_decode($data);
		
		

		foreach ($jsdata as $obj)
		{
			
			
			mysqli_query($db,"delete from poi where id='".$obj->id."'");
			mysqli_query($db,"delete from category where id_poi='".$obj->id."'");
			mysqli_query($db,"delete from estimate_visit where id_poi='".$obj->id."'");
			
			$sql="insert into poi(id,name,lat,lng,rating,rating_n,address) values ('".$obj->id."','".htmlspecialchars($obj->name, ENT_QUOTES)."','".$obj->coordinates->lat."'
				,'".$obj->coordinates->lng."',
				'".@$obj->rating."','".@$obj->rating_n."',
				'".htmlspecialchars($obj->address, ENT_QUOTES)."')";
			
			mysqli_query($db,$sql);
			
			
			$sql2="insert into category(id_poi,type) values ";
			$c2="";
			foreach($obj->types as $tp)
			{
			$sql2=$sql2.$c2."('".$obj->id."','".$tp."')";
			$c2=",";
			}
			mysqli_query($db,$sql2);
			
			$sql3="insert into estimate_visit(id_poi,day,hour,percent) values ";
			$c3="";
			foreach($obj->populartimes as $dd)
			{
				$h=0;
				foreach($dd->data as $p)
				{
				$sql3=$sql3.$c3."('".$obj->id."','".$dd->name."','$h','$p')";
				$c3=",";
				$h++;
				}
			}
			
			mysqli_query($db,$sql3);
			
			
			
				
		}
		
		
		
		
		
		
		
		echo "ok";
		unlink("../upload/$filename");
		}
		else
		{
			echo "error";
		
		}
	}
	
	
	if($_GET['q']==3) //gia to delete
	{
		mysqli_query($db,"delete from poi");
		mysqli_query($db,"delete from category");
		mysqli_query($db,"delete from estimate_visit");
		mysqli_query($db,"delete from visit");
		mysqli_query($db,"delete from user");
			
	}

?>