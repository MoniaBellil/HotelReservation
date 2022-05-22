<?php	
session_start();
$_SESSION["resID"]="";
	?>
<!DOCTYPE HTML>
<htmL>
	<head>
		<meta charset="utf-8"/>
		<title>Arab Soft</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="short icon" type="image/x-icon" href="logo.png">
	<style>
.select
{
	  background:transparent;	
		padding: 12px 20px;
		margin: 2px;
		border-radius: 20px;
		border:none;
		border-top:1px solid rgb(0,102,145);
		box-sizing: border-box;
	 color:black;
	 cursor:pointer;
    outline: none;
	}
.select1
{
	margin-top:-100px;
 	cursor:pointer;
	box-sizing: border-box;
  	background:transparent;
  	width:60px;
  	height:30px;
	border-radius: 20px;
	border:none;
	border-bottom:1px solid rgb(0,102,145);
 	color:black;
	outline: none;
	}

.select:hover,.select1:hover
{
background-color:#F4EEEE;
}
.u1
{

    margin-left: 35em;
}
</style>
	</head>
	<body id="bod">
		<?php
	include_once("connex.php");
	$idcom=connex_object();	
		
		echo "<div id='div1'>";
		echo "<div style='position:absolute;width:30%;;top:6.5em;font-size:24px;left:9em' id='div6' class='div6'>";

		$phone="";
		$src="";
		if((array_key_exists('e1',$_SESSION))&&($_SESSION["e1"]!=""))
			{

			$_SESSION["edit"]=$_SESSION["e1"];
			$requete=$idcom->prepare("select image,Num_U from user WHERE Email=?");
  					$requete->execute(array($_SESSION["e1"]));
  					$res=$requete->fetchAll();
 					foreach ( $res as $donnee)
 					{
 						$phone=$donnee["Num_U"];
  						if($donnee["image"]!="")
            				$src='data:image/jpeg;base64,'.base64_encode($donnee["image"]);
 					}
		
		
		if($src=="")
			$src='user.png';
		echo"<img style='position:absolute;top:-0.4em' class='Pimg' src='";
		echo $src;
		echo "'/><label style='position:absolute;margin-left:3.5em;margin-top:0.8em;'>".$_SESSION["f"]." ".$_SESSION["n"]."</label>";
		}
		
		echo "</div>";			

	?>
			<div id="div2">
				<img id="im1" src="2.png"/>
				<ul class="u1">
					<li class="i1"><a class="a1" id="R" href="index.php?status=offline">HOME</a></li>
					<li class="i1"><a class="a1" target="blank" id="cont" href="http://www.arabsoft.com.tn/arabsoft/contact_arab_soft.php?langue=en">CONTACT</a></li>
					<li class="i1"><a class="a1" id="R1" href="redirect1.php?t=3">SIGN IN</a></li>
				</ul>
				<?php
				if((array_key_exists('e1',$_SESSION))&&($_SESSION["e1"]!=""))
					echo "<script>
						   document.getElementById('R').href='index.php?status=online';
						   document.getElementById('R1').innerHTML='SIGN OUT';
						   document.getElementById('R1').href='index.php?status=off';
						  </script>";
				?>
			</div>
			<br><br>
				<div id="div3">
	
</div>
<div style='float:right;margin-top:3em;margin-right: 5%'>
	<form action="reservation.php" method="POST">
	<select id="order" name="order" value="<?php if(isset($_POST['order'])) echo $_POST['order'] ?>" class='select'>
		<option value="Star_H DESC" <?php if((array_key_exists('order',$_POST))&&($_POST['order'] == 'Star_H DESC')) {echo "selected=selected"; } ?>>Stars Descendant</option>
		<option value="Star_H" <?php if((array_key_exists('order',$_POST))&&($_POST['order'] == 'Star_H')) {echo "selected=selected"; } ?>>Stars Ascendant</option>
		<option value="nightPrice_H DESC" <?php if((array_key_exists('order',$_POST))&&($_POST['order'] == 'nightPrice_H DESC')) {echo "selected=selected"; } ?>>Price Descendant</option>
		<option value="nightPrice_H" <?php if((array_key_exists('order',$_POST))&&($_POST['order'] == 'nightPrice_H')) {echo "selected=selected"; } ?>>Price Ascendant</option>
		</select><input class="select1" type="submit" value="Order"/>
	</form>
		</div><br><br>
		
