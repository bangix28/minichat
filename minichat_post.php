<?php
session_start()
?>

<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
}
catch(Exception $e)
{
	die('Erreur :' .$e->GetMessage());
}

$req = $bdd->prepare('INSERT INTO minichat(pseudo, message, date_message) VALUES( ?, ?, NOW())');
$req->execute(array($_POST['pseudo'], $_POST['message']));

$_SESSION['pseudo'] = $_POST['pseudo'];

header('location:minichat.php');
  ?>