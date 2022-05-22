<?php
session_start();
if(isset($_GET["id"]))
	{
		$_SESSION["resID"]=$_GET["id"];
		if(((array_key_exists('e1',$_SESSION))&&($_SESSION["e1"]!="")))
			$_SESSION["resEmail"]=$_SESSION["e1"];
		else
		{
			include_once("connex.php");
			$idcom=connex_object();
			$requete=$idcom->prepare("select Email from reservation WHERE Code_R=?");
			$requete->execute(array($_GET["id"]));
			$res=$requete->fetchAll();
			foreach ( $res as $donnee)
			{
				$_SESSION["resEmail"]=$donnee["Email"];
			}
		}
		header("location:done.php");
	}

else 
	header("location: index.php");
