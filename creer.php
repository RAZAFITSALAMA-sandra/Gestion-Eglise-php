<?php require "header.php" ?>
<?php require "connect.php";
$sql='SELECT * FROM entre';
$statement=$connexion->prepare($sql);
$statement->execute();
if (isset($_GET['chercher_entre']) AND !empty($_GET['chercher_entre'])) {
    $entre=$_GET['chercher_entre'];
    $sql='SELECT * FROM entre WHERE motif LIKE "%'.$entre.'%"';
    $statement=$connexion->prepare($sql);
    $statement->execute();
}
$entre=$statement->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header text-muted border-bottom">
      <h4>Listes  des entrés</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <a href="entre.php"class="btn btn-success m-2"><i class="bi-plus-circle"></i> Nouvelle entrée</a>
        </div>
        <div class="col-md-4"style="margin-left:350px;">
          <form method="GET">
            <input type="search" name="chercher_entre"class="form-control mt-2"placeholder="chercher une entrée">
          </form>
        </div>
      </div>
      <table class="table table-bordered text-center">
        <tr class="bg-primary text-light">
          <th>ID Entre</th>
          <th>Motif</th>
          <th>Montant Entre</th>
          <th>DateEntre</th>
          <th>Identifiant Eglise</th> 
          <th>Action</th>           
        </tr>
     <?php foreach($entre as $personne):?>
        <tr>
          <td><?=$personne->identre;?></td>
          <td><?=$personne->motif;?></td>
          <td><?=$personne->montantEntre;?></td>
          <td><?=$personne->dateEntre;?></td>
          <td><?=$personne->idEglise;?></td>
                    <td>
            <a href="edit.php?id=<?=$personne->identre?>"class="btn btn-primary"> <i class="bi-pen"></i></a>
            <a href="delete.php?id=<?=$personne->identre?>" class="btn btn-danger"><i class="bi-trash"></i></a>
          </td>
        </tr>
      <?php endforeach;?>
      </table>      
    </div>
  </div>
</div>


















<?php require "footer.php"; ?>






















