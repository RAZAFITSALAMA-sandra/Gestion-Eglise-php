<?php 
require "connect.php";
$id=$_GET['id'];

$moins=$connexion->prepare("SELECT montantEntre as montant from entre WHERE identre=?");
$moins->execute(array($id));
$data=$moins->fetch()['montant'];

$moins=$connexion->prepare("SELECT ideglise as ideglise from entre WHERE identre=?");
$moins->execute(array($id));
$ideglise=$moins->fetch()['ideglise'];

$update=$connexion->prepare("UPDATE eglise SET solde=solde-? WHERE ideglise=?");
$update->execute(array($data,$ideglise));

$sql=$connexion->prepare("DELETE FROM entre WHERE idEntre=?");
$sql->execute(array($id));

header("location:creer.php");
 ?> 