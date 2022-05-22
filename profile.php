<?php
	
		session_start();
			if (!(array_key_exists('edit',$_SESSION)))
				{
				session_destroy();
				header("location: index.php");
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
			#div1
			{
				height:500px;
				width:41%;
				margin-top:3%;
				margin-left: 30%;
			}
			#div5
			{
				margin-bottom:6%;
			}
	input[type=submit]{
    
   width:125px;
   height:40px;
   margin-top: 1em;
   top:495px;
   left:62%;
   position:absolute;
    color:white;
    font-weight:bolder;
    background:rgb(0,102,145);
  border-radius: 9px;

    
  }
			
.custom-file-upload {
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    position:absolute;
    top:6.1em;
    left:8.5em;
    opacity:0;
    border-radius: 50%;
    font-size: 60px
}
#l3
{
	position:absolute;
  left:14em;
  top:8.4em;
  color:grey;
  -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
input[type="file"] {
    display: none;
    }

    .done
    {

   width:125px;
   height:40px;
   margin: 1em;
   float:right;
    color:white;
    font-weight:bolder;
    background:rgb(0,102,145);
  border-radius: 9px;

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
		</style>
	
    
    
	</head>
	<body>
		<script>
					
					res="em";
					$resV=true;
					function update(id)
					{
						if (id!="close")
						{
						res=id;	
						document.getElementById("editDiv").style.display="inherit";
						document.getElementById("div1").style.filter="blur(3px)";
						document.getElementById("div1").style.pointerEvents="none";
						document.getElementById("closeE").style.display="inherit";
						document.getElementById(id).style.display="inherit";
						}
						else
						{	
								/*By Khaili Med Amine*/
								document.getElementById("editDiv").style.display="none";
								document.getElementById("div1").style.filter="none";
								document.getElementById("div1").style.pointerEvents="auto";
								document.getElementById("closeE").style.display="none";
								document.getElementById(res).style.display="none";
								if($resV)
								{
								for (i=0;i<document.getElementById(res).childNodes.length;i++)
								{
									var e=document.getElementById(res).childNodes[i];
									if (e.tagName)
										if(e.tagName.toLowerCase()=="input")
										{
											e.value="";
											e.style.borderBottom="1px solid rgb(0,102,145)";
										}
								}
								document.getElementById("l4").style.display="none";
							$resV=true;
							}
						}
					}

					function CheckValues()
					{
						switch(res)
						{
							case "nm":
							{
								if((document.getElementById("Name").value!="")&&(document.getElementById("FName").value!=""))
									{
										document.getElementById("uName").innerHTML=document.getElementById("FName").value+" "+document.getElementById("Name").value;
										document.getElementById("Name").style.borderBottom="1px solid rgb(0,102,145)";
										document.getElementById("FName").style.borderBottom="1px solid rgb(0,102,145)";
											
											document.getElementById("sub").disabled=false;
										
											document.getElementById("uNameu").style.opacity="0.7";
										$resV=false;
										update("close");
									}
									else
								{
									if(document.getElementById("Name").value=="")
										document.getElementById("Name").style.borderBottom="1px solid red";
									else
										document.getElementById("Name").style.borderBottom="1px solid rgb(0,102,145)";
									
									if(document.getElementById("FName").value=="")
										document.getElementById("FName").style.borderBottom="1px solid red";
									else
										document.getElementById("FName").style.borderBottom="1px solid rgb(0,102,145)";
								}
								break;
							}
							case "em":
							{
								var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    								
								if (re.test(String(document.getElementById("Email").value).toLowerCase()))
    								{
    									document.getElementById("uEmail").innerHTML=document.getElementById("Email").value;
    									
											document.getElementById("sub").disabled=false; 
											document.getElementById("uEmailu").style.opacity="0.7";
    									 	$resV=false;
    									 	update("close");
    								}
    								else

    									document.getElementById("Email").style.borderBottom="1px solid red";
    								
								break;
							}
							case "pw":
							{
								if(document.getElementById("Password1").value.length<8)
									document.getElementById("Password1").style.borderBottom="1px solid red";
								else
								{			
								if((document.getElementById("OPassword").value!="")&&(document.getElementById("Password1").value!="")&&(document.getElementById("Password2").value!=""))
									{
										if(document.getElementById("OPassword").value!=document.getElementById("lPW").innerHTML)
											document.getElementById("OPassword").style.borderBottom="1px solid red";
										else
										{
											document.getElementById("OPassword").style.borderBottom="1px solid rgb(0,102,145)";
											
											document.getElementById("sub").disabled=false;
											document.getElementById("uPassu").style.opacity="0.7";
											$resV=false;
											update("close");
										}

										
									}
								else
								{
									if(document.getElementById("OPassword").value=="")
										document.getElementById("OPassword").style.borderBottom="1px solid red";
									else
										document.getElementById("OPassword").style.borderBottom="1px solid rgb(0,102,145)";
									
									if(document.getElementById("Password1").value=="")
										document.getElementById("Password1").style.borderBottom="1px solid red";
									else
										document.getElementById("Password1").style.borderBottom="1px solid rgb(0,102,145)";
									
									if(document.getElementById("Password2").value=="")
										document.getElementById("Password2").style.borderBottom="1px solid red";
									else
										document.getElementById("Password2").style.borderBottom="1px solid rgb(0,102,145)";
								
								}
								}
								break;
							}
							case "dn":
							{
								if (document.getElementById("bDate").value!="")
    								{
    									document.getElementById("uBD").innerHTML=document.getElementById("bDate").value;
    									 
											document.getElementById("sub").disabled=false;
											document.getElementById("uBDu").style.opacity="0.7";
    									 	$resV=false;
    									 	update("close");
    								}
    								else
    									document.getElementById("bDate").style.borderBottom="1px solid red";
    								
								break;
							}
							case "numD":
							{
								if((document.getElementById("Num").value.length!=8)||(isNaN(document.getElementById("Num").value)))
								{
									document.getElementById("Num").style.borderBottom="1px solid red";
								}
								else
								{
									document.getElementById("uNUM").innerHTML=document.getElementById("Num").value;
    									
											document.getElementById("sub").disabled=false;
											document.getElementById("uNUMu").style.opacity="0.7";
    									 	$resV=false;
    									 	update("close");
								}
								break;
							}
						}
					}

				</script>
		
		<div id="div1">
			<div id="div5">

			<img id="im1" src="logo.png"/>
			<a class="a3" href="index.php"><input type='button' value='HOME' id="l2"/></a>
				</div>
				<label id="uName" style="font-size:40px"></label> <img src="pen.png" width="20px" style="cursor:pointer" onclick="update('nm')" height="15px"/><span style='opacity:0;color:red' id='uNameu'>UNSAVED</span> <br><br><br>
				<table width="120%"><tr><td width='1px'>
				
			<form id="f" method="POST" enctype="multipart/form-data">
				<div id="div7">
				<div  style="border-radius:200px;width:100px;height:100px"><img width="100px" height="100px" style="border-radius:200px" src="user.png" id="pimg"/></div>
				<label class="custom-file-upload">
    			<input onchange="addImg(event)" id="file" type="file" name="image" accept="image/png, image/jpeg"/>
    				up
				</label>
				</div><br><span style='margin-left:15px;opacity:0;color:red' id='uImgu'>UNSAVED</span></td><td id='ch' width='17%'>Change <img src='pen.png' width='20px' height='15px'/></td>
				
				<?php
				
				$src="user.png";
					include_once("connex.php");
					$idcom=connex_object();	
					if ($idcom)
					{
					$requete=$idcom->prepare("select * from user WHERE Email=?");
  					$requete->execute(array($_SESSION["edit"]));
  					$res=$requete->fetchAll();
 					
 					foreach ( $res as $donnee)
  					{
  						if($donnee["image"]!="")
            					$src='data:image/jpeg;base64,'.base64_encode($donnee["image"]);
            			else
            				echo "<script>document.getElementById('ch').innerHTML='ADD <img src=pen.png width=20px height=15px/>';</script>";
  							echo "<label id='lPW' style='display:none'>".$donnee["PassW_U"]."</label>";
            			echo "<script>document.getElementById('pimg').src='".$src."';</script>";
						echo "<script>document.getElementById('uName').innerHTML='".$donnee["FName_U"]." ".$donnee["Name_U"]."'</script>";
						echo "<td><label id='uEmail' style='font-size:18px'>"
						.$donnee["Email"]." </label><img src='pen.png' style='cursor:pointer'  onclick=update('em') width='20px' height='15px'/>  <label style='opacity:0;color:red' id='uEmailu'>UNSAVED</label><br><br><label style='font-size:18px'> "
						."Change Password</label> <img src='pen.png' style='cursor:pointer'  onclick=update('pw') width='20px' height='15px'/>  <label style='opacity:0;color:red' id='uPassu'>UNSAVED</label><br><br><label id='uBD' style='font-size:18px'>"
						.$donnee["Date_Nais_U"]."</label> <img src='pen.png'  onclick=update('dn') width='20px' height='15px' style='cursor:pointer'/>  <label style='opacity:0;color:red' id='uBDu'>UNSAVED</label><br><br><label id='uNUM' style='font-size:18px'>"
						.$donnee["Num_U"]."</label><img src='pen.png' style='cursor:pointer'  onclick=update('numD') width='20px' height='15px'/> <label style='opacity:0;color:red' id='uNUMu'>UNSAVED</label> ";

					}
					echo "</td></tr></table>";
				}
				?>
		</div>
<div id="editDiv" style="border:1px solid grey;position:absolute;top:10em;left:37%;width:30%;border-radius:20px;background-color:white;display:none">
	<img onclick="update('close')" src="close.png" id="closeE" style="display:none;cursor:pointer;width:40px;height:45px;position:absolute;top:-8%;left:95%"/>
			
					<center>
				<br><br><br><br>

			<form id="f" method="POST" enctype="multipart/form-data">
				<div id="em" style="display:none;">
					<label style="float:left;display:none" id="l4">Email Allready in use !</label>
				<input type="email" name="Email" id="Email" value="<?php if(isset($_POST['Email'])) echo $_POST['Email']?>" placeholder="Email"/>
				</div>
				
				<div id="pw" style="display:none;">
				<input type="password" name="OPassword" id="OPassword"  placeholder="Old Password"/><br><br>
				<input type="password" name="Password" id="Password1" pattern=".{8,}" placeholder=" New Password" oninput="testP()" /><label id="l3">(Minimum 8 characters)</label><br><br>
				<input type="password" id="Password2" placeholder="Re-Type New Password" oninput="testP()"/>
				</div>

				<div id="nm" style="display:none;">
				<input type="text" id="Name" name="Name" value="<?php if(isset($_POST['Name'])) echo $_POST['Name']?>" placeholder="Name"/><br><br>
				<input type="text" id="FName" name="FName" value="<?php if(isset($_POST['FName'])) echo $_POST['FName']?>" placeholder="First Name"/>
				</div>

				<div id="numD" style="display:none;">
				<input type="text" id="Num" name="Num" value="<?php if(isset($_POST['Num'])) echo $_POST['Num']?>" placeholder="Phone number (xx xxx xxx)" pattern="[0-9]{8}"/><br><br>
				</div>

				<div id="dn" style="display:none;">
				<input name="bDate" id="bDate" type='date'/>
				</div>

				<br><br><input type='button' onclick="CheckValues()" class="done" id="done" value="Done"/>
			</center>
				</div>
				<input type="submit" name="sub" id="sub" value="Save Changes" disabled/>	
			
			</form>
			
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
  				document.getElementById("uImgu").style.opacity="0.7";
				document.getElementById("sub").disabled=false;
  				document.getElementById("ch").innerHTML="Change <img src='pen.png' width='20px' height='15px'/>";
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
					document.getElementById("done").disabled=true;	
				}
				else
				{
					document.getElementById("Password2").style.borderColor="rgb(0,102,145)";
					document.getElementById("done").disabled=false;
				}
			}
		</script>
		<?php
			if((isset($_POST["Email"]))&&($_POST["Email"]!=""))
			{	
				$email=$_POST["Email"];
				$req=$idcom->prepare("SELECT Email from user where(Email=:Email)");
  				$req->bindParam(':Email',$email);
				$req->execute();
				$res=$req->fetchAll();
 						
						if($res)
						{
							
							echo "<script>document.getElementById('editDiv').style.display='inherit';";
							echo "document.getElementById('em').style.display='inherit';";	
							echo "document.getElementById('l4').style.display='inherit';";
	    					echo "document.getElementById('Email').style.borderColor='red';</script>";
						}
					else
					{
						$req1=$idcom->prepare("UPDATE user SET  Email=:email WHERE Email='".$_SESSION["edit"]."'");
						$req1->bindParam(':email',$email);
						if($req1->execute())
						{
							$_SESSION["edit"]=$email;
							echo "<script>document.getElementById('uEmail').innerHTML='".$email."';
							document.getElementById('Email').value=''</script>";
						}
					}	
							
			}
			if((isset($_POST["Password"]))&&($_POST["Password"]!=""))
			{	
				$password=$_POST["Password"];
				$requete=$idcom->prepare("UPDATE user SET  PassW_U=:password WHERE Email='".$_SESSION["edit"]."'");
				$requete->bindParam(':password',$password);
				$requete->execute();
					echo "<script>document.getElementById('lPW').innerHTML='".$_POST["Password"]."';
							document.getElementById('OPassword').value='';
							document.getElementById('Password1').value='';
							document.getElementById('Password2').value='';
							</script>";
						
			}
			if((isset($_POST["Name"]))&&($_POST["Name"]!=""))
			{
				$name=$_POST["Name"];
				$fname=$_POST["FName"];
				$requete=$idcom->prepare("UPDATE user SET  Name_U=:name, FName_U=:fname WHERE  Email='".$_SESSION["edit"]."'");
				$requete->bindParam(':name',$name);
				$requete->bindParam(':fname',$fname);
				$requete->execute();	
							echo "<script>document.getElementById('Name').value='';
							document.getElementById('FName').value='';
							document.getElementById('uName').innerHTML='".$fname." ".$name."';
							</script>";	
			}
			if((isset($_POST["Num"]))&&($_POST["Num"]!=""))
			{
				$num=$_POST["Num"];
				$requete=$idcom->prepare("UPDATE user SET Num_U=:num WHERE Email='".$_SESSION["edit"]."'");
				$requete->bindParam(':num',$num);		
				$requete->execute();	
				echo "<script>document.getElementById('Num').value='';
							document.getElementById('uNUM').innerHTML='".$num."';
							</script>";	
			
			}
			if(array_key_exists('image',$_FILES))
						{
			if($_FILES["image"]["tmp_name"]!="")
			{
				$file="";
				$file=file_get_contents($_FILES["image"]["tmp_name"]);
				$requete=$idcom->prepare("UPDATE user SET image=:file WHERE Email='".$_SESSION["edit"]."'");
				$requete->bindParam(':file',$file, PDO::PARAM_LOB);
  				$requete->execute();
  				$src='data:image/jpeg;base64,'.base64_encode($file);
  				echo "<script>document.getElementById('pimg').src='".$src."';</script>";
            	echo "<script>document.getElementById('ch').innerHTML='Change <img src=pen.png width=20px height=15px/>';</script>";
			}
			}
			if((isset($_POST["bDate"]))&&($_POST["bDate"]!=""))
			{
				$bDate=$_POST["bDate"];
				$requete=$idcom->prepare("UPDATE user SET Date_Nais_U=:bDate WHERE Email='".$_SESSION["edit"]."'");
				$requete->bindParam(':bDate',$bDate);
				$requete->execute();     
				echo "<script>document.getElementById('bDate').value='';
							document.getElementById('uBD').innerHTML='".$bDate."';
							</script>";	
			}			
  				
		?>
	</body>
</htmL>