<?php

include "connect.php";
date_default_timezone_set('Europe/Athens');


if($_GET['q']==1) //kaleitai apo tin profile(); gia na ferei ta stoixeia tou user se json morfi
{
	$sql="select * from user where username='$_SESSION[usr]'";
	$result=mysqli_query($db,$sql);
	
	$r=mysqli_fetch_assoc($result);
	
	echo json_encode($r);
	



}


if($_GET['q']==2) //apo form profile
	{
		$sql="update user	set username='$_POST[usr]',email='$_POST[email]',password='$_POST[pwd]'
			where username='$_SESSION[usr]'";
		
		if(mysqli_query($db,$sql))
		{
			$_SESSION['usr']=$_POST['usr'];
			echo "ok";
		
		}
		else
		{
			echo "Error";
		
		}
	}
	


if($_GET['q']==3) //gia to change
	{
		$sql="select * from poi , category , estimate_visit where
		category.id_poi=poi.id and type='$_GET[cat]' and estimate_visit.id_poi=poi.id
		and day='".date("l")."' and hour='".date("H")."'";
		
		$result=mysqli_query($db,$sql);
		$A=[];
		while($r=mysqli_fetch_assoc($result))
		{
			$A[]=$r;
		}
		echo json_encode($A);
	}
	
	

if($_GET['q']==4) //gia to select category
	{
		$sql="select distinct type from category";
		$result=mysqli_query($db,$sql);
		$A=[];
		while($r=mysqli_fetch_assoc($result))
		{
			$A[]=$r;
		}
		echo json_encode($A);
	}
	
	
if($_GET['q']==5) //gia to percent mesa sto pop up
	{
		$tm= date("l", strtotime("+1 day"));
		
		$sql="select id_poi,hour,percent from estimate_visit
		where id_poi='$_GET[id]' and day='".date("l")."' and hour>=".date("H");
		
		$result=mysqli_query($db,$sql);
		$A=[];
		while($r=mysqli_fetch_assoc($result))
		{
			$A[]=$r;
		}
		
		$sql="select hour,percent from estimate_visit
		where id_poi='$_GET[id]' and day='$tm' and hour>=0"; //gia na pianei kai tis prwtes wres tis epomenis meras
		
		$result=mysqli_query($db,$sql);
		
		while($r=mysqli_fetch_assoc($result))
		{
			$A[]=$r;
		}
		echo json_encode($A);
	}
	
	
if($_GET['q']==6) //gia to set visit
	{
		
		$sql="insert into visit(id_poi,usr,datetime1,persons)
			values('$_POST[idpoi]','$_SESSION[usr]',now(),$_POST[np])";
		
		mysqli_query($db,$sql);
		echo $sql;
	}

		
	
if($_GET['q']==7) //gia to tested positive
	{
		
		$sql="update user set covid='$_POST[positive]' where username='$_SESSION[usr]'";
		
		mysqli_query($db,$sql);
		
	}
	
	
	
if($_GET['q']==8)
	{
		
		$sql="
		select * from poi , visit, user , (select * from visit where usr='$_SESSION[usr]') as vv
		where poi.id=visit.id_poi 
		and poi.id=vv.id_poi 
		and abs(visit.datetime1-vv.datetime1)<7200
		and visit.usr<>'$_SESSION[usr]' and user.username=visit.usr 
		and datediff(visit.datetime1,user.covid)<7 
		and datediff(visit.datetime1,user.covid)>=0 
		
		
		" ;
		
		$result=mysqli_query($db,$sql);
		$A=[];
		while($r=mysqli_fetch_assoc($result))
		{
			$A[]=$r;
		}
		echo json_encode($A);
		
	}