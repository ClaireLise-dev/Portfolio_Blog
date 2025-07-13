<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/design/css/default.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>Claire-Lise Démettre - Portfolio</title>
</head>

<body>
    <header class="sticky-top">
        <nav class="navbar navbar-dark bg-secondary navbar-expand-md">

            <div class="container">
                <div class="navbar-brand">
                    <a href="?page=home" class="text-decoration-none text-primary">CLAIRE-LISE DEMETTRE</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarNav" class="collapse navbar-collapse justify-content-end ">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="?page=home">ACCUEIL</a></li>
                        <li class="nav-item"><a class="nav-link" href="?page=contact">CONTACT</a></li>
                        <li class="nav-item"><a class="nav-link" href="?page=login">CONNEXION</a></li>
                    </ul>
                    <div>
                        <a href="https://github.com/ClaireLise-dev" target="_blank" class="ms-md-3 text-body" aria-label="GitHub">
                            <i class="bi bi-github fs-6 text-primary"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/clairelisedemettre" target="_blank" class="text-body aria-label=" LinkedIn">
                            <i class="bi bi-linkedin fs-6 text-primary"></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>



        </nav>
    </header>
    <main id="page" class="page-enter">
        <?= $content ?>
    </main>
    <footer>
        <div class="container text-center text-white py-4">
            <p>&copy;<?= date('Y') ?> Claire-Lise Démettre. Tous droits réservés.</p>
        </div>
    </footer>
    <script src="./assets/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

</body>

</html>