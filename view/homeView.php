<?php ob_start(); ?>
<?php include('./hero.php'); ?>

<main>
    <div class="container">
        <div class="filterContainer rounded-pill row justify-content-center my-4">

            <div class="col-12 col-md-4"><button id="btnWeb" data-type="projects" class="filterBtn rounded-pill w-100">Projets Web</button></div>
            <div class="col-12 col-md-4"> <button id="btnWp" data-type="projects" class="filterBtn rounded-pill w-100">WordPress</button></div>
            <div class="col-12 col-md-4"><button id="btnArticles" data-type="projects" class="filterBtn rounded-pill w-100">Articles</button></div>

        </div>




        <section id="projects">

                <div class="row" id="projectsContent">
                    <?php
                    $_GET['type'] = 'projects'; // affichage initial
                    include('view/partials/projectsList.php');
                    ?>
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