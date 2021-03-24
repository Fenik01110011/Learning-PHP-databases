<?php
	session_start();
	
	if ((!isset($_GET['id'])) || (!isset($_GET['tabela'])))
	{
		header('Location: index.php');
		exit();
	}
	
	$tabela = $_GET['tabela'];
	
	require_once "connect.php";

	// sprawdzamy, czy ta zmienna id ma jak±s wartość czy nie
	if (isset($_POST['id']))
	{
		$id = $_POST['id'];
		
		if ($tabela == "przybysze")
		{
			$rasa = $_POST['rasa'];
			$id_planety_pochodzenia = $_POST['id_planety_pochodzenia'];
			$kod_identyfikacyjny = $_POST['kod_identyfikacyjny'];
			$plec = $_POST['plec'];
			$wiek = $_POST['wiek'];
			$imie_nazwisko_nazwa = $_POST['imie_nazwisko_nazwa'];
			$id_statku = $_POST['id_statku'];
			$cel_pobytu = $_POST['cel_pobytu'];
	
			$zapytanie = "UPDATE `przybysze` SET `rasa` = '".$rasa."', `id_planety_pochodzenia` = '".$id_planety_pochodzenia."', `kod_identyfikacyjny` = '".$kod_identyfikacyjny."', `plec` = '".$plec."', `wiek` = '".$wiek."', `imie_nazwisko_nazwa` = '".$imie_nazwisko_nazwa."', `id_statku` = '".$id_statku."', `cel_pobytu` = '".$cel_pobytu."' WHERE `przybysze`.`id` = ".$id.";";
		}
		else if ($tabela == "statki_kosmiczne")
		{
			$model = $_POST['model'];
			$nazwa = $_POST['nazwa'];
			$predkosc_maksymalna = $_POST['predkosc_maksymalna'];
			$liczebnosc_zalogi = $_POST['liczebnosc_zalogi'];
			$udzwig = $_POST['udzwig'];
			$rok_produkcji = $_POST['rok_produkcji'];
			$id_kapitana_statku = $_POST['id_kapitana_statku'];
			
			$zapytanie = "UPDATE `statki_kosmiczne` SET `model` = '".$model."', `nazwa` = '".$nazwa."', `predkosc_maksymalna` = '".$predkosc_maksymalna."', `liczebnosc_zalogi` = '".$liczebnosc_zalogi."', `udzwig` = '".$udzwig."', `rok_produkcji` = '".$rok_produkcji."', `id_kapitana_statku` = '".$id_kapitana_statku."' WHERE `statki_kosmiczne`.`id` = ".$id.";";
		}
		else if ($tabela == "planety")
		{
			$nazwa = $_POST['nazwa'];
			$srednica = $_POST['srednica'];
			$populacja = $_POST['populacja'];
			$glowne_rasy = $_POST['glowne_rasy'];
			$dodatkowe_informacje = $_POST['dodatkowe_informacje'];
			
			$zapytanie = "UPDATE `planety` SET `nazwa` = '".$nazwa."', `srednica` = '".$srednica."', `populacja` = '".$populacja."', `glowne_rasy` = '".$glowne_rasy."', `dodatkowe_informacje` = '".$dodatkowe_informacje."' WHERE `planety`.`id` = ".$id.";";
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
				$_SESSION['message'] = "Zmodyfikowano  1 rekord.";
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
<?php
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		$_SESSION['message'] = "Error: ".$polaczenie->connect_errno;
	}
	else
	{	
		if ($rezultat = @$polaczenie->query("SELECT * FROM ".$_GET['tabela']." WHERE id='".$_GET['id']."'"))
		{
			$wiersz = $rezultat->fetch_assoc();

?>
			<form action="" method="POST">
				<input type="hidden" name="id" value="<?php echo $wiersz['id'];?>">
<?php
			if ($tabela == "przybysze")
			{
?>
				<table>
					<tr> 
						<td colspan="2"><b><font size="2"><h2>Zmiana danych przybysza</h2></font></b></td> 
					</tr>
					<tr>
						<td>Rasa:</td>
						<td><input type="text" name="rasa" value="<?php echo $wiersz['rasa']; ?>"></td>
					</tr>
					<tr>
						<td>Id planety pochodzenia:</td>
						<td><input type="text" name="id_planety_pochodzenia" value="<?php echo $wiersz['id_planety_pochodzenia']; ?>"></td>
					</tr>
					<tr>
						<td>Kod identyfikacyjny:</td>
						<td><input type="text" name="kod_identyfikacyjny" value="<?php echo $wiersz['kod_identyfikacyjny']; ?>"></td>
					</tr>
					<tr>
						<td>Płeć:</td>
						<td><input type="text" name="plec" value="<?php echo $wiersz['plec']; ?>"></td>
					</tr>
					<tr>
						<td>Wiek:</td>
						<td><input type="text" name="wiek" value="<?php echo $wiersz['wiek']; ?>"></td>
					</tr>
					<tr>
						<td>Imie i nazwisko / nazwa:</td>
						<td><input type="text" name="imie_nazwisko_nazwa" value="<?php echo $wiersz['imie_nazwisko_nazwa']; ?>"></td>
					</tr>
					<tr>
						<td>Id statku:</td>
						<td><input type="text" name="id_statku" value="<?php echo $wiersz['id_statku']; ?>"></td>
					</tr>
					<tr>
						<td>Cel pobytu:</td>
						<td><input type="text" name="cel_pobytu" value="<?php echo $wiersz['cel_pobytu']; ?>"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="Zapisz"></td>
					</tr>
				</table>
<?php
			}
			else if ($tabela == "statki_kosmiczne")
			{
?>
				<table>
					<tr> 
						<td colspan="2"><b><font size="2"><h2>Zmiana danych statku kosmicznego</h2></font></b></td> 
					</tr>
					<tr>
						<td>Model:</td>
						<td><input type="text" name="model" value="<?php echo $wiersz['model']; ?>"></td>
					</tr>
					<tr>
						<td>Nazwa:</td>
						<td><input type="text" name="nazwa" value="<?php echo $wiersz['nazwa']; ?>"></td>
					</tr>
					<tr>
						<td>Prędkość maksymalna (m/s):</td>
						<td><input type="text" name="predkosc_maksymalna" value="<?php echo $wiersz['predkosc_maksymalna']; ?>"></td>
					</tr>
					<tr>
						<td>Liczebność załogi:</td>
						<td><input type="text" name="liczebnosc_zalogi" value="<?php echo $wiersz['liczebnosc_zalogi']; ?>"></td>
					</tr>
					<tr>
						<td>Udźwig (kg):</td>
						<td><input type="text" name="udzwig" value="<?php echo $wiersz['udzwig']; ?>"></td>
					</tr>
					<tr>
						<td>Rok produkcji:</td>
						<td><input type="text" name="rok_produkcji" value="<?php echo $wiersz['rok_produkcji']; ?>"></td>
					</tr>
					<tr>
						<td>Id kapitana statku:</td>
						<td><input type="text" name="id_kapitana_statku" value="<?php echo $wiersz['id_kapitana_statku']; ?>"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="Zapisz"></td>
					</tr>
				</table>
<?php	
			}
			else if ($tabela == "planety")
			{
?>
				<table>
					<tr> 
						<td colspan="2"><b><font size="2"><h2>Zmiana danych planety</h2></font></b></td> 
					</tr>
					<tr>
						<td>Nazwa:</td>
						<td><input type="text" name="nazwa" value="<?php echo $wiersz['nazwa']; ?>"></td>
					</tr>
					<tr>
						<td>Średnica (km):</td>
						<td><input type="text" name="srednica" value="<?php echo $wiersz['srednica']; ?>"></td>
					</tr>
					<tr>
						<td>Populacja:</td>
						<td><input type="text" name="populacja" value="<?php echo $wiersz['populacja']; ?>"></td>
					</tr>
					<tr>
						<td>Główne rasy:</td>
						<td><input type="text" name="glowne_rasy" value="<?php echo $wiersz['glowne_rasy']; ?>"></td>
					</tr>
					<tr>
						<td>Dodatkowe informacje:</td>
						<td><input type="text" name="dodatkowe_informacje" value="<?php echo $wiersz['dodatkowe_informacje']; ?>"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="Zapisz"></td>
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
<?php
			$rezultat->free_result();
		}
		
		$polaczenie->close();
	}
?>
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