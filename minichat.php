<?php
session_start()
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Mini chat</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

	<div class="container">
		<h1>Mini chat</h1>
	<?php 
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
	}
	catch(exception $e)
	 {
	 	die('Erreur :' .$e->GetMessage());
	 }

	 $reponse = $bdd->query('SELECT id, pseudo, message, DATE_FORMAT(date_message, "%d/%m/%Y %Hh%imin%ss") AS date_message FROM minichat ORDER BY ID DESC LIMIT 0, 10');
	 ?>

		<div class="block_chat">
			<?php
	 while ($donnees = $reponse->fetch()) 
	 {
	 	?>
	 	
	 		<p class="blok_message">
	 			<?php echo htmlspecialchars($donnees['date_message']);?> - <?php echo htmlspecialchars($donnees['pseudo']);?>
	 			à dit : <?php echo htmlspecialchars($donnees['message']);?></p> 
	 <?php
	 }
	 $reponse->CloseCursor();


            
	 ?>
	</div>
	 <form method="POST" action="minichat_post.php">
		<label for="pseudo">Pseudo</label>
		<input type="text" name="pseudo" id="pseudo" <?php if(isset($_SESSION['pseudo'])){echo 'value="' . $_SESSION['pseudo'] . '"';}?>>
		<label for="message">Ton message :</label>
		<input type="text" name="message" id="message">
		<button type="submit" class="btn">Valider</button>
	</form>
</div>
</body>
</html>