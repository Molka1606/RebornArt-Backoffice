
<?php
require_once __DIR__ . '/../model/config.php';
require_once __DIR__ . '/../model/blog.php';

// Vérifie si la classe Blog est reconnue


class BlogController {

    function fetchBlog() {
        $sql = "SELECT * FROM blog";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            echo "Erreur : ".$e->getMessage();
        }
    }

    function addBlog($blog) {
        $sql = "INSERT INTO blog(titre, contenu, date_pub) VALUES (:titre, :contenu, :date)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(":titre", $blog->getTitre());
            $query->bindValue(":contenu", $blog->getContenu());
            $query->bindValue(":date", $blog->getDate());
            $query->execute();
        } catch (Exception $e) {
            echo "Erreur : ".$e->getMessage();
        }
    }

    function updateBlog($blog, $id) {
        $sql = "UPDATE blog SET titre=:titre, contenu=:contenu, date_pub=:date WHERE id=:id";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute([
                "titre" => $blog->getTitre(),
                "contenu" => $blog->getContenu(),
                "date" => $blog->getDate(),
                "id" => $id
            ]);
        } catch (Exception $e) {
            echo "Erreur : ".$e->getMessage();
        }
    }

    function deleteBlog($id) {
        $sql = "DELETE FROM blog WHERE id=:id";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute(["id" => $id]);
        } catch (Exception $e) {
            echo "Erreur : ".$e->getMessage();
        }
    }
}

// Gestion des actions
if (isset($_GET['action'])) {

    $blogC = new BlogController();

    if ($_GET['action'] === 'add') {
        if (!empty($_POST['titre']) && !empty($_POST['contenu'])) {
            $blog = new Blog(
                null,
                $_POST['titre'],
                $_POST['contenu'],
                date("Y-m-d")
            );

            $blogC->addBlog($blog); // majuscule B

            header("Location: ../view/front/index.html");
            exit();
        } else {
            echo "Veuillez remplir tous les champs.";
        }
    }
}
?>
