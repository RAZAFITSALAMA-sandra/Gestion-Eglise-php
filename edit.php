<?php 
require"connect.php";
$id=$_GET['id'];
$sql='SELECT * FROM entre WHERE idEntre=?';
$statement=$connexion->prepare($sql);
$statement->execute(array($id)); 
$personne=$statement->fetch(PDO::FETCH_OBJ);
if (isset($_POST['motif']) and isset($_POST['montantEntre']) and isset($_POST['dateEntre']) and isset($_POST['ideglise'])) {
	$motif=$_POST['motif'];
	$montantEntre=$_POST['montantEntre'];
	$dateEntre=$_POST['dateEntre'];
	$ideglise=$_POST['ideglise'];

	$sql='UPDATE entre SET motif=?,montantEntre=?,dateEntre=?,idEglise=? WHERE idEntre=?';
	$statement=$connexion->prepare($sql);

	$moins=$connexion->prepare("SELECT montantEntre as montant from entre WHERE identre=?");
	$moins->execute(array($id));
	$data=$moins->fetch()['montant'];

	$update=$connexion->prepare("UPDATE eglise SET solde=solde-? WHERE ideglise=?");
	$update->execute(array($data,$ideglise));

	$update=$connexion->prepare("UPDATE eglise SET solde=solde+? WHERE ideglise=?");
	$update->execute(array($montantEntre,$ideglise));


	if ($statement->execute(array($motif,$montantEntre,$dateEntre,$ideglise,$id))){

		header("location:creer.php");
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
			<h4>Modifier une entrée</h4>
		</div>
		<div class="card-body">
			<form method="POST">
				<div class="form-group">
					<label for="name">motif</label>
					<input value="<?=$personne->motif;?>"type="text" name="motif" id="motif" class="form-control">
				</div>
				<div class="form-group mt-4">
					<label for="montantEntre">montant entré </label>
					<input type="number" value="<?=$personne->montantEntre;?>" name="montantEntre" id="montantEntre" class="form-control">
				</div>
				<div class="form-group mt-4">
					<label for="dateEntre">date entrée </label>
					<input type="date" value="<?=$personne->dateEntre;?>" name="dateEntre" id="dateEntre" class="form-control">
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

