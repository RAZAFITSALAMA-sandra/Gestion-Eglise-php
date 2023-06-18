 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Gestion de caisse d'une église</title>
   <link rel="stylesheet" type="text/css" href="styles.min.css">
   <link rel="stylesheet" type="text/css" href="bootstrap-icons/bootstrap-icons.css">
   <script src="jquery.min.js"></script>
   <style>
     #chercher
     {
      background:none;
      color:white;
     }
     #chercher::placeholder
     {
      color:white;
      opacity:0.7;
     }
   </style>
 </head>
 <body>
  <nav class="navbar navbar-expand-lg bg-primary shadow">  
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-light" aria-current="page" href="acceuil.php">Acceuil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" aria-current="page" href="index.php">Créer une église</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="liste.php">Liste des églises</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="creer.php">Liste des entrées</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="liste_sortie.php">Liste des sorties</a>

        </li>     
      </ul>
      <form class="d-flex" role="search"method="GET"action="mouvement_de_caisse.php">
        <input class="form-control me-2"name="date1" type="date"id="chercher" placeholder="entrer la première date" aria-label="Search">
        <input class="form-control me-2"name="date2" type="date" id="chercher"placeholder="entrer la deuxième date" aria-label="Search">
        <button class="btn btn-success" type="submit"name="caisse">Chercher</button>
      </form>
    </div>
  </div>
</nav>