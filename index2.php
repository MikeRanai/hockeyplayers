<?php
require ("Joueur.php");

$user="root";
$pass="";
$dbname="hockeyplayer";
$host="localhost";

$db=new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

// Recherche de joueur
if(isset($_GET['search'])){
    $searchName=$db->prepare("select * from joueur where nom like ? or prenom like ?");
    $valeur="%".$_GET['search']."%";
    $searchName->bindParam(1,$valeur);
    $searchName->bindParam(2,$valeur);
    $searchName->execute();
}
else {
    $searchName=$db->query("select * from joueur");
}

$searchName->setFetchMode(PDO::FETCH_CLASS,'Joueur');
$joueurs=$searchName->fetchAll();

echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Hockey Players</title>
</head>
<body>
<div class="container">
<!--NAVBAR-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary mt-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="/index2.php">Hockey Players</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

                <form class="d-flex" role="search" action="index2.php" METHOD="GET">
                    <input class="form-control me-2" type="search" name="search" id="search" placeholder="Rechercher Joueur" aria-label="Search"/>
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </nav>';
echo '
    <!--BOUTON AJOUTER JOUEUR-->
<div class="row">
    <div class="col d-flex justify-content-end">
        <button type="button" class="btn btn-info m-5"><a href="/form.php">Ajouter un joueur</a></button>
    </div>
</div>
';
echo'
<!--Tableau des joueurs-->
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Age</th>
        <th scope="col">Ville</th>
        <th scope="col">Poste</th>
        <th scope="col">Adresse mail</th>
        <th scope="col">Action</th>
    </tr>
    </thead>';

echo ' <tbody>';

foreach ($joueurs as $joueur) {
    echo "
     <tr>
         <td>".$joueur->getId()."</td>
         <td>".$joueur->getNom()."</td>
         <td>".$joueur->getPrenom()."</td>
         <td>".$joueur->getAge()."</td>
         <td>".$joueur->getVille()."</td>
         <td>".$joueur->getPoste()."</td>
         <td>".$joueur->getEmail()."</td>
         <td>
             <a href='/updateForm.php?id=".$joueur->getId()."' class='btn btn-warning btn-sm'>Modifier</a>
             <a href='/delete.php?id=".$joueur->getId()."' class='btn btn-danger btn-sm'>Supprimer</a>
         </td>
     </tr>
    ";

}
echo '</tbody>
     </table>';

echo '
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

';