<html>
	<head>
		<link rel="stylesheet" href="css.css">
		<title>ERLETE</title>
	</head>
	<body>

		<div class="title">
			<div class="perfil">
			    <?php
			    session_start();
			    include("test_connect_db.php");
				$dni = $_SESSION['erablitzailea_a_g'];
				$user = $_POST["Usuario"];
				$link =  ConnectDataBase();

				$result=mysqli_query($link, "select nombre from Personas where dni = '$dni'");

				if (isset($_SESSION['erablitzailea_a_g']))
					{
					?>
						<p><?php echo "$result";?></p>
					<?php
					}
				?>
			</div>	

		<p class="titletext">ERLETE</p></div>
		
		<div class="topbar">
			
			    <?php
			    include(testlogin.php)
					if (isset($_SESSION['erablitzailea_a_g'])) 
					{
				?>			
				<form action="singout.php">
					<input class="buttonT" type="submit" value="Log Out"/>
				</form>

				<form action="account.php">
					<input class="buttonT" type="submit" value="Your Account"/>
				</form>

				<form action="booking.php">
					<input class="buttonT" type="submit" value="Booking"/>
				</form>

				<?php
					}else{
					?>
					<form action="login.php">
						<input class="buttonT" type="submit" value="Log In"/>
					</form>
					<?php
					}
				?>
			<form action="about.php">
						<input class="buttonT" type="submit" value="About Us"/>
					</form>
			
		</div>

	</body>
</html>
