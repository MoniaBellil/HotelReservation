<?php
	session_start();
	if((!(array_key_exists('resID',$_SESSION)))||($_SESSION["resID"]==""))
		header("location: Reservation.php");
	
?>
<!DOCTYPE HTML>
<htmL>
	<head>
		<meta charset="utf-8"/>
		<title>Arab Soft</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="style2.css">
		<link rel="short icon" type="image/x-icon" href="logo.png">
		<style>
			#div1
			{
				height:600px;
				width:41%;
				margin-top:3%;
				margin-left: 30%;
			}
			#div5
			{
				margin-bottom:0%;
			}
	</style>
    
	</head>
	<body>
		<div id="div1">
		<div id="div5">
			<img id="im1" src="logo.png"/>
			<a class="a3" href="index.php"><input type="button" id="l2" value="HOME"/></a>
			</div>
			<img src="done.png" style="float:right;margin-right:10%" height="70px" width="180px"/><br>
			<br><br>
			<h1 style="color:rgb(0,102,145)">Reservation Qr Code</h1>
		
			<?php

			include_once('libs/phpqrcode/qrlib.php'); 
			

			$tempDir = 'temp/'; 
			$Code_R=$_SESSION["resID"];
			$email =$_SESSION["resEmail"];
			$filename="Reservation ".$Code_R;
			$codeContents = 'Reservation code: '.$Code_R.'   Email: '.$email; 
			QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5);

			echo '<div id="qrDiv"><center><img id="qrcode" src="temp/'. @$filename.'.png" style=""><br>
				<a href="download.php?file='.@$filename.'.png ">
				<input type="button" value="Save" style="min-height:15%;border-radius:0;"></a></center></div>';
			
			?><br>
			<center>
				<span style="font-weight:bolder">PLEASE SAVE THIS QR CODE !</span>
			</center>
	</body>