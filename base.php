<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/design/css/default.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <title>Claire-Lise Démettre - Portfolio</title>
</head>

<body>
    <header class="sticky-top">
        <nav class="navbar navbar-dark bg-secondary navbar-expand-md">

            <div class="container">
                <div class="navbar-brand">
                    <a href="?page=home" class="text-decoration-none text-white">CLAIRE-LISE DEMETTRE</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarNav" class="collapse navbar-collapse justify-content-end ">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="?page=home">ACCUEIL</a></li>
                        <li class="nav-item"><a class="nav-link" href="?page=contact">CONTACT</a></li>
                        <li class="nav-item"><a class="nav-link" href="#connexion">CONNEXION</a></li>
                    </ul>
                </div>
            </div>
        </nav>



        </nav>
    </header>
    <?= $content ?>
    <footer>
        <div class="container text-center">
            <p>&copy;<?= date('Y') ?> Claire-Lise Démettre. Tous droits réservés.</p>
        </div>
    </footer>
    <script src="./assets/index.js"></script>
</body>

</html>