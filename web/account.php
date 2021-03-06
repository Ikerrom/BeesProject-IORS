<!DOCTYPE html>
<html>
<?php session_start();
 ?>
	  <head>  
	  		<!-- todos los scripts y los links para el cabezado de la pagina -->
				<meta charset="utf-8">
 				<meta name="viewport" content="width=device-width, initial-scale=1">
  				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
				<link rel="stylesheet" href="css.css">
				<title>Account</title>		<!-- Titulo de la Pagina(Encabezado) -->
				<link rel="shortcut icon" href="resources/images/web_imges/bee.ico" type="image/x-icon">
				<link rel="preconnect" href="https://fonts.gstatic.com">
				<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500display=swap" rel="stylesheet">



			</head>
	  <body>



					<div class="title">
												<!-- PHP -->
					<!-- Si esta con la sesion iniciada que pueda navegar 
					a traves de las distintas paginas que tenemos, HOME,
					Booking,About Us y Log out -->
						<p class="titletext">ERLETE</p>
					</div>
						<div class="topbar">

					    <?php
							if (isset($_SESSION['erablitzailea_a_g'])) 
							{
						?>
						<form action="index.php">
							<input class="buttonT" type="submit" value="HOME"/>
						</form>

						<form action="booking.php">
							<input class="buttonT" type="submit" value="BOOKING"/>
						</form>

						<form action="about.php">
								<input class="buttonT" type="submit" value="ABOUT US"/>
							</form>

						<form action="singout.php">
							<input class="buttonT" type="submit" value="LOG OUT"/>
						</form>

						

						<?php
						 /**
						 Si no esta logeado en la pagina que solo puedas acceder 
						 al index, al about us o a la pagina de iniciar sesion 
 							*/
							}else{
							?>
							<form action="index.php">
								<input class="buttonT" type="submit" value="HOME"/>
							</form>

							<form action="about.php">
								<input class="buttonT" type="submit" value="ABOUT US"/>
							</form>

							<form action="login.php">
								<input class="buttonT" type="submit" value="LOG IN"/>
							</form>


							<?php
							}
						?>
						</div>

				<div class="arrowdiv">
					<img src="resources/images/web_imges/arrow.gif" class="arrowimg">
				</div>
				<p style="margin-left:44.5vw;font-size: 3vh;color:white;font-weight: bolder; margin-top: 3%;">YOUR PROFILE</p>
	   			<div class="bgdiv">
	   						<div class="photodiv">
							<!-- PHP -->
							<!-- Para el inicio de sesion que compruebe a traves de 
							la base de datos si todos los datos son correctos -->
								<?php
								
				    			if (isset($_SESSION['erablitzailea_a_g'])) {
					    			include("test_connect_db.php");
					    			$dni = $_SESSION['erablitzailea_a_g'];
									$link =  ConnectDataBase();
									$result3=mysqli_query($link, "select Foto from personas where dni = '$dni'");
									$imprimir=mysqli_fetch_array($result3);
									?>
														<!-- PHP -->
									<!-- La parte para que cada usuario pueda cambiar
									 su foto de perfil, botones submit, seleccionar archivos etc
									 enviada a traves de POST -->
								<img  class="photoacc" src="<?php echo $imprimir['Foto']; ?>">
								<form action="upload.php" method="POST" enctype="multipart/form-data">
									<input class="inputfile" type='file' name="imagen" id="imagen">
									<label for="imagen">Choose a file</label>
									<input type="submit" class="buttonSub" value="Upload">
								</form>
													<!-- PHP -->
									<!-- Codigo para que en esta pagina salga toda la informacion de cada persona, 
									a traves de un select queremos elegir todos los datos, 
									dinero,nombre,dni,gmail, foto etc...  -->
	  	 			<?php	
					$result=mysqli_query($link, "select nombre,apellido,gmail,dinero_pagar,dinero_cuenta from personas where dni = '$dni'"); 
					$imprimir = mysqli_fetch_array($result);
					?>

					</div>

					<!-- DIV 
					Este codigo hace que printee todos los datos de cada persona -->

						<div class="bgacc">

						<div class="campoacc">
								<p class="textstyleacc">DNI:</p>
							<?php  	/* printea el dni del usuario*/
								echo $dni;
							?>	
						</div>
						<div class="campoacc">
								<p class="textstyleacc">Name:</p>
							<?php  /* printea el nombre del usuario*/
								echo $imprimir['nombre'];
							?>	
						</div>

					</div>
					<div class="bgacc">
						<div class="campoacc">
								<p class="textstyleacc">Surname:</p>
							<?php  /* printea el apellido del usuario*/
								echo $imprimir['apellido'];
							?>	
						</div>
						<div class="campoacc">
								<p class="textstyleacc">Gmail:</p>
							<?php  /* printea el gmail del usuario*/
								echo $imprimir['gmail'];
							?>	
						</div>
					</div>
					<div class="bgacc">
						<div class="campoacc">
								<p class="textstyleacc">To pay:</p>
							<?php  /* printea el dinero que debe pagar el usuario*/
								echo  $imprimir['dinero_pagar'] . "$";
							?>	
						</div>
						<div class="campoacc">
								<p class="textstyleacc">Acc Money:</p>
							<?php  /* printea el dinero que tiene en cuenta el usuario*/
								echo $imprimir['dinero_cuenta'] . "$";
							?>	
						</div>
					</div>
					

	   			</div>
					<!-- DIV 
					Este codigo hace que printee todos los miembros que hay en Erlete 
					Seleccionando Dni,Nombre,Apellido y Gmail por cada usuario
					 -->
					<div class="tableaccdiv">
						<p style="margin-left:34.8vw;font-size: 3vh;color:white;font-weight: bolder; margin-top: 3%;">MEMBER LIST</p>
						<table class="tableacc">
							<thead>
									<tr>	<!-- titulo de cada columna  -->
										<th>DNI</th>
										<th>NAME</th>
										<th>SURNAME</th>
										<th>GMAIL</th>
									</tr>
							</thead>
							<!-- PHP --> 
							<!--Select para coger los datos que queremos printear  -->
					<?php
						$result2 =mysqli_query($link, "select dni,nombre,apellido,gmail,dinero_pagar,dinero_cuenta from personas"); 
						while($imprimir2 = mysqli_fetch_array($result2)){
							if ($result2->num_rows > 0) { /* Siempre y cuando haya mas de 0 miembros printeara estos datos */
							  	?>
										<tbody> <!-- Tabla de todas las personas  -->
											<tr>
												<td>
													<?php  /* printea el dni del usuario*/
														echo $imprimir2['dni']; 
													?>	
												</td>
												<td>
													<?php  /* printea el nombre del usuario*/
														echo $imprimir2['nombre'];
													?>	
												</td>
												<td>
													<?php  /* printea el apellido del usuario*/
														echo $imprimir2['apellido'];
													?>
												</td>
												<td>
													<?php  /* printea el gmail del usuario*/
														echo $imprimir2['gmail'];
													?>
														
												</td>
											</tr>
										</tbody>
								<?php 
							} else { /* Si hay 0 miembros printeara 0 results*/
							  echo "0 results";
							}
						} 
						?>
					</div>
				<?php 
					} else{ /* Si no estas logeado y intentas entrar te saldra el siguiente mensaje */
						?>
						<p style="	font-size: 4vh; color:white; position: absolute; margin-left:-40%;">You are not logged in</p>

						<?php
					}
		?>
		</table>
	  </body>
</html>


