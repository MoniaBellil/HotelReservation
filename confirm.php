
<?php	
session_start();
	$x=0;
include_once("connex.php");
$idcom=connex_object();
if(isset($_POST["sub"]))
{
	$email=$_POST["Email"];
	if(!(array_key_exists('e1',$_SESSION)))
	{
		$requete=$idcom->prepare("select * from user WHERE (Email=?)");
		$requete->execute(array($email));
		$res=$requete->fetchAll();
		if ($res)
		{
			$x=1;
		}
	}
	if($x==0)
	{
	$price=$_POST["fullPrice"];
	$pass=$_POST["pass"];
	if(!(array_key_exists('e1',$_SESSION)))
	{
		$name="";
		$fname="";
		$num="";
		if(isset($_POST["Name"]))
			$name=$_POST["Name"];
		if(isset($_POST["FName"]))
			$fname=$_POST["FName"];
		if(isset($_POST["Num"]))
			$num=$_POST["Num"];
		
		$requete=$idcom->prepare("INSERT INTO tmp_user VALUES (:email, :pass, :Name, :Fname, :Num)");
		$requete->bindParam(':email',$email);
		$requete->bindParam(':pass',$pass);
		$requete->bindParam(':Name',$name);
		$requete->bindParam(':Fname',$fname);
		$requete->bindParam(':Num',$num);
		$requete->execute();
  	}
  		$total=0;
  		$requete=$idcom->prepare("SELECT MAX(Code_R) as 'total' FROM reservation");
  		$requete->execute();
  		
  		$res=$requete->fetchAll();
		foreach ( $res as $donnee)
		
			$total=$donnee["total"];
		
		$total++;
		
  		$requete=$idcom->prepare("INSERT INTO payment VALUES (:id,:nameC, :numC, :ExpM, :ExpY, :cvv)");
		$requete->bindParam(':id',$total);
		$requete->bindParam(':nameC',$_POST["cardname"]);
		$requete->bindParam(':numC',$_POST["cardnumber"]);
		$requete->bindParam(':ExpM',$_POST["expmonth"]);
		$requete->bindParam(':ExpY',$_POST["expyear"]);
		$requete->bindParam(':cvv',$_POST["cvv"]);
		$requete->execute();
		
		$dateA=$_POST["dateA"];
		$dateD=$_POST["dateD"];
		$persNum=$_POST["persNumb"];

		if (isset($_POST["Tras"]))
			$trans=$_POST['r1'];
		else
			$trans="no";

		if (isset($_POST["RoomServ"]))
			$serv="yes";
		else
			$serv="no";
		$op="";
		if (isset($_POST["VIP"]))
			$op=$op."VIP Suit<br>";
		if (isset($_POST["tour"]))
			$op=$op."Guided Touristic tour<br>";
		if (isset($_POST["Dinner"]))
			$op=$op."Private Dinner<br>";
		if (isset($_POST["Bar"]))
			$op=$op."Bar open tab<br>";
		if (isset($_POST["Pool"]))
			$op=$op."Pool and SPA acess";
		$requete=$idcom->prepare("INSERT INTO reservation VALUES (:code, :idH,:Email, :dateA, :dateD, :pers, :trans, :serv, :op,:price)");
		$requete->bindParam(':code',$total);
		$requete->bindParam(':idH',$_SESSION["hotelId"]);
		$requete->bindParam(':Email',$email);
		$requete->bindParam(':dateA',$dateA);
		$requete->bindParam(':dateD',$dateD);
		$requete->bindParam(':pers',$persNum);
		$requete->bindParam(':trans',$trans);
		$requete->bindParam(':serv',$serv);
		$requete->bindParam(':op',$op);
		$requete->bindParam(':price',$price);
		if($requete->execute())
		{
		$_SESSION["resID"]=$total;
		$_SESSION["resEmail"]=$email;
		header("location: done.php");
		}
		else
		{
			echo "<script>alert('Error Please Try again');</script>";
		}
}		
}
if($_SESSION["hotelId"]=="")
{
	header("location: redirect.php?id=canceled");
}

