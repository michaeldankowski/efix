<?php
    define('PARENT', true);
$dostepPoZalogowaniu = true;
require_once 'inc/naglowek.inc.php';
require_once "inc/connect.inc.php";
    if(isset($_POST['Email']))
    {
        // udana walidaja
        $OK=true;

        ///Imie
        $Imie=$_POST['Imie'];
        if((strlen($Imie)<3)||(strlen($Imie)>20))
        {
            $OK=false;
            $_SESSION['e_imie']='Imię musi posiadać od 3 do 20 znaków';       
        }
        if(preg_match("/[^A-zĄąĆćĘęŁłŃńÓóŚśŹźŻż]/",$Imie))
        {
            $OK=false;
            $_SESSION['e_imie']="Imię nie może zawierać cyfr";
        }

        ///Nazwisko
        $Nazwisko=$_POST['Nazwisko'];
        if((strlen($Nazwisko)<3)||(strlen($Nazwisko)>30))
        {
            $OK=false;
            $_SESSION['e_nazwisko']='Nazwisko musi posiadać od 3 do 30 znaków';       
        }
        if(preg_match("/[^A-zĄąĆćĘęŁłŃńÓóŚśŹźŻż-]/",$Nazwisko))
        {
            $OK=false;
            $_SESSION['e_nazwisko']="Nazwisko nie może zawierać cyfr";
        }
        ///Pesel
        $Pesel=$_POST['Pesel'];
        if (!preg_match('/^[0-9]{11}$/',$Pesel))
        {  
            $OK=false;
            $_SESSION['e_pesel']="Pesel może zawierać same cyfry oraz 11 znaków";
        }
        ///telefon
        $Telefon=$_POST['Telefon'];
        if (!preg_match('/^[0-9]{9}$/',$Telefon))
        {  
            $OK=false;
            $_SESSION['e_telefon']="Telefon może zawierać same cyfry oraz 9 znaków";
        }

        $Adres=$_POST['Adres'];
        $Email=$_POST['Email'];
        $EmailB=filter_var($Email, FILTER_SANITIZE_EMAIL);
        if ((filter_var($EmailB,FILTER_VALIDATE_EMAIL)==false)||($EmailB!=$Email))
        {  
            $OK=false;
            $_SESSION['e_email']="Podaj poprawny adres email";
        }

        
        ///login
        $Login=$_POST['Login'];
        if((strlen($Login)<3)||(strlen($Login)>20))
        {
            $OK=false;
            $_SESSION['e_login']='Login musi posiadać od 3 do 20 znaków';       
        }
        if(preg_match("/[^A-z].[0-9]/",$Imie))
        {
            $OK=false;
            $_SESSION['e_imie']="Login może zawierac litery, cyfry, i kropki";
        }

        $Haslo=$_POST['Haslo'];
        $Haslo2=$_POST['Haslo2'];
         if((strlen($Haslo)<8)||(strlen($Haslo)>20))
        {
            $OK=false;
            $_SESSION['e_haslo']='Hasło musi mieć od 8 o 20 znaków';       
        }

        if($Haslo!=$Haslo2)
        {
           $OK=false;
           $_SESSION['e_haslo']='Podane hasła nie są identyczne';    
        }
        
        //regulamin
        if (!isset($_POST['regulamin']))
        {
           $OK=false;
           $_SESSION['e_regulamin']='Regulamin nie został zakceptowany';    
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
                //sprawdzanie email
                $rezultat = $polaczenie->query("Select id_KliPrac From kli_prac where Email='$Email'");
                
                if(!$rezultat) throw new Exception ($polaczenie->error);
                $ile_takich_maili = $rezultat->num_rows;
                if($ile_takich_maili>0)
                {
                    $OK=false;
                    $_SESSION['e_email']='istnieje już konto o podanym email';                     
                }
                
                //sprawdzanie loginu
                $rezultat = $polaczenie->query("Select id_KliPrac From kli_prac where Login='$Login'");
                
                if(!$rezultat) throw new Exception ($polaczenie->error);
                $ile_takich_nickow = $rezultat->num_rows;
                if($ile_takich_nickow>0)
                {
                    $OK=false;
                    $_SESSION['e_login']='istnieje już konto o podanym loginie';                     
                }
                
                if($OK==true)
                {
                    if($polaczenie->query("Insert into kli_prac values(NULL,'$Imie','$Nazwisko','$Pesel','$Telefon','$Adres','$Email','$Login','$Haslo','2')"))
                    {
                      $_SESSION['udana rejestracja']=true;
                      header('Location:witamy.php');
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
        <title>Rejestracja</title>   
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        
        <style>
            .error{
                color:red;
                margin:10px;
            }
            
        </style>
    </head>
    <body>
        
        
        

<form method="POST" >
<b>Imię:</b><br> <input type="text" name="Imie"><br>
<?php 
if (isset($_SESSION['e_imie']))
{
    echo '<div class="error">'.$_SESSION['e_imie'].'</div>';
    unset($_SESSION['e_imie']);
}
?>
<b>Nazwisko:</b><br> <input type="text" name="Nazwisko"><br>
<?php 
if (isset($_SESSION['e_nazwisko']))
{
    echo '<div class="error">'.$_SESSION['e_nazwisko'].'</div>';
    unset($_SESSION['e_nazwisko']);
}
?>
<b>Pesel</b><br> <input type="text"  name="Pesel" maxlength="11" ><br>
<?php 
if (isset($_SESSION['e_pesel']))
{
    echo '<div class="error">'.$_SESSION['e_pesel'].'</div>';
    unset($_SESSION['e_pesel']);
}
?>
<b>Telefon:</b><br> <input type="text" name="Telefon" maxlength="9"><br>
<?php 
if (isset($_SESSION['e_telefon']))
{
    echo '<div class="error">'.$_SESSION['e_telefon'].'</div>';
    unset($_SESSION['e_telefon']);
}
?>
<b>Adres:</b><br> <input type="text" name="Adres"><br>
<b>Email:</b><br> <input type="text" name="Email"><br>
<?php 
if (isset($_SESSION['e_email']))
{
    echo '<div class="error">'.$_SESSION['e_email'].'</div>';
    unset($_SESSION['e_email']);
}
?>
<b>Login</b><br> <input type="text" name="Login"><br>
<?php 
if (isset($_SESSION['e_login']))
{
    echo '<div class="error">'.$_SESSION['e_login'].'</div>';
    unset($_SESSION['e_login']);
}
?>
<b>Hasło:</b><br> <input type="password" name="Haslo"><br>
<?php 
if (isset($_SESSION['e_haslo']))
{
    echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
    unset($_SESSION['e_haslo']);
}
?>
<b>Powtórz hasło:</b><br> <input type="password" name="Haslo2"><br>
<label>
<input type="checkbox" name="regulamin"/>akceptacja regulaminu<br>
</label>
<?php 
if (isset($_SESSION['e_regulamin']))
{
    echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
    unset($_SESSION['e_regulamin']);
}
?>
<input type="submit" value="Utwórz konto" name="rejestruj">
</form>



    </body>
</html>