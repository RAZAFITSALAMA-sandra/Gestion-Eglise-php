<?php 
try {
	$connexion=new PDO("mysql:host=localhost;dbname=eglise","root");
} catch (PDOException $e) {
	echo "Erreur:".$e->getMessage();
}
?>  







