
<?php
session_start();

if(!isset($_SESSION['zalogowany']))
{
    header('location:logowanie.php');
    exit();
    
}

?>

<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>Panel</title>   
    </head>
    <body>
        <?php
        echo "<p>Witaj ".$_SESSION['user'].'![<a href="logout.php">Wyloguj</a>]</p>';
        
        echo "<p><b>Imię</b>: ".$_SESSION['Imie'];
        echo "<p><b>Nazwisko</b>: ".$_SESSION['Nazwisko'];
        echo "<p><b>Pesel</b>: ".$_SESSION['Pesel'];
        echo "<p><b>Telefon</b>: ".$_SESSION['Telefon'];
        echo "<p><b>Adres</b>: ".$_SESSION['Adres'];
        echo "<p><b>Email</b>: ".$_SESSION['Email'];
        
        ?>
        
    </body>
</html>