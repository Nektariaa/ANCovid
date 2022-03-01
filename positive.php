<?php
session_start();
if(@$_SESSION['usr']=='')
{
	echo "error connection";
	die();
}

$menu="user";
$html= "
<div class=container>
	  <form action='' id=formpositive method=post>
			
			Date positive:<input type='date' name=positive id=positive ><input type='submit' value='Set Positive'>
	</form>
     
</div>
";

include "template.php";
?>