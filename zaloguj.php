<?php

session_start();
require_once 'connect.php';

if ((!isset($_POST['login'])) || (!isset($_POST['haslo']))) {
    header('location:logowanie.php');
    exit();
}


$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo"Error: " . $polaczenie->connect_errno;
} else {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

    $sql = " SELECT * FROM kli_prac WHERE Login='$login' AND Haslo='$haslo'";

    if ($rezultat = @$polaczenie->query(sprintf("SELECT * FROM kli_prac WHERE Login='%s' AND Haslo='%s'", mysqli_real_escape_string($polaczenie, $login), mysqli_real_escape_string($polaczenie, $login)
            ))) {
        $ilu_userow = $rezultat->num_rows;
        if ($ilu_userow > 0) {
            $_SESSION['zalogowany'] = true;

            $wiersz = $rezultat->fetch_assoc();
            $_SESSION['ID'] = $wiersz['id_KliPrac'];
            $_SESSION['user'] = $wiersz['Login'];
            $_SESSION['Imie'] = $wiersz['Imie'];
            $_SESSION['Nazwisko'] = $wiersz['Nazwisko'];
            $_SESSION['Pesel'] = $wiersz['Pesel'];
            $_SESSION['Telefon'] = $wiersz['Telefon'];
            $_SESSION['Adres'] = $wiersz['Adres'];
            $_SESSION['Email'] = $wiersz['Email'];

            unset($_SESSION['blad']);
            $rezultat->free_result();
            header('Location: panel.php');
        } else {
            $_SESSION['blad'] = '<span style="color:red"> Nieprawidłowy login lub hasło </span>';
            header('location:logowanie.php');
        }
    }


    $polaczenie->close();
}
?>