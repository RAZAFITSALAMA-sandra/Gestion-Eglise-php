<?php require "header.php" ?>
<?php require "connect.php";
$sql='SELECT * FROM eglise';
$statement=$connexion->prepare($sql);
$statement->execute();
$eglise=$statement->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container col-md-10">
  <div class="card mt-5">
    <div class="card-header text-muted border-bottom"> 
      <h4>Listes  des les églises</h4>
    </div>
    <div class="card-body">
      <table class="table table-bordered text-center">
        <tr class="bg-primary text-light">
          <th>Identifiant Eglise</th>
          <th>Designation</th>
          <th>Solde</th>          
        </tr>
     <?php foreach($eglise as $personne):?>
        <tr>
          <td><?=$personne->ideglise;?></td>
          <td><?=$personne->Design;?></td>
          <td><?=$personne->Solde;?></td>
        </tr>
      <?php endforeach;?>
        




      </table>
      
    </div>
  </div>





</div>


















<?php require "footer.php"; ?>






















