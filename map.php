<?php
session_start();
if(@$_SESSION['usr']=='')
{
	echo "error connection";
	die();
}

$menu="user";
$html= "
 <link rel=\"stylesheet\" href=\"https://unpkg.com/leaflet@1.7.1/dist/leaflet.css\"
   integrity=\"sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==\"
   crossorigin=\"\"/>
   

 <script src=\"https://unpkg.com/leaflet@1.7.1/dist/leaflet.js\"
   integrity=\"sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==\"
   crossorigin=\"\"></script>
	<div class='container-fluid '>
	<select id=category>
	
	</select>
	<div id=map></div>
	</div>
	
	<!-- Modal -->
<div id=\"myModal\" class=\"modal fade\" role=\"dialog\">
  <div class=\"modal-dialog\">

    <!-- Modal content-->
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        <h4 class=\"modal-title\" id=titlepoi></h4>
      </div>
      <div class=\"modal-body\" id=mbody>
	  <form action='' id=formvisit method=post>
			<input type=hidden name=idpoi id=idpoi>
			Persons in place:<input type='number' name=np id=np value=0 ><br>
			<input type='submit' value='Set Visit'>
	</form>
      </div>
      <div class=\"modal-footer\">
        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
      </div>
    </div>

  </div>
</div>

	<script>
		showmap();
	</script>

";

include "template.php";
?>