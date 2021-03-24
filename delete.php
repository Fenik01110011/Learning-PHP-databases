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
		<td><b>Planeta pochodzenia</b></td>
		<td><b>Kod identyfikacyjny </b></td>
		<td><b>Płeć</b></td>
		<td><b>Wiek</b></td>
		<td><b>Imie i nazwisko / nazwa</b></td>
		<td><b>Model statku</b></td>
		<td><b>Cel pobytu</b></td>
		</tr>

<?php
//łaczenie z baza danych
	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{	
		if ($rezultat = @$polaczenie->query("SELECT * FROM przybysze"))
		{
			$ilu_userow = $rezultat->num_rows;

			while ($wiersz = $rezultat->fetch_assoc())
			{
?>				
				<tr>
				<td align="center" bgcolor="#CCFF99"><?php echo $wiersz['id'];?></td>
				<td align="center" bgcolor="#CCFF99"><b><?php echo $wiersz['rasa'];?></b></td>
				<td align="center" bgcolor="#CCFF99"><b><?php echo $wiersz['planeta_pochodzenia'];?></b></td>
				<td align="center" bgcolor="#CCFF99"><b><?php echo $wiersz['kod_identyfikacyjny'];?></b></td>
				<td align="center" bgcolor="#CCFF99"><b><?php echo $wiersz['plec'];?></b></td>
				<td align="center" bgcolor="#CCFF99"><b><?php echo $wiersz['wiek'];?></b></td>
				<td align="center" bgcolor="#CCFF99"><b><?php echo $wiersz['imie_nazwisko_nazwa'];?></b></td>
				<td align="center" bgcolor="#CCFF99"><b><?php echo $wiersz['model_statku'];?></b></td>
				<td align="center" bgcolor="#CCFF99"><b><?php echo $wiersz['cel_pobytu'];?></b></td>
				<td align="center" bgcolor="#C2C2C2"> <a href="usun.php?id=<?php echo $wiersz['id'];?>">usuń</a></td>
				<td align="center" bgcolor="#C2C2C2"> <a href="update.php?id=<?php echo $wiersz['id'];?>">popraw</a></td>
				</tr>
<?php
			}
			
			$rezultat->free_result();
		}
		
		$polaczenie->close();
	}
?>
</table>
<a href="02formularz-insert-uzytkownicy.php">Dodaj</a>
</body>
</html>