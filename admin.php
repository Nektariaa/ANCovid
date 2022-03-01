<?php
session_start();
if(@$_SESSION['admin']=='')
{
	echo "error connection";
	die();
}

$menu="admin";
$html= "

	<div class='container '>
	<div class='row'>
	<div class='col-md-12'>
	<center>
		
	<h1>	Finally a familiar face. Welcome $_SESSION[admin] ! </h1>
		
	</center>
	</div>
	</div>
	</div>



";

include "template.php";
?>