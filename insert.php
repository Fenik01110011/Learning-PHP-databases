<?php
	session_start();
	
	if (!isset($_GET['tabela']))
	{
		header('Location: index.php');
		exit();
	}
	
	$tabela = $_GET['tabela'];
	
	require_once "connect.php";

	// sprawdzamy, czy ta zmienna id ma jak±s wartość czy nie
	if (isset($_POST['rasa']) || isset($_POST['model']) || isset($_POST['nazwa']))
	{	
		if ($tabela == "przybysze" && isset($_POST['rasa']))
		{
			$rasa = $_POST['rasa'];
			$id_planety_pochodzenia = $_POST['id_planety_pochodzenia'];
			$kod_identyfikacyjny = $_POST['kod_identyfikacyjny'];
			$plec = $_POST['plec'];
			$wiek = $_POST['wiek'];
			$imie_nazwisko_nazwa = $_POST['imie_nazwisko_nazwa'];
			$id_statku = $_POST['id_statku'];
			$cel_pobytu = $_POST['cel_pobytu'];
	
			$zapytanie = "INSERT INTO `przybysze` (`id`, `rasa`, `id_planety_pochodzenia`, `kod_identyfikacyjny`, `plec`, `wiek`, `imie_nazwisko_nazwa`, `id_statku`, `cel_pobytu`) VALUES (NULL, '".$rasa."', '".$id_planety_pochodzenia."', '".$kod_identyfikacyjny."', '".$plec."', '".$wiek."', '".$imie_nazwisko_nazwa."', '".$id_statku."', '".$cel_pobytu."');";
		}
		else if ($tabela == "statki_kosmiczne" && isset($_POST['model']))
		{
			$model = $_POST['model'];
			$nazwa = $_POST['nazwa'];
			$predkosc_maksymalna = $_POST['predkosc_maksymalna'];
			$liczebnosc_zalogi = $_POST['liczebnosc_zalogi'];
			$udzwig = $_POST['udzwig'];
			$rok_produkcji = $_POST['rok_produkcji'];
			$id_kapitana_statku = $_POST['id_kapitana_statku'];
			
			$zapytanie = "INSERT INTO `statki_kosmiczne` (`id`, `model`, `nazwa`, `predkosc_maksymalna`, `liczebnosc_zalogi`, `udzwig`, `rok_produkcji`, `id_kapitana_statku`) VALUES (NULL, '".$model."', '".$nazwa."', '".$predkosc_maksymalna."', '".$liczebnosc_zalogi."', '".$udzwig."', '".$rok_produkcji."', '".$id_kapitana_statku."');";
		}
		else if ($tabela == "planety" && isset($_POST['srednica']))
		{
			$nazwa = $_POST['nazwa'];
			$srednica = $_POST['srednica'];
			$populacja = $_POST['populacja'];
			$glowne_rasy = $_POST['glowne_rasy'];
			$dodatkowe_informacje = $_POST['dodatkowe_informacje'];
			
			$zapytanie = "INSERT INTO `planety` (`id`, `nazwa`, `srednica`, `populacja`, `glowne_rasy`, `dodatkowe_informacje`) VALUES (NULL, '".$nazwa."', '".$srednica."', '".$populacja."', '".$glowne_rasy."', '".$dodatkowe_informacje."');";
		}
		else
		{
			$_SESSION['message'] = "Error. Nieprawidłowa nazwa tabeli.";
			header('Location: index.php');
			exit();
		}
		
		$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
		if ($polaczenie->connect_errno!=0)
		{
			$_SESSION['message'] = "Error: ".$polaczenie->connect_errno;
		}
		else
		{
			if (@$polaczenie->query($zapytanie)) 
				$_SESSION['message'] = "Dodano 1 rekord do tabeli ".$tabela.".";
			else
				$_SESSION['message'] = "Error";
				
			$polaczenie->close();
		}
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Dodawanie rekordów</title>
	
	<meta name="description" content="Super strona internetowa"/>
	<meta name="keywords" content="super, strona, internetowa, mega, interfejs, PHP" />
	<meta name="author" content="Marcin Bialecki">
	
	
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="container">
	<form action="" method="POST">
<?php
		if ($tabela == "przybysze")
		{
?>
			<table>
				<tr> 
					<td colspan="2"><b><font size="2"><h2>Dodawanie przybysza</h2></font></b></td> 
				</tr>
				<tr>
					<td>Rasa:</td>
					<td><input type="text" name="rasa" required></td>
				</tr>
				<tr>
					<td>Id planety pochodzenia:</td>
					<td><input type="text" name="id_planety_pochodzenia"></td>
				</tr>
				<tr>
					<td>Kod identyfikacyjny:</td>
					<td><input type="text" name="kod_identyfikacyjny"></td>
				</tr>
				<tr>
					<td>Płeć:</td>
					<td><input type="text" name="plec"></td>
				</tr>
							<tr>
					<td>Wiek:</td>
					<td><input type="text" name="wiek"></td>
				</tr>
				<tr>
					<td>Imie i nazwisko / nazwa:</td>
					<td><input type="text" name="imie_nazwisko_nazwa"></td>
				</tr>
				<tr>
					<td>Id statku:</td>
					<td><input type="text" name="id_statku"></td>
				</tr>
				<tr>
					<td>Cel pobytu:</td>
					<td><input type="text" name="cel_pobytu"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Dodaj"></td>
				</tr>
			</table>
<?php
		}
		else if ($tabela == "statki_kosmiczne")
		{
?>
			<table>
				<tr> 
					<td colspan="2"><b><font size="2"><h2>Dodawanie statku kosmicznego</h2></font></b></td> 
				</tr>
				<tr>
					<td>Model:</td>
					<td><input type="text" name="model" required></td>
				</tr>
				<tr>
					<td>Nazwa:</td>
					<td><input type="text" name="nazwa"></td>
				</tr>
				<tr>
					<td>Prędkość maksymalna (m/s):</td>
					<td><input type="text" name="predkosc_maksymalna"></td>
				</tr>
				<tr>
					<td>Liczebność załogi:</td>
					<td><input type="text" name="liczebnosc_zalogi"></td>
				</tr>
				<tr>
					<td>Udźwig (kg):</td>
					<td><input type="text" name="udzwig"></td>
				</tr>
				<tr>
					<td>Rok produkcji:</td>
					<td><input type="text" name="rok_produkcji"></td>
				</tr>
				<tr>
					<td>Id kapitana statku:</td>
					<td><input type="text" name="id_kapitana_statku"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Dodaj"></td>
				</tr>
			</table>
<?php	
		}
		else if ($tabela == "planety")
		{
?>
			<table class="t11">
				<tr> 
					<td colspan="2"><b><font size="2"><h2>Dodawanie planety</h2></font></b></td> 
				</tr>
				<tr>
					<td>Nazwa:</td>
					<td><input type="text" name="nazwa" required></td>
				</tr>
				<tr>
					<td>Średnica (km):</td>
					<td><input type="text" name="srednica"></td>
				</tr>
				<tr>
					<td>Populacja:</td>
					<td><input type="text" name="populacja"></td>
				</tr>
				<tr>
					<td>Główne rasy:</td>
					<td><input type="text" name="glowne_rasy"></td>
				</tr>
				<tr>
					<td>Dodatkowe informacje:</td>
					<td><input type="text" name="dodatkowe_informacje"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Dodaj"></td>
				</tr>
			</table>
<?php	
		}
		else
		{
			$_SESSION['message'] = "Error. Nieprawidłowa nazwa tabeli.";
			$polaczenie->close();
			header('Location: index.php');
			exit();
		}
?>
	</form>
	<br>
	<a href="index.php">Przeglądaj</a>
	<br>
<?php
	if (isset($_SESSION['message']))
	{		
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
?>
</div>
</body>
</html>