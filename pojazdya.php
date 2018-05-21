
<?php
//session_start();
define('PARENT', true);
$dostepPoZalogowaniu = true;
require_once 'inc/naglowek.inc.php';
require_once "inc/connect.inc.php";

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
<?php
require_once('inc/tpl/menu.inc.php'); 
?>
        
        <?php
        $id=$_GET['id'];
        $sql = "SELECT * FROM pojazd where id_KliPrac = '".$id."'";

        if($result = mysqli_query($polaczenie, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table class='table'>";
            echo "<tr>";
                echo "<th>Marka</th>";
                echo "<th>Model</th>";
                echo "<th>Rocznik</th>";
                echo "<th>Pojemność silnika</th>";
                echo "<th>VIN</th>";
                echo "<th>Moc silnika</th>";
                echo "<th>Dodawanie wizyty</th>";
                echo "<th>Edycja Pojazdu</th>";
                echo "<th>Usuwanie Pojazdu</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                $id1=$row['id_Poj'];
                
                echo "<td>" . $row['Marka'] . "</td>";
                echo "<td>" . $row['Model'] . "</td>";
                echo "<td>" . $row['Rocznik'] . "</td>";
                echo "<td>" . $row['Poj_silnika'] . "</td>";
                echo "<td>" . $row['VIN'] . "</td>";
                echo "<td>" . $row['Moc_silnika'] . "</td>";        
                echo '<td><a href="dodawaniewizyty.php?id='.$id.'&id1='.$id1.'">Dodaj wizytę</a></td>';  
                echo '<td><a href="dodawaniewizyty.php?id='.$id.$id1. '">Edytuj Pojazd</a></td>';    
                echo '<td><a href="delete.php?id='.$id. '">Usun</a></td>';     
            echo "</tr>";
        }
        echo "</table>";

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