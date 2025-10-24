<?php
require ("Joueur.php");

$user="root";
$pass="";
$dbname="hockeyplayer";
$host="localhost";

$db=new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

// Ajouter un joueur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $ville = $_POST['ville'];
    $poste = $_POST['poste'];
    $email = $_POST['email'];

    $ajoutJoueur = $db->prepare("INSERT INTO joueur (nom, prenom, age, ville, poste, email) VALUES (?, ?, ?, ?, ?, ?)");
    $ajoutJoueur->execute([$nom, $prenom, $age, $ville, $poste, $email]);

    header('Location: /index2.php');
    exit;
}

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
            </div>
        </div>
    </nav>';
echo'
<!--Formulaire inscription-->

<!--Tableau-->
<div class="container mt-3">
<form action="/form.php" method="POST">
    <div class="mb-3">
        <div class="col">
            <label for="nom" class="form-label">Nom</label>
        </div>
        <div class="col">
            <input class="form-control" type="text" name="nom" id="nom" placeholder="Votre nom">
        </div>
    </div>
    <div class="mb-3">
        <div class="col">
            <label for="prenom" class="form-label">Prénom</label>
        </div>
        <div class="col">
            <input class="form-control" type="text" name="prenom" id="prenom" placeholder="Votre prenom">
        </div>
    </div>
    <div class="mb-3">
        <div class="col">
            <label for="age" class="form-label">Age</label>
        </div>
        <div class="col">
            <input class="form-control" type="number" name="age" id="age" placeholder="Votre age">
        </div>
    </div>
    <div class="mb-3">
        <div class="col">
            <label for="ville" class="form-label">Ville</label>
        </div>
        <div class="col">
            <input class="form-control" type="text" name="ville" id="ville" placeholder="Votre ville">
        </div>
    </div>
    <div class="mb-3">
        <div class="col">
            <label for="poste" class="form-label">Poste</label>
        </div>
        <div class="col">
            <select class="form-select" aria-label="Default select example" name="poste">
                    <option selected disabled>Votre Poste sur le terrain</option>
                    <option value="Gardien">Gardien</option>
                    <option value="Defenseur">Defenseur</option>
                    <option value="Attaquant">Attaquant</option>
            </select>
        </div>
    </div>
    <div class="mb-3">
        <div class="col">
            <label for="email" class="form-label">Email</label>
        </div>
        <div class="col">
            <input class="form-control" type="email" name="email" id="email" placeholder="Votre adresse mail">
        </div>
    </div>
    <div class="mb-3">
        <div class="col">
            <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
        </div>
    </div>
</form>
</div>

';

echo '
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

';