<?php

		session_start();
		if(((array_key_exists('e1',$_SESSION))&&($_SESSION["e1"]!="")))
{
	header("location: index.php?status=online");
}
		
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
		<div id="div1" style="height:400px">
			<div id="div5">
			<img id="im1" style="margin-top: -3%;" src="logo.png"/>
			<a class="a3" href=""><a href="redirect1.php?t=1"><input style='width:60px' type="button" id="l2" value="Cancel"/></a>
				
				</div>
					<label id="l4"></label><br><br>
			<form id="f" name="f" method="POST">
				<input type="text" placeholder="Email" name="Email" id="Email" style="width:65%" value="<?php if(isset($_POST['Email'])) echo $_POST['Email']?>" /><label style="font-weight:bolder;"> Or</label> <input type="button" style="margin-top:5%;height:35px;width:100px;float:right;" value="Scan QrCode" onclick="openCapture()"/><br><br>
				<center>
				<input type="password" name="Password" id="Password" placeholder="Password" /><br><br>
				<span class="sign">Your are not a member of <span style="color:rgb(0,102,145)">Arab Soft</span> society yet ? <a id="su" class="hr" href="signup.php">Sign up !</a></span>
				<input type="submit" value="Login"/>
			</center>
			</form>
		</div>
		<form id="f1" name="f1" method="POST" enctype="multipart/form-data">
		<div id="captureDiv" style="display:none;font-size:20px;min-height:45px;width:300px;border:4px solid grey;top:22%;left:39%;padding:18px;border-radius:20px;z-index:6;position:absolute;background-color:white">
				<center>
				<input type="button" value="Scan" onclick="CaptureQr()"/> Or <label class="custom-file-upload">
    			<input id="file" onchange="addImg(event),this.form.submit()" type="file" name="image" accept="image/png, image/jpeg"/>
    			Upload
				</label><input type="button" value="Upload" style="float:right;margin-right:5%;margin-top:-15%"/>
				
					<img src="" id="ImageFile" style="display:none;max-height:225px;max-width: 225px"/>
				<div id="videoDiv" style="display:none"><br>  
					<video id="preview" src="" width="270px" height="200px"></video>
				</div>
				</center>
			<label id="l7"></label>
		</div>
		<input type="text" id="urlText" name="urlText" value="" readonly style="display:none"/>
		</form>
		<?php
		$text="";
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
				$text=substr($text,6,strlen($text));
				$text=strstr($text," Name=",true);
				$j=0;
				for($i=0;$i<strlen($text);$i++)
				{
					if($text[$i]==" ")
					{
					$j=$i;
					break;
					}
				}
				$text=substr($text,0,$j);
				if (filter_var($text, FILTER_VALIDATE_EMAIL))
				{
			    	echo "<script>document.getElementById('Email').value='".$text."'</script>";
				} 
				else 
				{
				    echo "<script>document.getElementById('l4').innerHTML='Invalid QrCode !';</script>";
				}
				
			
		}
		include_once("connex.php");
		$idcom=connex_object();
			if(isset($_POST['Email'])&&(isset($_POST['Password'])))
			{
				$email=$_POST["Email"];
				$password=$_POST["Password"];
				
				if ($idcom)
				{
					$requete=$idcom->prepare("select * from user WHERE (Email=? and PassW_U=?)");
  					$requete->execute(array($email,$password));
  					$res=$requete->fetchAll();
  					if (!$res)
  					{

  						echo "<script>";
    					echo "document.getElementById('Email').style.borderColor='red';";
    					echo "document.getElementById('Password').style.borderColor='red';";    					
    					echo "document.getElementById('f').style.marginTop=0;";
    					echo "document.getElementById('l4').innerHTML='Wrong Email or Password !'";
    					echo "</script>";
  					}
  					else
  					{
 					foreach ( $res as $donnee)
            		{
  						$_SESSION['f']=$donnee["FName_U"];
  						$_SESSION['n']=$donnee["Name_U"];
  						$_SESSION['e1']=$donnee["Email"];
  						if($_SESSION['e1']=="admin")
  							header("location: admin.php");
  						else
  						{
  							header("location: redirect1.php?t=1");
  						}
  					}
  				}
				}
				else
				{
					Echo "<script>alert('Error! Please try again.')</script>";
				}
				
			}
			?>
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