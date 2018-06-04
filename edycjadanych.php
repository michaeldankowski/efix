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

        ///Imie
       // $Imie=$_POST['Imie'];
        if((strlen($dane['Imie'])<3)||(strlen($dane['Imie'])>20))
        {
            $OK=false;
            $_SESSION['e_imie']='Imię musi posiadać od 3 do 20 znaków';       
        }
        if(preg_match("/[^A-zĄąĆćĘęŁłŃńÓóŚśŹźŻż]/",$dane['Imie']))
        {
            $OK=false;
            $_SESSION['e_imie']="Imię nie może zawierać cyfr";
        }

        ///Nazwisko
        //$Nazwisko=$_POST['Nazwisko'];
        if((strlen($dane['Nazwisko'])<3)||(strlen($dane['Nazwisko'])>30))
        {
            $OK=false;
            $_SESSION['e_nazwisko']='Nazwisko musi posiadać od 3 do 30 znaków';       
        }
        if(preg_match("/[^A-zĄąĆćĘęŁłŃńÓóŚśŹźŻż-]/",$dane['Nazwisko']))
        {
            $OK=false;
            $_SESSION['e_nazwisko']="Nazwisko nie może zawierać cyfr";
        }
        ///Pesel
        //$Pesel=$_POST['Pesel'];
        if((strlen($dane['Pesel'])!=11))
        {
            $OK=false;
            $_SESSION['e_pesel']='Pesel musi zawierać 11 znaków';       
        }
        if (!preg_match('/^[0-9]{11}$/',$dane['Pesel']))
        {  
            $OK=false;
            $_SESSION['e_pesel']="Pesel może zawierać same cyfry";
        }
        ///telefon
        //$Telefon=$_POST['Telefon'];
        if (!preg_match('/^[0-9]{9}$/',$dane['Telefon']))
        {  
            $OK=false;
            $_SESSION['e_telefon']="Telefon może zawierać same cyfry oraz 9 znaków";
        }

        //$Adres=$_POST['Adres'];
        $Email=$_POST['Email'];
        $EmailB=filter_var($Email, FILTER_SANITIZE_EMAIL);
        if ((filter_var($EmailB,FILTER_VALIDATE_EMAIL)==false)||($EmailB!=$Email))
        {  
            $OK=false;
            $_SESSION['e_email']="Podaj poprawny adres email";
        }


        //$Haslo=$_POST['Haslo'];
        $Haslo2=$_POST['Haslo2'];
         if((strlen($dane['Haslo'])<8)||(strlen($dane['Haslo'])>20))
        {
            $OK=false;
            $_SESSION['e_haslo']='Hasło musi mieć od 8 o 20 znaków';       
        }

        if($dane['Haslo']!=$Haslo2)
        {
           $OK=false;
           $_SESSION['e_haslo']='Podane hasła nie są identyczne';    
        }
        
      
        mysqli_report(MYSQLI_REPORT_STRICT);
        try
        {
                
               
                
                if($OK==true)
                {
                    if($polaczenie->query("Update kli_prac Set Imie = '{$dane['Imie']}',Nazwisko = '{$dane['Nazwisko']}',Pesel = '{$dane['Pesel']}',Telefon = '{$dane['Telefon']}',EMAIL = '{$Email}',Haslo = '{$dane['Haslo']}' where id_KliPrac = {$id}"))
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
        
        catch (Exception $e)
        {
            echo '<span style="color:red"> Błąd serwera!</span>';
            echo '<br> Informacja dew'.$e;
        }
    }    else {
        // Jeżeli dane z $_POST są puste (user nie kliknął zapisz) to pobieramy dane z bazy, w celu wypełnienia forularza
        
              
        $result = $polaczenie->query('SELECT * FROM kli_prac WHERE id_KliPrac = ' . $id);
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
        <title>Rejestracja</title>   
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
<b>Imię:</b><br> <input type="text" name="Imie" value="<?php echo $dane['Imie'] ?>"><br>
<?php 
if (isset($_SESSION['e_imie']))
{
    echo '<div class="error">'.$_SESSION['e_imie'].'</div>';
    unset($_SESSION['e_imie']);
}
?>
<b>Nazwisko:</b><br> <input type="text" name="Nazwisko" value="<?php echo $dane['Nazwisko'] ?>"><br>
<?php 
if (isset($_SESSION['e_nazwisko']))
{
    echo '<div class="error">'.$_SESSION['e_nazwisko'].'</div>';
    unset($_SESSION['e_nazwisko']);
}
?>
<b>Pesel</b><br> <input type="text"  name="Pesel" maxlength="11" value="<?php echo $dane['Pesel'] ?>" ><br>
<?php 
if (isset($_SESSION['e_pesel']))
{
    echo '<div class="error">'.$_SESSION['e_pesel'].'</div>';
    unset($_SESSION['e_pesel']);
}
?>
<b>Telefon:</b><br> <input type="text" name="Telefon" maxlength="9" value="<?php echo $dane['Telefon'] ?>"><br>
<?php 
if (isset($_SESSION['e_telefon']))
{
    echo '<div class="error">'.$_SESSION['e_telefon'].'</div>';
    unset($_SESSION['e_telefon']);
}
?>
<b>Adres:</b><br> <input type="text" name="Adres" value="<?php echo $dane['Adres'] ?>"><br>
<b>Email:</b><br> <input type="text" name="Email" value="<?php echo $dane['Email'] ?>"><br>
<?php 
if (isset($_SESSION['e_email']))
{
    echo '<div class="error">'.$_SESSION['e_email'].'</div>';
    unset($_SESSION['e_email']);
}
?>

<b>Hasło:</b><br> <input type="password" name="Haslo" value="<?php echo $dane['Haslo'] ?>"><br>
<?php 
if (isset($_SESSION['e_haslo']))
{
    echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
    unset($_SESSION['e_haslo']);
}
?>
<b>Powtórz hasło:</b><br> <input type="password" name="Haslo2" value="<?php echo $dane['Haslo'] ?>"><br>

<input type="submit" value="Edytuj dane" name="rejestruj">
</form>



    </body>
</html>