<?php 
require"connect.php";
$message="";
if (isset($_POST['valider'])) {
	if (!empty($_POST['motif']) AND !empty($_POST['montantSortie']) AND !empty($_POST['dateSortie']) AND !empty($_POST['ideglise'])) {

			$motif=$_POST['motif'];
			$montantSortie=$_POST['montantSortie'];
			$dateSortie=$_POST['dateSortie'];
			$ideglise=$_POST['ideglise'];
			$sortie=$connexion->prepare("INSERT INTO sortie VALUES(NUll,?,?,?,?)");
			$sortie->execute(array($motif,$montantSortie,$dateSortie,$ideglise));

			$update=$connexion->prepare("UPDATE eglise SET solde=solde-? WHERE ideglise=?");
			$update->execute(array($montantSortie,$ideglise));

			header("location:liste_sortie.php");
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
			<h4>créer une sortie</h4>	
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
					<label for="montantSortie">Montant Sortie</label>
					<input type="number" name="montantSortie" id="montantSortie" class="form-control">
				</div>
				<div class="form-group mt-4">
					<label for="date">Date Sortie</label>
					<input type="date" name="dateSortie" id="dateSortie" class="form-control">
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
					<button type="submit" class="btn btn-info text-light"name="valider">Créer une Sortie
					</button>
				</div>
			</form>
		</div>
	</div>
	











</div>
























<?php require "footer.php"; ?>



	





























<?php require "footer.php" ?>