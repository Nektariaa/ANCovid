<?php
session_start();
if(@$_SESSION['usr']=='')
{
	echo "error connection";
	die();
}

$menu="user";
$html= "
<div class=container id=data1>
	  
     
</div>
<script>
$.get('api/user.php?q=8',function(res){
console.log(res);
	js=JSON.parse(res);
	s='<h3>POIs Contacts with persons positive COVID</h3>';
	for (i=0;i<js.length;i++)
		s=s+js[i].name+'<br>';
	$('#data1').html(s);
});

</script>
";

include "template.php";
?>