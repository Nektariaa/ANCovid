<?php
session_start();
if(@$_SESSION['usr']=='')
{
	echo "error connection";
	die();
}

$menu="user";
$html= "

	<div class='container '>
	<div class='row'>
	<div class='col-md-12'>
	<center>
		<h2>Welcome $_SESSION[usr] </h2>
		
	</center>
	</div>
	</div>
	</div>

	

";

include "template.php";
?>