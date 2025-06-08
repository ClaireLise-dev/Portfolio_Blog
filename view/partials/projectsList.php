<?php
require_once(__DIR__ . '/../../model/HomeManager.php');
$manager = new HomeManager();

$type = $_GET['type'] ?? 'projects';

switch ($type) {
  case 'projects':
    $projects = $manager->getProjects();
    break;
  case 'wordpress':
    $projects = $manager->getWordpress();
    break;
  case 'articles':
    $projects = $manager->getArticles();
    break;
  default:
    die('Type invalide');
}

while ($project = $projects->fetch()):
?>
  <div class="col-12 col-md-4 mb-4">
    <div class="card h-100 text-white bg-dark">
      <div class="position-relative">

        <img src="<?= htmlspecialchars($project['image']) ?>" class="card-img-top object-fit-cover opacity-75" alt="<?= htmlspecialchars($project['title']) ?>">

        <div class="position-absolute top-50 start-50 translate-middle w-100 text-center">
          <h3 class="card-title text-center text-white fs-2 fw-bold">
            <?= htmlspecialchars($project['title']) ?>
          </h3>
        </div>
      </div>

    </div>
  </div>
<?php endwhile; ?>