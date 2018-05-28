<?php
	error_reporting(E_ALL);
	session_start();

        	require_once "connect.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

$id=$_GET['id1'];
echo $id;
             $polaczenie->query ("DELETE FROM pojazd WHERE id_Poj='".$id."'");
   
header('Location:pojazdya.php');
$polaczenie->close();

?>
