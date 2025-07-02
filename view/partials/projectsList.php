<?php
require_once(__DIR__ . '/../../model/HomeManager.php');
$manager = new HomeManager();

$type = $_GET['type'] ?? 'articles';

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


  <div class="col-12 col-md-4 mb-4 page-enter">
  <a href="?page=project&id=<?= $project['id'] ?>&type=<?= urlencode($type) ?>" class="text-decoration-none text-light">
  <div class="card h-100 text-white bg-black border-0 overflow-hidden">
  
    <img src="<?= htmlspecialchars($project['image']) ?>" class="card-img-top opacity-75"
         alt="<?= htmlspecialchars($project['title']) ?>">
 <div class="card-body">
  <h2 class="card-title text-primary fs-5 my-2">
    <?= htmlspecialchars($project['title']) ?>
  </h2>
    
      <p class="card-text text-white"><i><?= htmlspecialchars($project['subtitle']) ?></i></p>
    </div>
</div>
  </a>
  </div>

<?php endwhile; ?>