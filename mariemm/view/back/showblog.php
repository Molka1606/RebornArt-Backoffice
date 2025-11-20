<?php
require __DIR__ ."/../../controller/blogcontroller.php";

$blogC = new BlogController();
$liste = $blogC->fetchBlog();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RebornArt - Liste des Articles</title>

    <!-- Google Fonts & CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../../assets/css/templatemo-space-dynamic.css">
    <link rel="stylesheet" href="../../assets/css/animated.css">
    <link rel="stylesheet" href="../../assets/css/owl.css">
</head>

<body>
    <!-- Header -->
    <header class="header-area header-sticky wow slideInDown">
        <div class="container">
            <nav class="main-nav">
                <a href="../../index.html" class="logo">
                    <h4>Reborn<span>Art</span></h4>
                </a>
                <ul class="nav">
                    <li><a href="../../index.html#top">Home</a></li>
                    <li><a href="../../index.html#about">About Us</a></li>
                    <li><a href="../../index.html#services">Services</a></li>
                    <li><a href="../../index.html#portfolio">Creations</a></li>
                    <li><a href="../../index.html#blog" class="active">Blog</a></li>
                    <li><a href="../../index.html#contact">Contact</a></li>
                </ul>
                <a class='menu-trigger'><span>Menu</span></a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="wow fadeInDown">Liste des Articles</h2>
                <a href="addblog.php" class="btn btn-primary mb-3">Ajouter un Article</a>
            </div>
        </div>

        <?php if(empty($liste)): ?>
            <p class="text-center">Aucun article disponible.</p>
        <?php else: ?>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Titre</th>
                                <th>Contenu</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($liste as $blog): ?>
                            <tr>
                                <td><?php echo $blog['id']; ?></td>
                                <td><?php echo htmlspecialchars($blog['titre']); ?></td>
                                <td><?php echo htmlspecialchars($blog['contenu']); ?></td>
                                <td><?php echo $blog['date_pub']; ?></td>
                                <td>
                                    <a href="deleteblog.php?id=<?php echo $blog['id']; ?>" class="btn btn-danger btn-sm"
                                       onclick="return confirm('Voulez-vous vraiment supprimer cet article ?');">Supprimer</a>
                                    <a href="updateblog.php?id=<?php echo $blog['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="mt-5">
        <div class="container text-center">
            <p>© Copyright RebornArt 2025. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/owl-carousel.js"></script>
    <script src="../../assets/js/animation.js"></script>
    <script src="../../assets/js/imagesloaded.js"></script>
    <script src="../../assets/js/templatemo-custom.js"></script>
</body>
</html>
