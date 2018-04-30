<?php
session_start();

if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)) 
{
    header('location:panel.php');
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
        
        <a href="rejestracja.php"></a>Zarejestruj się <br><br>
        
        
        <form action="zaloguj.php" method="post">
            Login:<br><input type="text" name="login"/> <br><br>
            Hasło:<br><input type="password" name="haslo"/> <br><br>
            <input type="submit" value="zaloguj się"/>

            
        </form>
        
        <?php
            if(isset($_SESSION['blad'])) 
                {echo $_SESSION['blad'];}
        ?>
    </body>
</html>