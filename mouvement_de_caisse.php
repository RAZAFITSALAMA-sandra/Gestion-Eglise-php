<?php
  require "connect.php";
  if (!empty($_GET['date1']) AND !empty($_GET['date2'])) {
    $date1=$_GET['date1'];
    $date2=$_GET['date2'];

    $date="<strong>Mouvement de caisse </strong>entre <strong>$date1</strong> et <strong>$date2</strong>";

    $sql_entre=$connexion->prepare("SELECT * FROM entre WHERE dateEntre between ? AND ?");
    $sql_entre->execute(array($date1,$date2));

    $req_entre=$connexion->prepare("SELECT SUM(montantEntre) as montantEntre FROM entre WHERE dateEntre between ? AND ?");
    $req_entre->execute(array($date1,$date2));
    $montantEntre=$req_entre->fetch()["montantEntre"];

    $req_sortie=$connexion->prepare("SELECT SUM(montantSortie) as montantSortie FROM sortie WHERE dateSortie between ? AND ?");
    $req_sortie->execute(array($date1,$date2));
    $montantSortie=$req_sortie->fetch()["montantSortie"];

    $sql_sortie=$connexion->prepare("SELECT * FROM sortie WHERE dateSortie between ? AND ?");
    $sql_sortie->execute(array($date1,$date2));

  }else
  {
    $vide="Les dates sont vides";
  }
?>

<?php require "header.php" ?>
<div class="container mt-5">
  <?php if (isset($date)): ?>
    <div class="text-center"style="text-decoration:underline;">
      <?php echo $date; ?>
      <a href="reçu.php?date1=<?php  echo $_GET['date1'];?>&amp;date2=<?php echo $_GET['date2'] ?>"class="btn btn-warning" style="float:right;">PDF</a>
    </div>
    <p>Mouvement d'entrée en caisse</p>
    <?php if($sql_entre->rowCount()==0):?>
        <div class="alert alert-danger text-center">
          <?php echo "Aucune mouvement d'entrée en caisse entre ces dates"; ?>
        </div>
      <?php endif; ?>
    <?php if($sql_entre->rowCount()>0):?>
    <table class="table mt-3 text-center table-bordered">
      <thead class="bg-success text-white">
        <tr>
          <th>Date d'entrée</th>
          <th>Motif</th>
          <th>Montant</th>
        </tr>
      </thead>
      <tbody>
        <?php while($entre=$sql_entre->fetch()):?>
        <tr>
          <td><?php echo $entre['dateEntre'] ?></td>
          <td><?php echo $entre['motif'] ?></td>
          <td><?php echo $entre['montantEntre'] ?></td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
    <strong>Total montant entrant : <?php echo $montantEntre; ?> Ar</strong><br><br>
  <?php endif; ?>
    <p>Mouvement de sortie en caisse</p>
    <?php if($sql_sortie->rowCount()==0):?>
      <div class="alert alert-danger text-center">
        <?php echo "Aucune mouvement de sortie en caisse entre ces dates"; ?>
      </div>
    <?php endif; ?>
    <?php if($sql_sortie->rowCount()>0):?>
    <table class="table mt-3 text-center table-bordered">
      <thead class="bg-success text-white">
        <tr>
          <th>Date de sortie</th>
          <th>Motif</th>
          <th>Montant</th>
        </tr>
      </thead>
      <tbody>
        <?php while($sortie=$sql_sortie->fetch()):?>
        <tr>
          <td><?php echo $sortie['dateSortie'] ?></td>
          <td><?php echo $sortie['motif'] ?></td>
          <td><?php echo $sortie['montantSortie'] ?></td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
    <strong>Total montant sortant : <?php echo $montantSortie;?> Ar</strong><br><br>
  <?php endif; ?>
  <?php endif ?>
</div>
<?php if(isset($vide)):?>
  <div class="container">
    <div class="alert alert-danger text-center">
      <strong>
        <?php echo $vide; ?>
      </strong>
    </div>
  </div>
<?php endif; ?>
<?php require "footer.php" ?>