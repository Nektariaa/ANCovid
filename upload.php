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
	<form action='' id=frmupload enctype='multiform/form-data'>
	<div class='form-group'>
				<label for='file1'>File with data to upload:</label>
				<input type='file' class='form-control' id='file1' name='file1' required>
			  </div>
			  <div id=minima></div>
			  <button type='submit' class='btn btn-default'>Upload and Update Database</button>

	</form>
	</center>
	</div>
	</div>
	</div>



";

include "template.php";
?>