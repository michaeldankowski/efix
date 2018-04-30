<?php
session_start();
if(isset($_POST['email']))
{
    // udana walidaja
    $OK=true;
    $Imie=$_POST['Imie'];
    if((strlen($Imie)<3)||(strlen($Imie)>20))
    {
        $OK=false;
        $_SESSION['e_imie']='Nick musi posiadać od 3 do 20 znaków';       
    }
    
    
    
    
    
    
    
    if($OK==true)
    {
        
        
        
    }
    
}


?>
<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>Rejestracja</title>   
    </head>
    <body>
        
        
        

<form method="POST" >
<b>Imię:</b><br> <input type="text" name="Imie"><br><br>
<?php 
if (isset($_SESSION['e_imie']))
{
    echo '<div class="error">'.$_SESSION['e_imie'].'</div>';
    unset($_SESSION['ee_nick']);
}
?>
<b>Nazwisko:</b><br> <input type="text" name="Nazwisko"><br><br>
<b>Pesel</b><br> <input type="number" name="Pesel"><br><br>
<b>Telefon:</b><br> <input type="number" name="Telefon"><br><br>
<b>Adres:</b><br> <input type="text" name="Adres"><br><br>
<b>Email:</b><br> <input type="text" name="Email"><br><br>
<b>Login</b><br> <input type="text" name="Login"><br><br>
<b>Hasło:</b><br> <input type="password" name="Haslo"><br><br>
<b>Powtórz hasło:</b><br> <input type="password" name="Haslo2"><br><br>
<label>
<input type="checkbox" name="regulamin"/>akceptacja regulaminu<br><br>
</label>
<input type="submit" value="Utwórz konto" name="rejestruj">
</form>



    </body>
</html>