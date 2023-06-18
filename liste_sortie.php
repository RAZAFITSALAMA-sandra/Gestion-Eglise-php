<?php require "header.php" ?>
<?php require "connect.php";
$sql='SELECT * FROM sortie';
$statement=$connexion->prepare($sql);
$statement->execute();
if (isset($_GET['chercher_sortie']) AND !empty($_GET['chercher_sortie'])) {
    $sortie=$_GET['chercher_sortie'];
    $sql='SELECT * FROM sortie WHERE motif LIKE "%'.$sortie.'%"';
    $statement=$connexion->prepare($sql);
    $statement->execute();
}
$entre=$statement->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header text-muted border-bottom"> 
      <h4>Listes  des sorties</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <a href="sortie.php"class="btn btn-success m-2"><i class="bi-plus-circle"></i> Nouvelle sortie</a>
        </div>
        <div class="col-md-4"style="margin-left:350px;">
          <form method="GET">
            <input type="search" name="chercher_sortie"class="form-control mt-2"placeholder="chercher une sortie">
          </form>
        </div>
      </div>
      <table class="table table-bordered text-center">
        <tr class="bg-primary text-light">
          <th>ID Sortie</th>
          <th>Motif</th>
          <th>Montant Sortie</th>
          <th>Date Sortie</th>
          <th>Identifiant Eglise</th>
          <th>Action</th>          
        </tr>
     <?php foreach($entre as $personne):?>
        <tr>
          <td><?=$personne->idsortie;?></td>
          <td><?=$personne->motif;?></td>
          <td><?=$personne->montantSortie;?></td>
          <td><?=$personne->dateSortie;?></td>
          <td><?=$personne->idEglise;?></td>
                    <td>
            <a href="edit_sortie.php?id=<?=$personne->idsortie?>"class="btn btn-primary"><i class="bi-pen"></i></a>
            <a href="delete_sortie.php?id=<?=$personne->idsortie?>" class="btn btn-danger"><i class="bi-trash"></i></a>
          </td>
        </tr>
      <?php endforeach;?>
      </table>      
    </div>
  </div>
</div>


















<?php require "footer.php"; ?>






















