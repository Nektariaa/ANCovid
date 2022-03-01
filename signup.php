<?php
$menu="";
$html= "

	<div class='container '>
	<div class='row'>
	<div class='col-md-4'></div>
	<div class='col-md-4'>
	<center>
		<h2> New Account </h2>
		<form action='' id=frmsignup>
			  <div class='form-group'>
				<label for='email'>Email address:</label>
				<input type='email' class='form-control' id='email' name='email' required>
			  </div>
			  <div class='form-group'>
				<label for='usr'>Username:</label>
				<input type='text' class='form-control' id='usr' name='usr' required>
			  </div>
			  <div class='form-group'>
				<label for='pwd'>Password:</label>
				<input type='password' class='form-control' id='pwd' name='pwd' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()|<>?/;:]).{8,}' required>
			  </div>
				<div id=minima></div>
			  <button type='submit' class='btn btn-default'>SignUp</button>
		</form>
	</center>
	</div>
	</div>
	</div>



";

include "template.php";
?>