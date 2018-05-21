<?php

define('PARENT', true);
$dostepPoZalogowaniu = true;
require_once 'inc/naglowek.inc.php';
require_once "inc/connect.inc.php";
$id=$_GET['id'];
$id1=$_GET['id1'];
    if(isset($_POST['Kwota']))
    {
        // udana walidaja
        $OK=true;

       
        $Data_wizyty=$_POST['Data_wizyty'];

  
        $Godzina_wizyty=$_POST['Godzina_wizyty'];
        if((($Godzina_wizyty)<7)||(($Godzina_wizyty)>18))
        {
            $OK=false;
            $_SESSION['e_wizyta']=' Warsztat pracuje od 7 do 18';       
        }
        if(!preg_match("/[0-9]/",$Godzina_wizyty))
        {
            $OK=false;
            $_SESSION['e_wizyta']="Model może zawierać tylko cyfry";
        }

        $Opis_wizyty=$_POST['Opis_wizyty'];

        
        $Kwota=$_POST['Kwota'];
        if (!preg_match('/^[0-9]{1,5}$/',$Kwota))
        {  
            $OK=false;
            $_SESSION['e_kwota']="Kwota może mieć maksymalnie 5 cyfr  ";
        }

      
        mysqli_report(MYSQLI_REPORT_STRICT);
        try
        {
            $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
            if($polaczenie->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                
                if($OK==true)
                {
                   echo "$id.$id1.'1'.$Data_wizyty.$Godzina_wizyty.$Opis_wizyty.$Kwota";
                    if($polaczenie->query("Insert into wizyta_w_warsztacie VALUES(NULL,'$id','$id1',1,'$Data_wizyty','$Godzina_wizyty','$Opis_wizyty','$Kwota')"))
                    {
                      $_SESSION['udana rejestracja']=true;
                      header('Location:klienci.php');
                    }
                    ELSE
                    {
                       throw new Exception($polaczenie->error); 
                    }
                        
                        
                }

                $polaczenie->close();
            }
        }
        catch (Exception $e)
        {
            echo '<span style="color:red"> Błąd serwera!</span>';
            echo '<br> Informacja dew'.$e;
        }
    }


?>
<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>Dodawanie Pojazdu</title>   
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/php.css">               
        <style>
            .error{
                color:red;
                margin:10px;
            }
            
        </style>
    </head>
    <body>
<nav class="navbar navbar-expand-sm bg-light">
    <?php        require_once 'inc/tpl/menu.inc.php'; ?>

</nav>        
        

<form method="POST" >
<b>Data wizyty:</b><br> <input type="date" name="Data_wizyty"><br>

<b>Godzina wizyty</b><br> <input type="text"  name="Godzina_wizyty" maxlength="2" ><br>
<?php 
if (isset($_SESSION['e_wizyta']))
{
    echo '<div class="error">'.$_SESSION['e_wizyta'].'</div>';
    unset($_SESSION['e_wizyta']);
}
?>
<b>Opis wizyty:</b><br> <input type="text" name="Opis_wizyty" maxlength="50"><br>

<b>Kwota:</b><br> <input type="text" name="Kwota" maxlength="5"><br>
<?php 
if (isset($_SESSION['e_kwota']))
{
    echo '<div class="error">'.$_SESSION['e_kwota'].'</div>';
    unset($_SESSION['e_kwota']);
}
?>

<input type="submit" value="Dodaj wizytę" name="Dodaj">
</form>



    </body>
</html>