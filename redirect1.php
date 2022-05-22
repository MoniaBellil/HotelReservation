<?php
session_start();
if($_GET["t"]==3)
	{
		$_SESSION["forward"]="res";
		header("location:signin.php");
	}

else if($_GET["t"]==2)
	{
		$_SESSION["forward"]="index";
		header("location:signin.php");
	}
	else if($_GET["t"]==4)
	{
		$_SESSION["forward"]="confirm";
		header("location:signin.php");	
		}
else
{
	/*By Khaili Med Amine*/
	if($_SESSION["forward"]=="res")
	{
		header("location:reservation.php");
	}
	else if($_SESSION["forward"]=="confirm")
	{
		header("location:confirm.php");
	}
	else
	{
		header("location:index.php?status=online");
	}
}
