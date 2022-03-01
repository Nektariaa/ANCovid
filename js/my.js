var map;
var M = []; //gia to change

var myplace;

function distance(lat1, lon1, lat2, lon2) {
	var radlat1 = Math.PI * lat1 / 180;
	var radlat2 = Math.PI * lat2 / 180;
	var theta = lon1 - lon2;
	var radtheta = Math.PI * theta / 180;
	var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
	dist = Math.acos(dist);
	dist = dist * 180 / Math.PI;
	dist = dist * 60 * 1.1515;
	dist = dist * 1.609344;

	return dist;
}


$(document).ready(function () {


	$("#frmsignup").submit(function (event) {
		event.preventDefault();

		$.post("api/guest.php?q=1", $("#frmsignup").serialize(), function (result) {
			if (result == "ok") {

				$("#minima").html("<div class='alert alert-success'><strong>Your account has been created. Try to login</strong></div>");
				$("#frmsignup").reset();

			}
			else {
				$("#minima").html("<div class='alert alert-danger'><strong>This email or username exists</strong></div>");

			}

		});


	});








	$("#frmlogin").submit(function (event) {
		event.preventDefault();

		$.post("api/guest.php?q=2", $("#frmlogin").serialize(), function (result) {
			if (result == "ok") {
				window.location.href = 'user.php'; //metafersou sto user.php
			}
			else {
				$("#minima").html("<div class='alert alert-danger'><strong>Error Username or Password</strong></div>");


			}

		});


	});




	$("#frmadmin").submit(function (event) {
		event.preventDefault();

		$.post("api/admin.php?q=1", $("#frmadmin").serialize(), function (result) {

			if (result == "ok") {
				window.location.href = 'admin.php';
			}
			else {
				$("#minima").html("<div class='alert alert-danger'><strong>Error Username or Password</strong></div>");


			}

		});


	});


	$("#frmprofile").submit(function (event) {
		event.preventDefault();

		$.post("api/user.php?q=2", $("#frmprofile").serialize(), function (result) {

			if (result == "ok") {
				$("#minima").html("<div class='alert alert-success'><strong>Your data saved succesfully</strong></div>");
				$("#frmsignup").reset();
			}
			else {
				$("#minima").html("<div class='alert alert-danger'><strong>Username or email exists</strong></div>");


			}

		});


	});


	$("#frmupload").submit(function (event) {
		event.preventDefault();
		$("#minima").html("Waiting");
		var formData = new FormData();
		formData.append('file1', $('#file1')[0].files[0]);

		$.ajax({
			url: 'api/admin.php?q=2',
			type: 'POST',
			data: formData,
			processData: false,  // tell jQuery not to process the data
			contentType: false,  // tell jQuery not to set contentType
			success: function (result) {
				console.log(result);
				if (result == "ok") {
					$("#minima").html("<div class='alert alert-success'><strong>File succesfull uploaded and Database Updated</strong></div>");
					$("#frmupload").reset();
				}
				else {
					$("#minima").html("<div class='alert alert-danger'><strong>Upload or Update failed</strong></div>");
					console.log(result);


				}
			}
		});



	});


	$("#del").click(function () {

		$.get("api/admin.php?q=3", function (res) {
			$("#minima").html("<div class='alert alert-danger'><strong>Data Deleted</strong></div>");

		});
	});



	$("#category").change(function () {

		$.get("api/user.php?q=3&cat=" + $("#category").val(), function (res) {
			var js = JSON.parse(res);

			for (i = 0; i < M.length; i++) {
				M[i].remove();
			}
			M = [];
			for (i = 0; i < js.length; i++) {
				thesi = [js[i].lat, js[i].lng];

				if (js[i].percent <= 32) im = 'images/dot_green.png';
				else
					if (js[i].percent <= 65) im = 'images/dot_orange.png';
					else im = 'images/dot_red.png';
				var icon2 = L.icon({
					iconUrl: im,
					iconSize: [20, 30],
					iconAnchor: [10, 30],
				});
				var marker = L.marker(thesi, { icon: icon2, title: js[i].name }).addTo(map);

				marker.id1 = js[i].id;



				marker.on('click', function (e) {



					$.get("api/user.php?q=5&id=" + this.id1, function (res) {
						var js = JSON.parse(res);

						var s = "";
						for (i = 0; i < 3; i++) {
							s += "hour: " + js[i].hour + " percent:" + js[i].percent + "<br>";
						}

						if (distance(myplace.lat, myplace.lng, e.latlng.lat, e.latlng.lng) < 0.020) { //an i apostasi tou marker mou kai tou poi einai mikroteri twn 20m
							s += "<button onclick=\"showmodal('" + js[i].id_poi + "')\">Set Visit</button>";
						}

						var popup = L.popup();
						popup
							.setLatLng(e.latlng)
							.setContent(s)
							.openOn(map);
					});


				});
				M.push(marker);


			}

		});
	});





	$("#formvisit").submit(function (event) {

		$.post("api/user.php?q=6", $("#formvisit").serialize(), function (res) {
			alert("Your visit saved ");
			$("#np").val(0);
			$("#myModal").modal('hide');


		});
		event.preventDefault();

	});





	$("#formpositive").submit(function (event) {

		$.post("api/user.php?q=7", $("#formpositive").serialize(), function (res) {
			alert('Your data saved');


		});
		event.preventDefault();

	});

});




function profile() {

	$.get("api/user.php?q=1", function (res) {
		var js = JSON.parse(res);

		$("#email").val(js.email);
		$("#pwd").val(js.password);
		$("#usr").val(js.username);

	});

}





function showmap() {
	map = L.map('map').fitWorld();
	map.locate({ setView: true, maxZoom: 13 });

	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicHBvbHlkMDEiLCJhIjoiY2t6MnM1NW4xMDB2bDJvcDJ2NW04enZkNSJ9.SR1qSNVWd5oSCGgU1kjRQg', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 18,
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1,
		accessToken: 'pk.eyJ1IjoicHBvbHlkMDEiLCJhIjoiY2t6MnM1NW4xMDB2bDJvcDJ2NW04enZkNSJ9.SR1qSNVWd5oSCGgU1kjRQg'
	}).addTo(map);

	map.on('locationfound', onLocationFound);

	$.get("api/user.php?q=4", function (res) {
		var js = JSON.parse(res);

		s = "<option>--Select Category--</option>";
		for (i = 0; i < js.length; i++) {
			s += "<option>" + js[i].type + "</option>";

		}
		$("#category").html(s);

	});
}

var m1;
function onLocationFound(e) {

	var radius = e.accuracy;
	var icon1 = L.icon({
		iconUrl: 'images/icon1.png',
		iconSize: [30, 40],
		iconAnchor: [15, 40],

	});


	map.on('click', function (e2) {
		m1.remove();

		myplace = e2.latlng;
		m1 = L.marker(myplace, { icon: icon1 }).addTo(map);
	});



	myplace = e.latlng;
	m1 = L.marker(myplace, { icon: icon1 }).addTo(map);


}

function showmodal(id1) {

	$("#myModal").modal('show');
	$("#idpoi").val(id1);



}