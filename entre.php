<?php 
require"connect.php";
$message="";
if (isset($_POST['valider'])) {
	if (!empty($_POST['motif']) AND !empty($_POST['montantEntre']) AND !empty($_POST['dateEntre']) AND !empty($_POST['ideglise'])) {

			$motif=$_POST['motif'];
			$montantEntre=$_POST['montantEntre'];
			$dateEntre=$_POST['dateEntre'];
			$ideglise=$_POST['ideglise'];
			$entre=$connexion->prepare("INSERT INTO entre VALUES(NUll,?,?,?,?)");
			$entre->execute(array($motif,$montantEntre,$dateEntre,$ideglise));

			$update=$connexion->prepare("UPDATE eglise SET solde=solde+? WHERE ideglise=?");
			$update->execute(array($montantEntre,$ideglise));

			header("location:creer.php");
	}
} 
 ?>
 <?php
 	$sql=$connexion->prepare("SELECT ideglise from eglise");
 	$sql->execute();
  ?>
<?php require "header.php"; ?>
<div class="container col-md-10">
	<div class="card mt-5">
		<div class="card-header text-muted border-bottom">
			<h4>créer une entre</h4>
			
		</div>
		<div class="card-body">
			<?php if (!empty ($message)): ?>
			<div class="alert alert-success">
				<?=$message;?>
			</div>			
			<?php endif ?>
			<form method="POST">
				<div class="form-group">
				<div class="form-group mt-1">
					<label for="motif">Motif</label>
					<input type="text" name="motif" id="motif" class="form-control">
				</div>
				<div class="form-group mt-4">
					<label for="motif">Montant Entrée</label>
					<input type="number" name="montantEntre" id="montantEntre" class="form-control">
				</div>
				<div class="form-group mt-4">
					<label for="date">Date Entrée</label>
					<input type="date" name="dateEntre" id="dateEntre" class="form-control">
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
					<button type="submit" class="btn btn-success text-light"name="valider"style="float:right;">Enregistrer
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php require "footer.php"; ?>



	





























<?php require "footer.php" ?>