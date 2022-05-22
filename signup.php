<?php
	session_unset();
	session_start();
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
				height:800px;
				width:41%;
				margin-top:3%;
				margin-left: 30%;
			}
			#div5
			{
				margin-bottom:0%;
			}
			input[type=date]
			{
				 background:transparent;
		width: 100%;	
		padding: 12px 20px;
		margin: 2px;
		border: none;
		border-bottom:1px solid rgb(0,102,145);
		box-sizing: border-box;
	 color:black;

    outline: none;
			}
.custom-file-upload {
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    position:absolute;
    top:3.4em;
    opacity:0;
    border-radius: 50%;
    font-size: 60px
}
input[type="file"] {
    display:none;
    }
		</style>
    
	</head>
	<body>
		<div id="div1">
			<div id="div5">
			<img id="im1" src="logo.png"/>
				<a class="a3" href="signin.php"><input type="button" id="l2" value="Sign in"/></a>
				</div>
				<br>
				<br>
			<form id="f" method="POST" enctype="multipart/form-data">
				<table width="41%"><tr></td><td>
				<div id="div7">
				<div  style="border-radius:200px;width:80px;height:80px"><img width="80px" height="80px" style="border-radius:200px" src="user.png" id="pimg"/></div>
				<label class="custom-file-upload">
    			<input onchange="addImg(event)" id="file" type="file" name="image" accept="image/png, image/jpeg"/>
    				up
				</label>
				</div></td><td><b>Upload Image</b></tr></table><br>
					<label id="l4"></label> <a id="b" href="signin.php?t=0">Sign in ?</a>
				<center>
				<input type="email" name="Email" id="Email" value="<?php if(isset($_POST['Email'])) echo $_POST['Email']?>" placeholder="Email" required /><br><br>
				<input type="password" name="Password" id="Password1" pattern=".{8,}" placeholder="Password" required oninput="testP()" /><label id="l3">(Minimum 8 characters)</label><br><br>
				<input type="password" id="Password2" placeholder="Re-Type Password" oninput="testP()"required /><br><br>
				<input type="text" name="Name" value="<?php if(isset($_POST['Name'])) echo $_POST['Name']?>" placeholder="Name" required /><br><br>
				<input type="text" name="FName" value="<?php if(isset($_POST['FName'])) echo $_POST['FName']?>" placeholder="First Name" required /><br><br>
				<input type="text" name="Num" value="<?php if(isset($_POST['Num'])) echo $_POST['Num']?>" placeholder="Phone number (xx xxx xxx)" pattern="[0-9]{8}" required /><br><br>
				<input name="bDate" type='date' required/><label style='top:46.1em;left:50em' id="l3">Birth Date</label><br><br>
				<input type="submit" name="sub" id="sub" value="Sign up !"/>
			</center>
			</form>
		
		</div>

		<script>
			function addImg(file)
			{
				var input=file.target;
				var reader = new FileReader();
    			reader.onload = function(){
      			var dataURL = reader.result;
      			var output = document.getElementById('pimg');
      			output.src = dataURL;
      			output.style.display="inherit";
    			};
    			reader.readAsDataURL(input.files[0]);
  				}
			
			function testP()
			{
				if(document.getElementById("Password1").value.length<8)
				{
					document.getElementById("Password1").style.borderColor="red";	
				}
				else
				{
					document.getElementById("Password1").style.borderColor="rgb(0,102,145)";

				}	
				
				if(document.getElementById("Password2").value!=document.getElementById("Password1").value)
				{
					document.getElementById("Password2").style.borderColor="red";
					document.getElementById("sub").disabled=true;	
				}
				else
				{
					document.getElementById("Password2").style.borderColor="rgb(0,102,145)";
					document.getElementById("sub").disabled=false;
				}
			}
		</script>
		<?php
		include_once("connex.php");

			if(isset($_POST["Email"]))
			{	
				$email=$_POST["Email"];
				$password=$_POST["Password"];
				$name=$_POST["Name"];
				$fname=$_POST["FName"];
				$num=$_POST["Num"];
				$file="";
				$bDate=$_POST["bDate"];
				if($_FILES["image"]["tmp_name"]!="")

					$file=file_get_contents($_FILES["image"]["tmp_name"]);
				$idcom=connex_object();
				if ($idcom)
				{
					$req=$idcom->prepare("SELECT * from user where(Email=?)");
  					$req->execute(array($email));
  					$res=$req->fetchAll();	

					if($res)
					{
						$_SESSION['e']=$email;
    					echo "<script>document.getElementById('l4').innerHTML='Email allready in use !';";
    					echo "document.getElementById('f').style.marginTop=1;";
    					echo"document.getElementById('b').style.display='inline';</script>";
						echo "<script>document.getElementById('Email').style.borderColor='red'</script>";
					}
					else
					{
					$requete=$idcom->prepare("INSERT INTO user VALUES (:email,:name,:fname,:password,:num,:file,:bDate)");
					$requete->bindParam(':email',$email);
					$requete->bindParam(':name',$name);
					$requete->bindParam(':fname',$fname);
					$requete->bindParam(':password',$password);
					$requete->bindParam(':num',$num);
					$requete->bindParam(':file',$file, PDO::PARAM_LOB);
  					$requete->bindParam(':bDate',$bDate);
  					if($requete->execute())
  					{
  						$_SESSION['f']=$fname;
  						$_SESSION['n']=$name;
  						$_SESSION['e1']=$email;
      				
      						header("location: redirect1.php?t=1");
  					}
  					else 
  					{
  						Print_r($requete->errorInfo());
  					}
  				}
  				}
  				
				
				else
					Echo "<script>alert('Error! Please try again.')</script>";
			}
		?>
	</body>
</htmL>