<?php
if(isset($_POST["order"]))
	$order=$_POST["order"];

else
	$order="Star_H DESC";
		$requete=$idcom->prepare("select * from hotel ORDER BY $order");
		$requete->execute();
  		$res=$requete->fetchAll();
		echo "<table style='margin-top:10%;margin-left:5%'>";
		foreach ( $res as $donnee)
		{
			$stars="<img src='star.png' width='15px' height='15px'/>";
			for($i=0;$i<$donnee["Star_H"]-1;$i++)
				
				$stars=$stars."<img src='star.png' width='15px' height='15px'/>";
			$src='data:image/jpeg;base64,'.base64_encode($donnee["Image_H"]);
			echo"<tr><td><img width='400px' style='border-radius:150px' height='300px' src='".$src."'/><br><br></td><td style='padding-left:2%;padding-bottom:6%'><label style='color:rgb(0,102,145);font-size:35px;font-weight:bolder'>".$donnee["Nom_H"]."</label><label style='margin-left:200px;color:rgb(0,152,100);font-size:15px;font-weight:bolder'><br>".$donnee["Pays_H"].", ".$donnee["Ville_H"]."</label><br><br>".$stars."  <label style='font-weight:bolder'>".$donnee["Star_H"]." Stars Hotel</label><label style='float:right;margin-right:3%;font-size:17.4px;font-weight:bolder;color:rgb(0,152,100)'>".$donnee["nightPrice_H"]."DT/Night a person</label><br><br><label style='font-size:16px;font-weight:bolder'>".$donnee["Des_H"]."</label>
			<br><br><br>
			<a href='redirect.php?id=".$donnee['Id_H']."'/><input type='button' style='float:right;margin-right:6%' value='Check-in !'/></a></td></tr>";
		}
		echo "</table>";
  				

?>
<br><br><br><br><br><br><br><br><br>
<footer style="padding:3%;color:white;background-color:rgb(0,102,145);height:120px;border-bottom-left-radius:20px;border-bottom-right-radius:20px">
	<ul style="list-style-type: none;font-weight:bolder;font-size:17px;">

		<a style="text-decoration:none;color:white;" target="_blank" href=http://www.arabsoft.com.tn/arabsoft/index.php?langue=en&titre="><li style="margin-right:5px;margin-top:-2%;float:left">
			<img src="3.png" width="50px" height="50px"/></a>
		</li>
		<li style="margin-right:50px;float:left">
			<a style="text-decoration:none;color:white;" target="_blank" href=http://www.arabsoft.com.tn/arabsoft/index.php?langue=en&titre=">ArabSoft official site</a>
		</li>
		<a style="text-decoration:none;color:white;" target="_blank" href="https://www.facebook.com/ArabSoftware/"><li style="margin-right:5px;margin-top:-1.2%;float:left">
			<img src="facebook.png" width="40px" height="40px"/></a>
		</li>
		<li style="margin-right:50px;float:left;margin-left:5px;">
			<a style="text-decoration:none;color:white;" target="_blank" href="https://www.facebook.com/ArabSoftware/"> Facebook page</a>
		</li>
		<li style="margin-right:50px;float:left">
			<a style="text-decoration:none;color:white;" target="_blank" href="http://www.arabsoft.com.tn/arabsoft/contact_arab_soft.php?langue=en">Contact</a>
		</li>
		
		<li style="float:right;margin-top:-0.7%">	
			<a href="#bod"><img id="topImg" title="Back to top" onmouseenter="changeImg(1)" onmouseleave="changeImg(2)" src="top.png"/></a>
		</li>
	</ul>
	<br>
	<p align="center" style="-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;margin-top:9%;color:white;font-weight:bolder;font-size:16px">© By Med Amine Khaili</p>	
<script>
	function changeImg(id)
	{
		if(id==1)
			document.getElementById("topImg").src="top2.png";
		else
			document.getElementById("topImg").src="top.png";
	}
</script>
</footer>	
</div>

			<!--By Khaili Med Amine-->
</body>
</html>