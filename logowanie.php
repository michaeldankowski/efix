<?php


if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {

    header('Location: panel.php');
    exit();
}
define('PARENT', true);

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

        <a href="/rejestracja.php">Zarejestruj się </a><br><br>


        <form action="zaloguj.php" method="post">
            Login:<br><input type="text" name="login"/> <br><br>
            Hasło:<br><input type="password" name="haslo"/> <br><br>
            <input type="submit" value="zaloguj się"/>


        </form>

<?php
if (isset($_SESSION['blad'])) {
    echo $_SESSION['blad'];
    unset($_SESSION['blad']);
}
?>
    </body>
</html>