<?php 
require"connect.php";
$id=$_GET['id'];
$sql='SELECT * FROM sortie WHERE idsortie=?';
$statement=$connexion->prepare($sql);
$statement->execute(array($id)); 
$personne=$statement->fetch(PDO::FETCH_OBJ);
if (isset($_POST['motif']) and isset($_POST['montantSortie']) and isset($_POST['dateSortie'])  and isset($_POST['ideglise'])) {
	$motif=$_POST['motif'];
	$montantSortie=$_POST['montantSortie'];
	$dateSortie=$_POST['dateSortie'];
	$ideglise=$_POST['ideglise'];

	$sql='UPDATE sortie SET motif=?,montantSortie=?,dateSortie=?,idEglise=? WHERE idsortie=?';
	$statement=$connexion->prepare($sql);

	$moins=$connexion->prepare("SELECT montantSortie as montant from sortie WHERE idsortie=?");
	$moins->execute(array($id));
	$data=$moins->fetch()['montant'];

	$update=$connexion->prepare("UPDATE eglise SET solde=solde+? WHERE ideglise=?");
	$update->execute(array($data,$ideglise));

	$update=$connexion->prepare("UPDATE eglise SET solde=solde-? WHERE ideglise=?");
	$update->execute(array($montantSortie,$ideglise));

	if ($statement->execute(array($motif,$montantSortie,$dateSortie,$ideglise,$id))){
	header("location:liste_sortie.php");
	}
	
} 

 ?>
 <?php
 	$sql=$connexion->prepare("SELECT ideglise from eglise");
 	$sql->execute();
  ?>
<?php require "header.php";?>
<div class="container col-md-10">
	<div class="card mt-5">
		<div class="card-header text-muted border-bottom">
			<h4>Modifier une sortie</h4>
		</div>
		<div class="card-body">
			<form method="POST">
				<div class="form-group">
					<label for="name">motif</label>
					<input value="<?=$personne->motif;?>"type="text" name="motif" id="motif" class="form-control">
				</div>
				<div class="form-group mt-4">
					<label for="montantSortie">montant sortie </label>
					<input type="number" value="<?=$personne->montantSortie;?>" name="montantSortie" id="montantSortie" class="form-control">
				</div>
				<div class="form-group mt-4">
					<label for="dateSortie">date sortie </label>
					<input type="date" value="<?=$personne->dateSortie;?>" name="dateSortie" id="dateSortie" class="form-control">
				</div>
				<div class="form-group mt-4">
					<label>Identifiant eglise</label>
					<select name="ideglise"class="form-control">
						<?php while($eglise=$sql->fetch()):?>
							<option value="<?= $eglise['ideglise'] ?>"><?= $eglise['ideglise'] ?></option>
						<?php endwhile; ?>
					</select>
				</div>
				<div  class="form-group mt-3">
					<button type="submit" class="btn btn-success text-light"style="float:right;">Modifer</button>
				</div>
			</form>
		</div>
	</div>
	











</div>
























<?php require "footer.php"; ?>

