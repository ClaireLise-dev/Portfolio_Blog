<?php if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['admin'])) {
  header('Location: ?page=login');
  exit;
}
?>

<?php ob_start(); ?>

<main class="container py-5 text-light">
  <h1 class="text-center text-info mb-4">Espace Administrateur</h1>

  <div class="mb-5 text-center">
    <a href="?page=add-project" class="btn btn-outline-secondary"> Ajouter un projet</a>
  </div>

  <section class="mb-5">
    <h2 class="h4 text-white">📁 Projets Web</h2>
    <?php foreach ($projects as $project): ?>
      <div class="d-flex justify-content-between align-items-center border-bottom py-2">
        <strong><?= htmlspecialchars($project['title']) ?></strong>
        <div>
          <a href="?page=edit&id=<?= $project['id'] ?>&type=projects" class="btn btn-sm btn-outline-secondary ms-2">Modifier</a>
          <a href="?page=delete&id=<?= $project['id'] ?>&type=projects" class="btn btn-sm btn-outline-secondary ms-2">Supprimer</a>
        </div>
      </div>
    <?php endforeach; ?>
  </section>

  <section class="mb-5">
    <h2 class="h4 text-white">🌐 Projets WordPress</h2>
    <?php foreach ($wordpress as $wp): ?>
      <div class="d-flex justify-content-between align-items-center border-bottom py-2">
        <strong><?= htmlspecialchars($wp['title']) ?></strong>
        <div>
          <a href="?page=edit&id=<?= $wp['id'] ?>&type=wordpress" class="btn btn-sm btn-outline-secondary ms-2">Modifier</a>
          <a href="?page=delete&id=<?= $wp['id'] ?>&type=wordpress" class="btn btn-sm btn-outline-secondary ms-2">Supprimer</a>
        </div>
      </div>
    <?php endforeach; ?>
  </section>


  <section>
    <h2 class="h4 text-white">📝 Articles</h2>
    <?php foreach ($articles as $article): ?>
      <div class="d-flex justify-content-between align-items-centerborder-bottom py-2">
        <strong><?= htmlspecialchars($article['title']) ?></strong>
        <div>
          <a href="?page=edit&id=<?= $article['id'] ?>&type=articles" class="btn btn-sm btn-outline-secondary ms-2">Modifier</a>
          <a href="?page=delete&id=<?= $article['id'] ?>&type=articles" class="btn btn-sm btn-outline-secondary ms-2">Supprimer</a>
        </div>
      </div>
    <?php endforeach; ?>
  </section>
</main>

<?php $content = ob_get_clean(); ?>
<?php require 'base.php'; ?>