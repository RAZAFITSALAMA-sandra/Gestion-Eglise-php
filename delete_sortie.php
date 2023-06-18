<?php 
require "connect.php";
$id=$_GET['id'];

$moins=$connexion->prepare("SELECT montantSortie as montant from sortie WHERE idsortie=?");
$moins->execute(array($id));
$data=$moins->fetch()['montant'];

$moins=$connexion->prepare("SELECT ideglise as ideglise from sortie WHERE idsortie=?");
$moins->execute(array($id));
$ideglise=$moins->fetch()['ideglise'];

$update=$connexion->prepare("UPDATE eglise SET solde=solde+? WHERE ideglise=?");
$update->execute(array($data,$ideglise));

$sql=$connexion->prepare("DELETE FROM sortie WHERE idsortie=?");
$sql->execute(array($id));
header("location:liste_sortie.php");
 ?> 