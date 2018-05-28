<?php
    define('PARENT', true);
$dostepPoZalogowaniu = true;
require_once 'inc/naglowek.inc.php';
require_once "inc/connect.inc.php";
$id=$_GET['id'];
    if(isset($_POST['Marka']))
    {
        // udana walidaja
        $OK=true;

        ///Marka
        $Marka=$_POST['Marka'];
        if((strlen($Marka)<3)||(strlen($Marka)>20))
        {
            $OK=false;
            $_SESSION['e_marka']='Marka musi posiadać od 3 do 20 znaków';       
        }
        if(preg_match("/[^A-z]/",$Marka))
        {
            $OK=false;
            $_SESSION['e_marka']="Imię nie może zawierać cyfr";
        }

        ///Model
        $Model=$_POST['Model'];
        if((strlen($Model)<3)||(strlen($Model)>30))
        {
            $OK=false;
            $_SESSION['e_model']=' Model musi posiadać od 3 do 30 znaków';       
        }
        if(preg_match("/[^A-z]/",$Model))
        {
            $OK=false;
            $_SESSION['e_model']="Model nie może zawierać cyfr";
        }
        ///Rocznik
        $Rocznik=$_POST['Rocznik'];
        if (!preg_match('/^[0-9]{4}$/',$Rocznik))
        {  
            $OK=false;
            $_SESSION['e_rocznik']="Rocznik może zawierać same cyfry  ";
        }
        ///Pojemność Silnika
        $Poj_silnika=$_POST['Poj_silnika'];
        if (!preg_match('/^[0-9]{4}$/',$Poj_silnika))
        {  
            $OK=false;
            $_SESSION['e_poj_silnika']="Pojemność Silnika może zawierać same cyfry  ";
        }

   
        $VIN=$_POST['VIN'];

        if(!preg_match("/[^A-z][0-9]/",$VIN))
        {
            $OK=false;
            $_SESSION['e_vin']="VIN może zawierac litery, cyfry";
        }

        
        ///Pojemność Silnika
        $Moc_silnika=$_POST['Moc_silnika'];
        if (preg_match('/^[0-9]{4}$/',$Moc_silnika))
        {  
            $OK=false;
            $_SESSION['e_moc_silnika']="Moc Silnika może zawierać same cyfry  ";
        }

      
        
        require_once "connect.php";
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
                    if($polaczenie->query("Insert into pojazd values(NULL,'$id','$Marka','$Model','$Rocznik','$Poj_silnika','$VIN','$Moc_silnika')"))
                    {
                      $_SESSION['udana rejestracja']=true;
                      header('Location:pojazdy.php');
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


<?php        require_once 'inc/tpl/menu.inc.php'; ?>

  
        
        

<form method="POST" >
<b>Marka:</b><br> <input type="text" name="Marka"><br>
<?php 
if (isset($_SESSION['e_marka']))
{
    echo '<div class="error">'.$_SESSION['e_marka'].'</div>';
    unset($_SESSION['e_marka']);
}
?>
<b>Model:</b><br> <input type="text" name="Model"><br>
<?php 
if (isset($_SESSION['e_model']))
{
    echo '<div class="error">'.$_SESSION['e_model'].'</div>';
    unset($_SESSION['e_model']);
}
?>
<b>Rocznik</b><br> <input type="text"  name="Rocznik" maxlength="4" ><br>
<?php 
if (isset($_SESSION['e_rocznik']))
{
    echo '<div class="error">'.$_SESSION['e_rocznik'].'</div>';
    unset($_SESSION['e_rocznik']);
}
?>
<b>Pojemność silnika cm3:</b><br> <input type="text" name="Poj_silnika" maxlength="4"><br>
<?php 
if (isset($_SESSION['e_poj_silnika']))
{
    echo '<div class="error">'.$_SESSION['e_poj_silnika'].'</div>';
    unset($_SESSION['e_poj_silnika']);
}
?>
<b>VIN:</b><br> <input type="text" name="VIN" maxlength="17"><br>
<?php 
if (isset($_SESSION['e_vin']))
{
    echo '<div class="error">'.$_SESSION['e_vin'].'</div>';
    unset($_SESSION['e_vin']);
}
?>
<b>Moc silnika:</b><br> <input type="text" name="Moc_silnika" maxlength="4"><br>
<?php 
if (isset($_SESSION['e_moc_silnika']))
{
    echo '<div class="error">'.$_SESSION['e_moc_silnika'].'</div>';
    unset($_SESSION['e_moc_silnika']);
}
?>
<input type="submit" value="Dodaj pojazd" name="Dodaj">
</form>



    </body>
</html>