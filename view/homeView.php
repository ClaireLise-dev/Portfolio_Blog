<?php ob_start(); ?>
<?php include('./hero.php'); ?>

    <div class="container">
        <div class="filterContainer rounded-pill row justify-content-center my-4">

            <div class="col-12 col-md-4"><button id="btnWeb" data-type="projects" class="filterBtn active rounded-pill w-100">Projets Web</button></div>
            <div class="col-12 col-md-4"> <button id="btnWp" data-type="wordpress" class="filterBtn rounded-pill w-100">WordPress</button></div>
            <div class="col-12 col-md-4"><button id="btnArticles" data-type="articles" class="filterBtn rounded-pill w-100">Articles</button></div>

        </div>




        <section id="projects">

                <div class="row" id="projectsContent">
                    <?php
                    $_GET['type'] = 'projects';
                    include('view/partials/projectsList.php');
                    ?>
                </div>

        </section>

        <section id="contact" class="sticky-bottom text-end my-5">
        <a href="?page=contact" class="btn btn-outline-primary rounded-pill">Contact</a>
  
        </section>
    </div>


<?php
$content = ob_get_clean();
require('./base.php');
?>