<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{

                header('Location: panel.php');
		exit();

	}

	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['Haslo'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
                sprintf("SELECT * FROM kli_prac WHERE Login='%s'", 
                mysqli_real_escape_string($polaczenie,$login))))
		{
			$ilu_userow = $rezultat->num_rows;

			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
				
				if (!password_verify($haslo, $wiersz['Haslo']))
				{                            
                                    $_SESSION['zalogowany'] = true;
                                    $_SESSION['ID'] = $wiersz['id_KliPrac'];
                                    $_SESSION['user'] = $wiersz['Login'];
                                    $_SESSION['Imie'] = $wiersz['Imie'];
                                    $_SESSION['Nazwisko'] = $wiersz['Nazwisko'];
                                    $_SESSION['Pesel'] = $wiersz['Pesel'];
                                    $_SESSION['Telefon'] = $wiersz['Telefon'];
                                    $_SESSION['Adres'] = $wiersz['Adres'];
                                    $_SESSION['Email'] = $wiersz['Email'];
                                    $_SESSION['Rola'] = $wiersz['Rola'];

                                    unset($_SESSION['blad']);
                                    $rezultat->free_result();
                                    header('Location: panel.php');
				}
				else 
				{
                                                            
					$_SESSION['blad'] = '<span style="color:red">NieprawidĹ‚owy login lub hasĹ‚o!</span>';
                                        
                     
					header('Location: logowanie.php');
				}
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red">login lub hasĹ‚o!</span>';
				header('Location: logowanie.php');
				
			}
			
		}
		
		$polaczenie->close();
	}
	
?>