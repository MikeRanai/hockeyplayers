<?php
require ("Joueur.php");

$user="root";
$pass="";
$dbname="hockeyplayer";
$host="localhost";

$db=new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

// Vérifier si l'ID est fourni
if (!isset($_GET['id'])) {
    // Rediriger ou afficher une erreur si l'ID n'est pas fourni
    header('Location: /index2.php');
    exit;
}

$id = $_GET['id'];

// Récupérer les données du joueur
$stmt = $db->prepare("SELECT * FROM joueur WHERE id = ?");
$stmt->execute([$id]);
$joueur = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$joueur) {
    // Joueur non trouvé
    header('Location: /index2.php');
    exit;
}

// Supprimer le joueur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $db->prepare("DELETE FROM joueur WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: /index2.php');
    exit;
}

echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Delete Hockey Player</title>
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
<!--Formulaire suppression-->

<div class="container mt-3">
    <h3>Confirmer la suppression du joueur : ' . htmlspecialchars($joueur['prenom']) . ' ' . htmlspecialchars($joueur['nom']) . '</h3>
    
    <form action="/delete.php?id='.$id.'" method="POST">
        <button type="submit" class="btn btn-danger mb-3">Supprimer</button>
        <a href="/index2.php" class="btn btn-secondary mb-3">Annuler</a>
    </form>
</div>

';

echo '
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

';