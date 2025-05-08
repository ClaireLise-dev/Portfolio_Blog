<?php ob_start(); ?>

<?php include('./hero.php'); ?>



<main>
    <div class="container">
    <section id="articles">
        <h2>Mes Articles</h2>
        <?php if (!isset($articles)) {
            die('Erreur: articles non défini');
        }
        while ($article = $articles->fetch()): ?>
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
    </div>
</main>

<?php
$content = ob_get_clean();
require('./base.php');
