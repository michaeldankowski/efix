<?php

	session_start();
	
	if (!isset($_SESSION['udanarejestracja']))
	{
		header('Location: logowanie.php');
		exit();
	}
        else
        {
            unset($_SESSION['udanarejestracja']);
        }

?>
<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>Panel</title>   
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        
    </head>
    <body>
        
        Dziekujemy za rejestracje w serwisie <br><br>
        <a href="/logowanie.php">Zaloguj się na swoje konto</a><br><br>
    </body>
</html>