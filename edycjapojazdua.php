<?php
    define('PARENT', true);
$dostepPoZalogowaniu = true;
require_once 'inc/naglowek.inc.php';
require_once "inc/connect.inc.php";

            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if($polaczenie->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }

$id=isset($_GET['id']) && $_GET['id'] ? (int)$_GET['id'] : null;



    if(!empty($_POST))
    {
        // udana walidaja
        $OK=true;
        $dane = $_POST;
        foreach ($dane as $key => $value) {
            $dane[$key] = trim($value);// usuwamy spacje z początku i końca wartości pól formularza
        }

        ///Marka
        //$Marka=$_POST['Marka'];
        if((strlen($dane['Marka'])<3)||(strlen($dane['Marka'])>20))
        {
            $OK=false;
            $_SESSION['e_marka']='Marka musi posiadać od 3 do 20 znaków';       
        }
        if(!preg_match("/^([a-zA-Z]+)$/",$dane['Marka']))
        {
            $OK=false;
            $_SESSION['e_marka']="Nazwa marki zawiera nieprawidłowe znaki";
        }

        ///Model
        //$Model=$_POST['Model'];
        if((strlen($dane['Model'])<3)||(strlen($dane['Model'])>30))
        {
            $OK=false;
            $_SESSION['e_model']=' Model musi posiadać od 3 do 30 znaków';       
        }
        if(preg_match("/[^A-z0-9]/",$dane['Model']))
        {
            $OK=false;
            $_SESSION['e_model']="Model nie może zawierać znaków specjalnych";
        }
        
        ///Rocznik
        //$Rocznik=$_POST['Rocznik'];
        if (!preg_match('/^[0-9]{4}$/',$dane['Rocznik']))
        {  
            $OK=false;
            $_SESSION['e_rocznik']="Rocznik może zawierać same cyfry  ";
        }
        ///Pojemność Silnika
        //$Poj_silnika=$_POST['Poj_silnika'];
        if (!preg_match('/^[0-9]{4}$/',$dane['Poj_silnika']))
        {  
            $OK=false;
            $_SESSION['e_poj_silnika']="Pojemność Silnika może zawierać same cyfry  ";
        }

   
        //$VIN=$_POST['VIN'];
        if(!preg_match("/[^A-z][0-9]/",$dane['VIN']))
        {
            $OK=false;
            $_SESSION['e_vin']="VIN może zawierac litery, cyfry";
        }

        
        ///Pojemność Silnika
       // $Moc_silnika=$_POST['Moc_silnika'];
        if (preg_match('/^[0-9]{4}$/',$dane['Moc_silnika']))
        {  
            $OK=false;
            $_SESSION['e_moc_silnika']="Moc Silnika może zawierać same cyfry  ";
        }

     
        
        //require_once "connect.php";
        
        try
        {

                
                if($OK==true)
                {
                    if($polaczenie->query("UPDATE pojazd SET MARKA = '{$dane['Marka']}', MODEL = '{$dane['Model']}',Rocznik = '{$dane['Rocznik']}',Poj_silnika = '{$dane['Poj_silnika']}',VIN = '{$dane['VIN']}',Moc_silnika = '{$dane['Moc_silnika']}' WHERE id_Poj = {$id}"))
                    {
                      $_SESSION['udana rejestracja']=true;
                      header("Location:edycjapojazdua.php?id={$id}&result=true");
                    }
                    ELSE
                    {
                       throw new Exception($polaczenie->error); 
                    }
                        
                        
                }

                $polaczenie->close();
        }
        catch (Exception $e)
        {
            echo '<span style="color:red"> Błąd serwera!</span>';
            echo '<br> Informacja dew'.$e->getMessage();
        }
    } else {
        // Jeżeli dane z $_POST są puste (user nie kliknął zapisz) to pobieramy dane z bazy, w celu wypełnienia forularza
        
              
        $result = $polaczenie->query('SELECT * FROM pojazd WHERE id_Poj = ' . $id);
        $dane = $result->fetch_assoc();
        //} else {
        //    throw new Exception('Wystąpił błąd podczas pobierania danych lub nieprawidłowe ID');
        //}
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

  
        
<?php if (isset($_GET['result']) && $_GET['result']) : ?>
        <div class="alert alert-success">
            Dane zostały pomyślnie zapisane.
        </div>
<?php endif; ?>        
<?php if (isset($OK) && !$OK) : ?>
        <div class="alert alert-danger">
            Popraw dane oznaczone na czerwono
        </div>
<?php endif; ?>  
<form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $id; ?>" method="POST" >
<b>Marka:</b><br> <input type="text" name="Marka" value="<?php echo $dane['Marka'] ?>"><br>
<?php 
if (isset($_SESSION['e_marka']))
{
    echo '<div class="error">'.$_SESSION['e_marka'].'</div>';
    unset($_SESSION['e_marka']);
}
?>
<b>Model:</b><br> <input type="text" name="Model" value="<?php echo $dane['Model'] ?>"><br>
<?php 
if (isset($_SESSION['e_model']))
{
    echo '<div class="error">'.$_SESSION['e_model'].'</div>';
    unset($_SESSION['e_model']);
}
?>
<b>Rocznik</b><br> <input type="text"  name="Rocznik" maxlength="4" value="<?php echo $dane['Rocznik'] ?>"><br>
<?php 
if (isset($_SESSION['e_rocznik']))
{
    echo '<div class="error">'.$_SESSION['e_rocznik'].'</div>';
    unset($_SESSION['e_rocznik']);
}
?>
<b>Pojemność silnika cm3:</b><br> <input type="text" name="Poj_silnika" maxlength="4" value="<?php echo $dane['Poj_silnika'] ?>"><br>
<?php 
if (isset($_SESSION['e_poj_silnika']))
{
    echo '<div class="error">'.$_SESSION['e_poj_silnika'].'</div>';
    unset($_SESSION['e_poj_silnika']);
}
?>
<b>VIN:</b><br> <input type="text" name="VIN" maxlength="17" value="<?php echo $dane['VIN'] ?>"><br>
<?php 
if (isset($_SESSION['e_vin']))
{
    echo '<div class="error">'.$_SESSION['e_vin'].'</div>';
    unset($_SESSION['e_vin']);
}
?>
<b>Moc silnika:</b><br> <input type="text" name="Moc_silnika" maxlength="4" value="<?php echo $dane['Moc_silnika'] ?>"><br>
<?php 
if (isset($_SESSION['e_moc_silnika']))
{
    echo '<div class="error">'.$_SESSION['e_moc_silnika'].'</div>';
    unset($_SESSION['e_moc_silnika']);
}
?>
<input type="submit" value="Aktualizuj dane" name="Dodaj">
</form>



    </body>
</html>