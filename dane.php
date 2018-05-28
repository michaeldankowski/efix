<?php

define('PARENT', true);
$dostepPoZalogowaniu = true;
require_once 'inc/naglowek.inc.php';
require_once "connect.php";
?>

<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <title>Panel</title> 
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/php.css">            
    </head>
    <body>
        <?php        require_once 'inc/tpl/menu.inc.php'; ?>
        <?php
        echo "<p>Witaj ".$_SESSION['Imie']." ".$_SESSION['Nazwisko']."</p>";
	echo "<p><b>Imię</b>: ".$_SESSION['Imie']."</p>";
	echo "<p><b>Nazwisko</b>: ".$_SESSION['Nazwisko']."</p>";
	echo "<p><b>Pesel</b>: ".$_SESSION['Pesel']."</p>";
	echo "<p><b>Telefon</b>: ".$_SESSION['Telefon']."</p>";
	echo "<p><b>Adres</b>: ".$_SESSION['Adres']."</p>";
        echo "<p><b>E-mail</b>: ".$_SESSION['Email']."</p>";
 
// Close connection
mysqli_close($polaczenie);
        ?>
        
    </body>
</html>