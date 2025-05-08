<?php ob_start(); ?>

<?php include('./hero.php'); ?>

<main>
    <div class="container">
    <section id="projects">
        <h2>Mes Projets</h2>
        <?php if (!isset($projects)) {
            die('Erreur: projects non défini');
        }
        while ($project = $projects->fetch()): ?>
            <div class="project">
                <h3><?= htmlspecialchars($project['title']) ?></h3>
                <img src="<?= htmlspecialchars($project['image']) ?>" alt="<?= htmlspecialchars($project['title']) ?>">
                <p><?= htmlspecialchars($project['description']) ?></p>
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
