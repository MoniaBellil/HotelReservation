<?php

		session_start();
		if(!(array_key_exists('e1',$_SESSION)))
			header("location: index.php?status=offline");

	
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
		width:60%;
		margin-left:20%;
		height:auto;
	}
	#l7
{
  margin-left:2em;
  font-size:14px;
  font-weight:bolder;
  color:red
}

	.custom-file-upload {
    display: inline-block;
    width:118px;
   	height:40px;
    color:white;
    opacity:0;
    cursor:pointer;
    font-weight:bolder;
    background:rgb(0,102,145);
  	border-radius: 9px;

}
input[type="file"] {
    display:none;
    }
	</style>
    </head>
	<script type="text/javascript" src="adapter.min.js"></script>
    <script type="text/javascript" src="vue.min.js"></script>
    <script type="text/javascript" src="instascan.min.js"></script>
	<body>
		<div id="div1">
			<a class="a3" href=""><a href="index.php?status=off"><input style='margin:1em;width:70px;height:40px' type="button" id="l2" value="Sign Out"/></a>
			<?php
			$text="";
			$x=1;
		if (isset($_POST["urlText"]))
			$text=$_POST["urlText"];
		
		if((array_key_exists('image',$_FILES))&&($_FILES["image"]["tmp_name"]!=""))
			{
				include_once('lib/QrReader.php');
				$image="";
				$image=$_FILES["image"]["tmp_name"];
				$qrcode=new Zxing\QrReader($image);
				$text=$qrcode->text();
				if($text=="")
				{
					echo "<script>document.getElementById('l4').innerHTML='Please Upload a QrCode !';</script>";
				}
			}
				if($text!="")
				{
					
				$text=substr($text,18,1);
				include_once("connex.php");
				$idcom=connex_object();
				$requete=$idcom->prepare("SELECT * FROM reservation where Code_R=:code");
				$requete->bindParam(':code',$text);
				$requete->execute();
				$res=$requete->fetchAll();
				$x=0;
				foreach ( $res as $donnee1)
				{
					$x=1;
					
					$requete1=$idcom->prepare("SELECT * FROM hotel where Id_H=:id");
					$requete1->bindParam(':id',$donnee1["Id_H"]);
					$requete1->execute();
					$res1=$requete1->fetchAll();
					echo "<h1 style='margin-left:1em;'>Hotel:</h1><table style='margin-top:10%;margin-left:2%'>";
					foreach ( $res1 as $donnee)
					{
						$stars="<img src='star.png' width='15px' height='15px'/>";
						for($i=0;$i<$donnee["Star_H"]-1;$i++)
							
							$stars=$stars."<img src='star.png' width='15px' height='15px'/>";
						$src='data:image/jpeg;base64,'.base64_encode($donnee["Image_H"]);
						echo"<tr><td><img width='400px' style='border-radius:150px' height='300px' src='".$src."'/><br><br></td><td style='padding-left:2%;padding-bottom:6%'><label style='color:rgb(0,102,145);font-size:35px;font-weight:bolder'>".$donnee["Nom_H"]."</label><label style='margin-left:200px;color:rgb(0,152,100);font-size:15px;font-weight:bolder'><br>".$donnee["Pays_H"].", ".$donnee["Ville_H"]."</label><br><br>".$stars."  <label style='font-weight:bolder'>".$donnee["Star_H"]." Stars Hotel</label><label style='float:right;margin-right:3%;font-size:17.4px;font-weight:bolder;color:rgb(0,152,100)'>".$donnee["nightPrice_H"]."DT/Night a person</label><br><br><label style='font-size:16px;font-weight:bolder'>".$donnee["Des_H"]."</label>
						<br><br><br>
						<script>price=".$donnee["nightPrice_H"].";</script>";
					}
					echo "</table>";
					echo "<h1 style='margin-left:1em;'>Reservation:</h1><table  width='100%'><tr><th>From</th><th>To</th><th>Number of people</th><th>Trasportation</th><th>Room service</th><th>Other oprtions</th></tr>";
						
							echo "<tr style='text-align:center'><td>".$donnee1["Date_A"]."</td><td>".$donnee1["date_D"]."</td><td>".$donnee1["Pers_Num"]."</td><td>".$donnee1["Trans"]."</td><td>".$donnee1["Room_Serv"]."</td><td>".$donnee1["Options"]."</td></tr>";
						
						echo "</table><br><br><br><br>";
						echo "<h1 style='margin-left:1em;'>Client Informations:</h1>";
						$y=0;	
						$requete2=$idcom->prepare("SELECT * FROM user where Email=:email");
						$requete2->bindParam(':email',$donnee1["Email"]);
						$requete2->execute();
						$res2=$requete2->fetchAll();
						foreach($res2 as $donnee2)
						{
							$y=1;
						echo "<table width='100%'><tr><th>Email</th><th>Name</th><th>First Name</th><th>Phone Number</th><th>Birth Date</th></tr><tr style='text-align:center'><td>".$donnee2["Email"]."</td><td>".$donnee2["Name_U"]."</td><td>".$donnee2["FName_U"]."</td><td>".$donnee2["Num_U"]."</td><td>".$donnee2["Date_Nais_U"]."</td></tr></table>";
						
						}
						
						if($y==0)
						{
							$requete2=$idcom->prepare("SELECT * FROM tmp_user where Email=:email");
							$requete2->bindParam(':email',$donnee1["Email"]);
							$requete2->execute();
							$res2=$requete2->fetchAll();
							foreach($res2 as $donnee2)
							{
							echo "<table width='100%'><tr><th>Email</th><th>Name</th><th>First Name</th><th>Phone Number</th></tr><tr style='text-align:center'><td>".$donnee2["Email"]."</td>";
							if($donnee2["Name"]!="")
								echo "<td>".$donnee2["Name"]."</td><td>".$donnee1["Fname"]."</td><td>".$donnee2["Num"]."</td></tr>";
							else
								echo "<td colspan='3' style='padding-right:120px;color:red;font-weight:bolder;font-size:15px'>These Informations were not provided by the client</td></tr>";	
							}
						echo "</table>";
						
					}
					}
				echo "<br><br>";
				}
						
		?>
	<form id="f1" name="f1" method="POST" enctype="multipart/form-data">
		<h2 style="color:rgb(0,102,145);">Please Scan or Upload QrCode to display reservation Informations</h2>
		
			<label id="l4"></label>
			<?php
			if ($x==0)
				echo "<script>document.getElementById('l4').innerHTML='Invalid QrCode !';</script>";	
			else
				echo "<script>document.getElementById('l4').innerHTML='';</script>";		
			?>	
		<center>
		<div id="captureDiv" style="font-size:20px;min-height:45px;width:300px;padding:18px">
				<center>
				<input type="button" value="Scan" onclick="CaptureQr()"/> Or <label class="custom-file-upload">
    			<input id="file" onchange="addImg(event),this.form.submit()" type="file" name="image" accept="image/png, image/jpeg"/>
    			Upload
				</label><input type="button" value="Upload" style="float:right;margin-right:4.5%;margin-top:-16%"/>
				
					<img src="" id="ImageFile" style="display:none;max-height:225px;max-width: 225px"/>
				<div id="videoDiv" style="display:none"><br>  
					<video id="preview" src="" width="270px" height="200px"></video>
				</div>
				</center>
			<label id="l7"></label>
		</div>
	</center>
		<input type="text" id="urlText" name="urlText" value="" readonly style="display:none"/>
		</form>
		

	</div>
	<script>
				function addImg(file)
				{
				
				document.getElementById("videoDiv").style.display="none"
				var input=file.target;
				var reader = new FileReader();
    			reader.onload = function(){
      			var dataURL = reader.result;
      			var output = document.getElementById('ImageFile');
      			output.src = dataURL;
      			output.style.display="inherit";
      			};
    			reader.readAsDataURL(input.files[0]);
  				}
			
				function openCapture()
				{
					document.getElementById('div1').style.filter='blur(3px)';
					document.getElementById('div1').style.pointerEvents='none';
					document.getElementById('captureDiv').style.display='inherit';
				}
				function closeCapture()
				{
					document.getElementById('captureDiv').style.display='none';
					document.getElementById('div1').style.filter='none';
					document.getElementById('div1').style.pointerEvents='auto';
					
				}

					
				function CaptureQr() {
				var self = this;
			    self.scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5 });
			    self.scanner.addListener('scan', function (content, image) {
			     document.getElementById("urlText").value=content;	
  				document.getElementById("f1").submit();
			    });
			    Instascan.Camera.getCameras().then(function (cameras) {
			      self.cameras = cameras;
			      if (cameras.length > 0) {
			        self.activeCameraId = cameras[0].id;
			        self.scanner.start(cameras[0]);
			        document.getElementById("ImageFile").style.display="none";
					document.getElementById("videoDiv").style.display="inherit";
			    
			      } else {
			        document.getElementById("l7").innerHTML="No camera device detected.";
			      }
			    }).catch(function (e) {
			      console.error(e);
			    });
			  }
			</script>
</body>
</htmL>