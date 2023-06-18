<?php 
require"connect.php";
$message="";
if (isset($_POST['valider'])) {
	if (!empty($_POST['ideglise']) AND !empty($_POST['Design'])) {
			$ideglise=$_POST['ideglise'];
			$Design=$_POST['Design'];
			$solde=$_POST['solde'];
			$sql="INSERT INTO eglise VALUES(?,?,?)";
			$sql=$connexion->prepare($sql);
			$sql->execute(array($ideglise,$Design,$solde));
			header("location:liste.php");
	}
}
 ?>

<?php require "header.php"; ?>
<div class="container col-md-10">
	<div class="card mt-5">
		<div class="card-header text-muted border-bottom">
			<h4>créer une eglise</h4>	
		</div>
		<div class="card-body">
			<?php if (!empty ($message)): ?>
			<div class="alert alert-success">
				<?=$message;?>
			</div>	
				
			<?php endif ?>
			<form method="POST">
				<div class="form-group">
					<label for="name">Identifiant Eglise</label>
					<input type="text" name="ideglise" id="ideglise" class="form-control">
				</div>
				<div class="form-group mt-4">
					<label for="Design">Designation</label>
					<input type="text" name="Design" id="Design" class="form-control">
				</div>
				<div class="form-group mt-4">
					<label for="solde">Solde </label>
					<input type="number" name="solde" id="solde" class="form-control">
				</div>
				<div  class="form-group mt-3">
					<button type="submit" class="btn btn-success text-light"name="valider"style="float:right;">Valider</button>
				</div>
			</form>
		</div>
	</div>
	











</div>
























<?php require "footer.php"; ?>



	





























<?php require "footer.php" ?>