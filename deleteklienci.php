<?php
	error_reporting(E_ALL);
	session_start();

        	require_once "connect.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

$id=$_GET['id'];
echo $id;
             $polaczenie->query ("DELETE FROM kli_prac WHERE id_KliPrac='".$id."'");
   
             header('Location:klienci.php');
$polaczenie->close();

?>
