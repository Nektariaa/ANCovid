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
		
	<h1>	Upload File </h1>
	<button id=del>I want to delete my data </button>
	<div id=minima></div>
	</center>
	</div>
	</div>
	</div>



";

include "template.php";
?>