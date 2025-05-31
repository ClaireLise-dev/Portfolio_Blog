<?php ob_start(); ?>
<?php include('./hero.php'); ?>

<main>
    <div class="container">
        <h2>Mes Projets</h2>
        <section id="projects">
            <div class="row">
                <?php if (!isset($projects)) {
                    die('Erreur: projects non défini');
                }
                while ($project = $projects->fetch()): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 text-white bg-dark">
                            <div class="position-relative">

                                <img src="<?= htmlspecialchars($project['image']) ?>" class="card-img-top object-fit-cover opacity-75" alt="<?= htmlspecialchars($project['title']) ?>">

                                <div class="position-absolute top-50 start-50 translate-middle w-100 text-center">
                                    <h3 class="card-title text-center text-white fs-2 fw-bold">
                                        <?= htmlspecialchars($project['title']) ?>
                                    </h3>
                                </div>
                            </div>

                            <div class="card-body">
                                <p class="card-text text-secondary"><?= htmlspecialchars($project['description']) ?></p>
                                <!-- <a href="<?= htmlspecialchars($project['link']) ?>" class="btn btn-primary">Voir le projet</a> -->
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
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
?>