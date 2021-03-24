<?php
	session_start();
	
	require_once "connect.php";
	
	if (isset($_SESSION['message']))
	{		
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
	
	if (isset($_GET['id']) && isset($_GET['tabela']))
	{
		$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
		if ($polaczenie->connect_errno!=0)
		{
			$_SESSION['message'] = "Error: ".$polaczenie->connect_errno;
		}
		else
		{	
			$zapytanie = "DELETE FROM `".$_GET['tabela']."` WHERE `".$_GET['tabela']."`.`id` = ".$_GET['id'];
		
			if (@$polaczenie->query($zapytanie)) 
				$_SESSION['message'] = "Usunięto rekord o id = ".$_GET['id']." z tabeli '".$_GET['tabela']."'.";
			else
				$_SESSION['message'] = "Error. Nie udało się usunąć rekordu.";
				
			$polaczenie->close();
		}
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Interfejs bazy danych</title>
	
	<meta name="description" content="Super strona internetowa"/>
	<meta name="keywords" content="super, strona, internetowa, mega, interfejs, PHP" />
	<meta name="author" content="Marcin Bialecki">
	
	
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
	<table>
		<tr>
		<td><b>Id</b></td>
		<td><b>Rasa</b></td>
		<td><b>Id planety pochodzenia</b></td>
		<td><b>Kod identyfikacyjny </b></td>
		<td><b>Płeć</b></td>
		<td><b>Wiek</b></td>
		<td><b>Imie i nazwisko / nazwa</b></td>
		<td><b>Id statku</b></td>
		<td><b>Cel pobytu</b></td>
		</tr>

<?php
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		$_SESSION['message'] = "Error: ".$polaczenie->connect_errno;
	}
	else
	{	
		if ($rezultat = @$polaczenie->query("SELECT * FROM przybysze"))
		{
			while ($wiersz = $rezultat->fetch_assoc())
			{
?>				
				<tr>
				<td align="center" >
				<?php echo $wiersz['id'];?>
				</td>
				<td align="center" ><b>
				<?php echo $wiersz['rasa'];?></b>
				</td>
				<td align="center" ><b>
				<?php echo $wiersz['id_planety_pochodzenia'];?></b>
				</td>
				<td align="center" ><b>
				<?php echo $wiersz['kod_identyfikacyjny'];?></b>
				</td>
				<td align="center" ><b>
				<?php echo $wiersz['plec'];?></b>
				</td>
				<td align="center" ><b>
				<?php echo $wiersz['wiek'];?></b>
				</td>
				<td align="center" ><b>
				<?php echo $wiersz['imie_nazwisko_nazwa'];?></b>
				</td>
				<td align="center" ><b>
				<?php echo $wiersz['id_statku'];?></b>
				</td>
				<td align="center" ><b>
				<?php echo $wiersz['cel_pobytu'];?></b>
				</td>
				<td align="center" class="usun">
				<a href="index.php?id=<?php echo $wiersz['id'];?>&tabela=przybysze">Usuń</a>
				</td>
				<td align="center" class="popraw">
				<a href="update.php?id=<?php echo $wiersz['id'];?>&tabela=przybysze">Popraw</a>
				</td>
				</tr>
<?php
			}
			
			$rezultat->free_result();
		}
?>
</table>
<a href="insert.php?tabela=przybysze"><b>Dodaj</b></a>
<br>
<br>
<br>
	<table>
		<tr>
		<td><b>Id</b></td>
		<td><b>Model</b></td>
		<td><b>Nazwa</b></td>
		<td><b>Prędkość maksymalna (m/s)</b></td>
		<td><b>Liczebność załogi</b></td>
		<td><b>Udźwig (kg)</b></td>
		<td><b>Rok produkcji</b></td>
		<td><b>Id kapitana statku</b></td>
		</tr>
<?php
		if ($rezultat = @$polaczenie->query("SELECT * FROM statki_kosmiczne"))
		{
			while ($wiersz = $rezultat->fetch_assoc())
			{
?>				
				<tr>
				<td align="center" >
				<?php echo $wiersz['id'];?>
				</td>
				<td align="center" >
				<b><?php echo $wiersz['model'];?></b>
				</td>
				<td align="center" >
				<b><?php echo $wiersz['nazwa'];?></b>
				</td>
				<td align="center" >
				<b><?php echo $wiersz['predkosc_maksymalna'];?></b>
				</td>
				<td align="center" >
				<b><?php echo $wiersz['liczebnosc_zalogi'];?></b>
				</td>
				<td align="center" >
				<b><?php echo $wiersz['udzwig'];?></b>
				</td>
				<td align="center" >
				<b><?php echo $wiersz['rok_produkcji'];?></b>
				</td>
				<td align="center" >
				<b><?php echo $wiersz['id_kapitana_statku'];?></b>
				</td>
				<td align="center" class="usun">
				<a href="index.php?id=<?php echo $wiersz['id'];?>&tabela=statki_kosmiczne">Usuń</a>
				</td>
				<td align="center" class="popraw">
				<a href="update.php?id=<?php echo $wiersz['id'];?>&tabela=statki_kosmiczne">Popraw</a>
				</td>
				</tr>
<?php
			}
			
			$rezultat->free_result();
		}
?>
</table>
<a href="insert.php?tabela=statki_kosmiczne"><b>Dodaj</b></a>
<br>
<br>
<br>
	<table>
		<tr>
			<td><b>Id</b></td>
			<td><b>Nazwa</b></td>
			<td><b>Średnica (km)</b></td>
			<td><b>Populacja</b></td>
			<td><b>Główne rasy</b></td>
			<td><b>Dodatkowe informacje</b></td>
		</tr>
<?php
		if ($rezultat = @$polaczenie->query("SELECT * FROM planety"))
		{
			while ($wiersz = $rezultat->fetch_assoc())
			{
?>				
				<tr>
					<td align="center" >
					<?php echo $wiersz['id'];?>
					</td>
					<td align="center" >
					<b><?php echo $wiersz['nazwa'];?></b>
					</td>
					<td align="center" >
					<b><?php echo $wiersz['srednica'];?></b>
					</td>
					<td align="center" >
					<b><?php echo $wiersz['populacja'];?></b>
					</td>
					<td align="center" >
					<b><?php echo $wiersz['glowne_rasy'];?></b>
					</td>
					<td align="center" >
					<b><?php echo $wiersz['dodatkowe_informacje'];?></b>
					</td>
					<td align="center" class="usun">
					<a href="index.php?id=<?php echo $wiersz['id'];?>&tabela=planety">Usuń</a>
					</td>
					<td align="center" class="popraw">
					<a href="update.php?id=<?php echo $wiersz['id'];?>&tabela=planety">Popraw</a>
					</td>
				</tr>
<?php
			}
			
			$rezultat->free_result();
		}
		$polaczenie->close();
	}
?>
	</table>
<a href="insert.php?tabela=planety"><b>Dodaj</b></a>
<br>
	
</body>
</html>