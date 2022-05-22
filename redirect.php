<?php
session_start();
if ($_GET["id"]=="canceled")
{
	$_SESSION["hotelId"]="";
	header("location: reservation.php");
	
}
else
{
if((array_key_exists('hotelId',$_SESSION))&&($_SESSION["hotelId"]!="")&&(!(array_key_exists('resID',$_SESSION))))
	{
		echo "<span style='font-size:17px'>another reservation in prgoress. Redirecting ..</span>";
		echo"<script>
				setTimeout(function(){
				window.location.replace('confirm.php#buttons')},2000)
				</script>";
	}		
else
{		
$_SESSION["hotelId"]=$_GET["id"];
header("location: confirm.php#buttons");
}
}
/*
			<!--By Khaili Med Amine-->*/
?>