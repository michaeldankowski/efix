<?php
/*
session_start();

if(!isset($_SESSION['zalogowany']))
{
    header('location:logowanie.php');
    exit();
    
}
	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);


*/
define('PARENT', true);
$dostepPoZalogowaniu = true;
require_once 'inc/naglowek.inc.php';
require_once "connect.php";
?>

<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <title>Panel</title> 
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/php.css">            
    </head>
    <body>
        <?php        require_once 'inc/tpl/menu.inc.php'; ?>
        <?php
        echo "<p>Witaj ".$_SESSION['Imie']." ".$_SESSION['Nazwisko']."</p>";
        

        $sql = "SELECT * FROM wizyta_w_warsztacie natural join kli_prac natural join pojazd natural join stanowisko ";

        if($result = mysqli_query($polaczenie, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo '<table class="table">';
            echo "<tr>";
                echo "<th>Imię</th>";
                echo "<th>Nazwisko</th>";
                echo "<th>Marka</th>";
                echo "<th>Model</th>";
                echo "<th>Opis Stanowiska</th>";
                echo "<th>Data wizyty</th>";
                echo "<th>Godzina wizyty</th>";
                echo "<th>Opis czynnośći</th>";
                echo "<th>Kwota [zł]</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['Imie'] . "</td>";
                echo "<td>" . $row['Nazwisko'] . "</td>";
                echo "<td>" . $row['Marka'] . "</td>";
                echo "<td>" . $row['Model'] . "</td>";
                echo "<td>" . $row['Opis_stanowiska'] . "</td>";
                echo "<td>" . $row['Data_wizyty'] . "</td>";
                echo "<td>" . $row['Godzina_wizyty'] . "</td>";
                echo "<td>" . $row['Opis_wizyty'] . "</td>";
                echo "<td>" . $row['Kwota'] . "</td>";
                
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($polaczenie);
}
 
// Close connection
mysqli_close($polaczenie);
        ?>
        
    </body>
</html>