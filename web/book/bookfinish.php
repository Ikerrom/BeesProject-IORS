
<?php
/*	Finaliza la reserva y manda a la base de datos el dinero que debe pagar */ 
session_start();
include_once '../test_connect_db.php';
$dni = $_SESSION['erablitzailea_a_g'];
$conn = ConnectDataBase();
$ret = new stdClass();

if (isset($_GET['x'])) {
	$finishdate = $_GET['x'];
	$arr = explode( ',', $finishdate );
} else{
	$arr = array("2018-01-01",0);
}

if ($arr[1] > 0) {
	include("../calendar.php");
	$stmt6 = $conn->prepare("DELETE FROM reservas WHERE dni = ? AND dia_reservado = ?");
	$stmt6->bind_param('ss',$dni, $arr[0]);
	$stmt6->execute();
	$stmt6->close();

	$stmt7 = $conn->prepare("UPDATE personas SET dinero_pagar = dinero_pagar + ? WHERE dni = ?");
	$stmt7->bind_param('ds',$arr[1],$dni);
	$stmt7->execute();
	$stmt7->close();
	$conn->close();
}


?>