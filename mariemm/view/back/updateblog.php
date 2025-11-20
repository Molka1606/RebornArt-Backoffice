<?php
require_once '../../model/config.php'; // connexion PDO

if(!isset($_GET['id'])) {
    die("ID manquant");
}

$id = (int)$_GET['id'];
$db = config::getConnexion();

// Récupérer l'article
$stmt = $db->prepare("SELECT * FROM blog WHERE id=:id");
$stmt->execute([':id' => $id]);
$blog = $stmt->fetch();

if(!$blog) {
    die("Article introuvable");
}

// Traitement du formulaire
if(isset($_POST['submit'])) {
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $date_pub = $_POST['date_publication'];

    $stmt = $db->prepare("UPDATE blog SET titre=:titre, contenu=:contenu, date_pub=:date_pub WHERE id=:id");
    $stmt->execute([
        ':titre' => $titre,
        ':contenu' => $contenu,
        ':date_pub' => $date_pub,
        ':id' => $id
    ]);

    header("Location: showblog.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un article</title>
</head>
<body>
    <h2>Modifier l'article</h2>
    <form method="post">
        <label>Titre :</label><br>
        <input type="text" name="titre" value="<?php echo htmlspecialchars($blog['titre']); ?>" required><br><br>

        <label>Contenu :</label><br>
        <textarea name="contenu" rows="10" cols="50" required><?php echo htmlspecialchars($blog['contenu']); ?></textarea><br><br>

        <label>Date de publication :</label><br>
        <input type="date" name="date_publication" value="<?php echo htmlspecialchars($blog['date_pub']); ?>" required><br><br>

        <button type="submit" name="submit">Mettre à jour</button>
    </form>
</body>
</html>