?>
<!DOCTYPE HTML>
<htmL>
	<head>
		<meta charset="utf-8"/>
		<title>Arab Soft</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="style2.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="short icon" type="image/x-icon" href="logo.png">
		<style>

		input[type=number]{
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
	input[type=button]
		{
			width:50%;
			height:40px;
			color:white;
			font-weight:bolder;
			background:rgb(0,102,145);
			border-radius: 9px;
		}
		
			#div1
			{
				height:100%;
				min-height:950px;
				width:70%;
				margin-top:10%;
				margin-left: 14%;
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
	
		</style>
    
	</head>
	<body>
<script>

			function show2()
			{
				if(document.getElementById("Trans").checked)
					document.getElementById("radioDiv").innerHTML="<input checked value='Taxi' id='taxi' type='radio' name='r1' /><span style='font-weight: bolder'>Taxi  <label style='color:green;font-weight:bolder'>10DT</label></span><input id='Uber' value='Uber' style='margin-left:40px' type='radio' name='r1'/><span style='font-weight: bolder'>Uber</span> <label style='color:green;font-weight:bolder'>35DT</label>";
				else
					document.getElementById("radioDiv").innerHTML="";
					
			}

			function show()
			{
				document.getElementById("formdata").innerHTML="<input type='button' id='canc' style='float:right;width:70px;' value='Cancel' onclick='hide()'/><input type='text' id='Name' name='Name' placeholder='Name' required/><br><br><input type='text' name='FName' id='FName' placeholder='First Name' required/><br><br><input type='text' name='Num' id='Num' pattern='[0-9]{8}' placeholder='Phone Number (xx xxx xxx)' required/><br><br><input type='button' style='float:right' onclick='next1(2)'' value='Next !'/>";
				document.getElementById("buttons").style.display="none";	
					
			}
		</script>
		<form id="f" method="POST">
		<div id="OpDiv" style="display:none;font-size:20px;width:26%;border:4px solid grey;top:100%;left:35%;padding:18px;border-radius:20px;z-index:6;position:absolute;background-color:white">
						
						<input type="checkbox" id="tour" name="tour"/>Guided Touristic tour <label style='float:right;color:green'>20DT/Person</label><br><br>
						<?php
							if(isset($_POST['tour']))
						 	 	echo "<script>document.getElementById('tour').checked=true;</script>";
					 	?>

						<input type="checkbox"  id="Pool" name="Pool"/>Pool and SPA access <label style='float:right;color:green'>20DT/Person</label><br><br>
						<?php
							if(isset($_POST['Pool']))
						 	 	echo "<script>document.getElementById('Pool').checked=true;</script>";
					 	?>
						<input type="checkbox" id="VIP" name="VIP"/>VIP Suit <label style='float:right;color:green;margin-right:17%'>75DT</label><br><br>
						<?php
							if(isset($_POST['VIP']))
						 	 	echo "<script>document.getElementById('VIP').checked=true;</script>";
					 	?>
						
						<input type="checkbox" id="Dinner" name="Dinner"/>Private Dinner <label style='float:right;color:green;margin-right:17%'>15DT</label><br><br>
						<?php
							if(isset($_POST['Dinner']))
						 	 	echo "<script>document.getElementById('Dinner').checked=true;</script>";
					 	?>

						<input type="checkbox" id="Bar" name="Bar"/>Bar open tab.<br><br>
						<?php
							if(isset($_POST['Bar']))
						 	 	echo "<script>document.getElementById('Bar').checked=true;</script>";
					 	?>

						<input type="button" value="Done" onclick="hideOp()" style="width:60px;height:40px;float:right"/>
					</div>
		<div id="div1">
			<div id="div5">
			<img id="im1" src="logo.png"/>
				<a class="a3" href="redirect.php?id=canceled"><input type="button" id="l2" value="Cancel"/></a>
				</div>
				
				<?php

					$requete=$idcom->prepare("select * from hotel where Id_H=:id");
					$requete->bindParam(':id',$_SESSION["hotelId"]);
					$requete->execute();
			  		$res=$requete->fetchAll();
					echo "<table style='margin-top:10%;margin-left:2%'>";
					foreach ( $res as $donnee)
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
				?>
				<br><br>
				<center>
				<div id="steps" style="width:100%;height:45px;border-radius:0px;background-color:rgb(230,230,230)">
				<table style="margin-left:7%" width="100%"><tr>
				<td><img style="cursor:pointer;" id="st1" onclick="backk('st1')"  width="50px" height="40px" src="prog1.png"/></td><td><img id="st2" style="cursor:pointer;" width="50px" height="40px"  onclick="backk('st2')" src="yet2.png"/></td><td><img  onclick="backk('st3')" style="cursor:pointer;" id="st3" width="50px" height="40px"  src="yet3.png"/></td><td width="1px"><img  width="50px" height="40px" style="cursor:pointer;"  onclick="backk('st4')" id="st4" src="yet4.png"/></td><td style="color:rgb(0,102,145)">Confirmation</td>
				</tr></table>
				</div>
				</center>

				<br><br><br><br>
				<label style="float:right;font-weight:bolder;margin-right:3%;color:green"><label style="color:black;font-size:16px">Reservation price: </label><label id="price"></label>DT</label>

				<script>
					document.getElementById("price").innerHTML=price;
				</script>
				<br>
				<label id='InUse' style='display:none;margin-left:1em;color:red;font-size:16px;font-weight:bolder;'>This Email is allready in use ! Please use another Email or <a href='redirect1.php?t=4' style="text-decoration:none;color:rgb(0,102,145);">Sign in</a></label>
				<?php
					if($x==1)
						echo "<script>document.getElementById('InUse').style.display='inherit';</script>";
				?>
				<div id="step1">
				<div id="EmailDiv">
				<input type="email" id="Email" name="Email" placeholder="Email" value="<?php if(isset($_POST['Email'])) echo $_POST['Email']?>" required/><br><br>
				<div id="passDiv"></div>
				</div>
				<div id="fillData">
					<br><div id="formdata">
					</div>
					<br><br>
				<div id='buttons'>
					<input type="button" onclick="show()" value="Fill Form right now !"/>
					<input type="button" style="float:right" onclick="next1(1)" value="Fill Form on arrive !"/>
				</div>
						<?php
						if(isset($_POST["Name"]))
							echo "<script>show()
								document.getElementById('Name').value='".$_POST["Name"]."'
								document.getElementById('FName').value='".$_POST["FName"]."'
								document.getElementById('Num').value='".$_POST["Num"]."'
								</script>";

					?>	
				</div>
				</div>
				<div id="step2" style="display:none">
					<label id="wrongDates" style='color:red;font-size:15px;font-weight:bolder'></label><br><br>
				<table width='100%'><tr><td><span style='font-weight:bolder'>From:</span><input id="dateA" value="<?php if(isset($_POST['dateA'])) echo $_POST['dateA']?>" name='dateA' type='date' required/></td><td><span style='font-weight:bolder'>To:</span><input id="dateD" value="<?php if(isset($_POST['dateD'])) echo $_POST['dateD']?>" name='dateD' type='date' required/></td></tr></table><br><input style='display:none' type='submit' name='sub' id='sub' value='Next !'/>
				<br>
				<input type="button" style="float:right" value="Next !" onclick="next2()"/>
				</div>
				<div id="step3"  style="display:none">
					<label id="invalidPepNumb" style='color:red;font-size:14px;font-weight:bolder'></label><br><br>
					<input type="number" name="persNumb"  value="1" id="persNumb" oninput="calculPrice()" min="1" max="10" value="1" style="width:30%"/><label style="margin-left:-160px;color:grey">Number of people</label>
					<?php if(isset($_POST['persNumb'])) echo "<script>document.getElementById('persNumb').value='".$_POST['persNumb']."';</script>"?>
					<div style="float:right;margin-right:3%;margin-top:-10px">
					<input type="button" style="width:150px;height:40px;" value="Other option" onclick="showOp()">
					<br><br>
					</div>
					<br><br>
					<input type="checkbox" name="Tras" id="Trans" onclick="show2()"/><span style="font-weight: bolder">Transportation from airport</span>

					<?php
					 if(isset($_POST['Tras']))

					 	 echo "<script>document.getElementById('Trans').checked=true;
					 			
					 			</script>";
					 ?>
					
					<div id="radioDiv" style="float:right;margin-right:40%;">
					</div>
					<?php
						if(isset($_POST["r1"]))
						{
						echo "<script>show2();</script>";
						if ($_POST["r1"]=="Uber")
					 		echo "<script>;document.getElementById('Uber').checked=true;</script>";
					 	}
					 ?>
					<br><br>
					<input type="checkbox" id="RoomServ" name="RoomServ" /><span style="font-weight: bolder">Room Service</span> <label style='color:green;font-weight:bolder'>25DT</label><br><br>
					
					<?php 
					if(isset($_POST['RoomServ']))
						echo "<script>document.getElementById('RoomServ').checked=true;</script>";
					?>
					
					<input type="button" style="float:right" value="Next !" onclick="next3()"/>
				</div>	
				<div id="step4"  style='display:none'>
					<label style="float:right;margin-right:3%;font-weight:bolder;color:green"><label style="color:black;font-size:16px">Additional price: </label><label id="AdPrice">0</label>DT</label><br>
					
					<label style="float:right;margin-right:3%;font-weight:bolder;color:green"><label style="color:black;font-size:16px">Final price: </label><label id="FinalPrice">0</label>DT</label>					
					 <h1 style="font-size:280%">Payment</h1>
		   			
		   			<label for="fname" style="font-size:24px">Accepted Cards</label>
		            <br><br>
		   			<div style="font-size: 35px;">
		   				<i class="fa fa-cc-visa" style="color:navy;"></i>
		              	<i class="fa fa-cc-amex" style="color:blue;"></i>
		              	<i class="fa fa-cc-mastercard" style="color:red;"></i>
		              	<i class="fa fa-cc-discover" style="color:orange;"></i>
					</div>
		            <input type="text" pattern="[a-zA-Z ]{3,}" value="<?php if(isset($_POST['cardname'])) echo $_POST['cardname']?>" id="cname" name="cardname" placeholder="Name on Card" required/>
		            
		            <input type="text" id="ccnum" pattern="[0-9]{16}" name="cardnumber" value="<?php if(isset($_POST['cardnumber'])) echo $_POST['cardnumber']?>" required placeholder="Credit card number (1111-2222-3333-4444)"/>
		            
		            <input type="text" pattern="[0-9]{2}" value="<?php if(isset($_POST['expmonth'])) echo $_POST['expmonth']?>" id="expmonth" name="expmonth" required placeholder="Exp Month (03)"/>
		 			
		 			<input type="text" id="expyear" pattern="20.{2}" name="expyear" value="<?php if(isset($_POST['expyear'])) echo $_POST['expyear']?>" required placeholder="Exp Year (2022)">
		            
		            <input type="text" pattern="[0-9]{3}" value="<?php if(isset($_POST['cvv'])) echo $_POST['cvv']?>" id="cvv" name="cvv" required placeholder="cvv (352)">
					
					<input type="text" style="display:none" value="<?php if(isset($_POST['fullPrice'])) echo $_POST['fullPrice']?>" name="fullPrice" id="fullPrice"/>
		        	
		        	<input style="float:right;" type="submit" name="sub" id="sub" value="Validate"/>
					
		        	<br><br>
				
		        </div>
			</form>
			<br><br>
				<?php

						if((array_key_exists('e1',$_SESSION))&&($_SESSION["e1"]!=""))
							{
							echo "<script>document.getElementById('st1').src='done1.png';
							document.getElementById('st2').src='prog2.png'
							document.getElementById('step1').style.display='none';
							document.getElementById('step2').style.display='inherit';
							document.getElementById('Email').value='".$_SESSION["e1"]."';
							document.getElementById('Email').setAttribute('readonly',true);</script>";
							$requete=$idcom->prepare("select Name_U,FName_U,Num_U from user WHERE Email=?");
		  					$requete->execute(array($_SESSION["e1"]));
		  					$res=$requete->fetchAll();
		 					foreach ( $res as $donnee)
		 					{
		 						echo "<script>
		 								show();
		 								document.getElementById('canc').style.display='none';
										document.getElementById('Name').value='".$donnee["Name_U"]."';
										document.getElementById('Name').setAttribute('readonly',true);
										document.getElementById('FName').value='".$donnee["FName_U"]."';
										document.getElementById('FName').setAttribute('readonly',true);
										document.getElementById('Num').value='".$donnee["Num_U"]."';
										document.getElementById('Num').setAttribute('readonly',true);
									  </script>";
		 					}
						}
						else
						{
				$p=addcslashes('<input required type="password" name="pass" id="pass" placeholder="Create a Reservation Password"/>','"');
							echo "<script>
									document.getElementById('fillData').style.display='inherit';";
									echo "document.getElementById('passDiv').innerHTML='".$p."'";;
									echo "</script>";
						}

					if(isset($_POST['pass']))
					{
						 echo "<script>document.getElementById('pass').value='".$_POST['pass']."';</script>";
					}
				?>
			
		
		</div>

		<script>
			function backk(id)
			{
  				num= id.substr(2, 1);
  				src1="done"+num+".png";
  				
  				src=document.getElementById(id).src.substr(document.getElementById(id).src.length-9, 9);
				if (src==src1)
					{
					document.getElementById(id).src="prog"+num+".png";
					num1=parseInt(num);
					num1++;
					while(num1<=4)
					{
						document.getElementById("st"+num1).src="yet"+num1+".png";
						num1++;
					}
					num1=parseInt(num);
					num1--;
					while(num1>=1)
					{
						document.getElementById("st"+num1).src="done"+num1+".png";
						num1--;
					}
					
			/*By Khaili Med Amine*/
					document.getElementById(id).src="prog"+num+".png";
					document.getElementById("step1").style.display="none";
					document.getElementById("step2").style.display="none";
					document.getElementById("step3").style.display="none";
					document.getElementById("step4").style.display="none";
					document.getElementById("step"+num).style.display="inherit";
					}
			}
			function next3()
			{
				adprice=0;
				if(document.getElementById("tour").checked)
					adprice+=20*document.getElementById("persNumb").value;

				if(document.getElementById("Pool").checked)
					adprice+=20*document.getElementById("persNumb").value;

				if(document.getElementById("VIP").checked)
					adprice+=75;

				if(document.getElementById("Dinner").checked)
					adprice+=15;
				if(document.getElementById("Trans").checked)
					{
					if(document.getElementById("taxi").checked)
						adprice+=10;
					else
						adprice+=35;
					}
				if(document.getElementById("RoomServ").checked)
					adprice+=25;
				document.getElementById("AdPrice").innerHTML=adprice;
				FinalPrice=adprice+parseInt(document.getElementById("fullPrice").value);	
				document.getElementById("FinalPrice").innerHTML=FinalPrice;
				document.getElementById("fullPrice").value=FinalPrice;
				x=0;
				if(document.getElementById("persNumb").value>10)
				{
					document.getElementById("persNumb").style.borderBottom="1px solid red";
					document.getElementById("invalidPepNumb").innerHTML="Max 10 people in one reservation !";
					x++;
				}
				if(document.getElementById("persNumb").value<1)
				{
					document.getElementById("persNumb").style.borderBottom="1px solid red";	
					document.getElementById("invalidPepNumb").innerHTML="Min 1 person in one reservation !";
					x++;
				}

				if (x==0)
				{	
				document.getElementById("step3").style.display="none";
				document.getElementById("step4").style.display="inherit";
				document.getElementById('st3').src='done3.png';
				document.getElementById('st4').src='prog4.png';	
				document.getElementById("persNumb").style.borderBottom="1px solid rgb(0,102,145)";
				document.getElementById("invalidPepNumb").innerHTML="";
				
				}
			}
			function showOp()
			{
				document.getElementById('div1').style.filter='blur(3px)';
				document.getElementById('div1').style.pointerEvents='none';
				
				document.getElementById('OpDiv').style.display='inherit';
			}
			function hideOp()
					{
						document.getElementById('OpDiv').style.display='none';
						document.getElementById('div1').style.filter='none';
						document.getElementById('div1').style.pointerEvents='auto';
					}
				
			
			function next1(id)
			{
				document.getElementById("InUse").style.display="none";
				x=0;
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				if (!(re.test(String(document.getElementById("Email").value).toLowerCase())))
					{
					document.getElementById("Email").style.borderBottom="1px solid red";
					x++;
					}
				else
					document.getElementById("Email").style.borderBottom="1px solid rgb(0,102,145)";
				
				if(document.getElementById("passDiv").innerHTML!="")
				{
					if(document.getElementById("pass").value=="")
					{
						document.getElementById("pass").style.borderBottom="1px solid red";
						x++;
						}
					else
						document.getElementById("pass").style.borderBottom="1px solid rgb(0,102,145)";
				}
				if (id==2)
				{
				if(document.getElementById("Name").value=="")
					{
					x++;
					document.getElementById("Name").style.borderBottom="1px solid red";
					}
				else
					document.getElementById("Name").style.borderBottom="1px solid rgb(0,102,145)";

				if(document.getElementById("FName").value=="")
					{
					x++;
					document.getElementById("FName").style.borderBottom="1px solid red";
					}

				else
					document.getElementById("FName").style.borderBottom="1px solid rgb(0,102,145)";
				tel=/^\d{8}$/;
				if(!(tel.test(String(document.getElementById("Num").value))))
					{
					x++;
					document.getElementById("Num").style.borderBottom="1px solid red";
					}

				else
					document.getElementById("Num").style.borderBottom="1px solid rgb(0,102,145)";			
				}
				if(x==0)
				{
					document.getElementById("step1").style.display="none";
					document.getElementById("step2").style.display="inherit";
					document.getElementById('st1').src='done1.png';
					document.getElementById('st2').src='prog2.png';	
				}
			}
			function next2()
			{

				document.getElementById("wrongDates").innerHTML="";
				x=0;
				if (document.getElementById("dateA").value=="")
				{
					x++;
					document.getElementById("dateA").style.borderBottom="1px solid red";
				}
				else
					{
						dateA=
					document.getElementById("dateA").style.borderBottom="1px solid rgb(0,102,145)";	
					}
				
				if (document.getElementById("dateD").value=="")
				{
					x++;
					document.getElementById("dateD").style.borderBottom="1px solid red";
				}
				else
				{
					document.getElementById("dateD").style.borderBottom="1px solid rgb(0,102,145)";
				}

				date=new Date();
				date.getMonth()+1;
				date1=date.getMonth()+1;
				if(date>10)
				{
					date1="0"+date1;
				}
				day=date.getDate();
				if(day<10)
				{
					day="0"+day;	
				}
				date1=date.getFullYear()+"-"+date1+"-"+day;
				if(date1>document.getElementById("dateA").value)
				{
					x++;
					document.getElementById("wrongDates").innerHTML="Invalid arrive Date !";	
				}
				if(document.getElementById("dateA").value>document.getElementById("dateD").value)
				{
					x++;
					document.getElementById("wrongDates").innerHTML="Check the Dates !";
				}			
			if(x==0)
			{
				date1=new Date(document.getElementById("dateA").value);
				date2=new Date(document.getElementById("dateD").value);
				timeDiff=Math.abs(date2.getTime()-date1.getTime());
				daysDiff=Math.ceil(timeDiff/(1000*3600*24));
				price2=price*daysDiff;
				if(price2==0)
					price2=price;
				document.getElementById("price").innerHTML=price2;
				document.getElementById("fullPrice").value=price2;
				document.getElementById("step2").style.display="none";
				document.getElementById("step3").style.display="inherit";
				document.getElementById('st2').src='done2.png';
				document.getElementById('st3').src='prog3.png';	
			}
			}	
			
			function hide()
			{
				document.getElementById("formdata").innerHTML="";
				document.getElementById("buttons").style.display="inherit";
			}
			addprice2=0;
			pNB=1;
			price1=0;
			function calculPrice()
			{
				if((document.getElementById("persNumb").value>0)&&(document.getElementById("persNumb").value<=10))
				{
					price1=price2*document.getElementById("persNumb").value;
					document.getElementById("price").innerHTML=price1;
					document.getElementById("fullPrice").value=price1;
				}
				else
				{
					price1=price2;
					document.getElementById("price").innerHTML=price1;
					document.getElementById("fullPrice").value=price1;
				}		
			}
			
		</script>
	
</body>
</htmL>