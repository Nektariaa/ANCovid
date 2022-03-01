<?php
$menu="";
$html= "

	<div class='container '>
	<div class='row'>
	<div class='col-md-4'></div>
	<div class='col-md-4'>
	<center>
		<h2> Login </h2>
		<form action='' id=frmlogin>
			
			  <div class='form-group'>
				<label for='usr'>Username:</label>
				<input type='text' class='form-control' id='usr' name='usr'>
			  </div>
			  <div class='form-group'>
				<label for='pwd'>Password:</label>
				<input type='password' class='form-control' id='pwd'  name='pwd'>
			  </div>
			 <div id=minima></div>
			  <button type='submit' class='btn btn-default'>Login</button>
		</form>
		
	</center>
	</div>
	</div>
	</div>



";

include "template.php";
?>