<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/design/css/default.css">
    <title>Claire-Lise Démettre - Portfolio</title>
</head>
<body>
    <header>
        <h1>Claire-Lise Démettre</h1>
        <nav>
            <ul>
                <li><a href="#projects">Projets</a></li>
                <li><a href="#articles">Articles</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
        <section id="hero">
            <h2>Bienvenue sur mon portfolio</h2>
            <p>Je suis Claire-Lise Démettre, développeuse web.</p>
        </section>
    </header>

    <main>
        <section id="projects">
            <h2>Mes Projets</h2>
            <?php while ($project = $projects->fetch()): ?>
                <div class="project">
                    <h3><?= htmlspecialchars($project['title']) ?></h3>
                    <p><?= htmlspecialchars($project['description']) ?></p>
                </div>
            <?php endwhile; ?>
        </section>

        <section id="articles">
            <h2>Mes Articles</h2>
            <?php while ($article = $articles->fetch()): ?>
                <div class="article">
                    <h3><?= htmlspecialchars($article['title']) ?></h3>
                    <p><?= htmlspecialchars($article['content']) ?></p>
                </div>
            <?php endwhile; ?>
        </section>

        <section id="contact">
            <h2>Contactez-moi</h2>
            <!-- Formulaire de contact -->
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Claire-Lise Démettre. Tous droits réservés.</p>
    </footer>
</body>
</html>