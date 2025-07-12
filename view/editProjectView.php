<?php ob_start(); ?>

<main class="container py-5 text-light">
  <h1 class="mb-4 text-center text-info">Modifier le projet</h1>

  <?php if (isset($errorMessage)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($errorMessage) ?></div>
  <?php elseif (isset($successMessage)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($successMessage) ?></div>
  <?php endif; ?>

  <form action="?page=update-project" method="POST" enctype="multipart/form-data" id="project-form">
    <input type="hidden" name="id" value="<?= $project['id'] ?>">
    <input type="hidden" name="type" value="<?= $type ?>">

    <div class="mb-3">
      <label for="title" class="form-label">Titre</label>
      <input type="text" class="form-control bg-secondary text-white border-0" id="title" name="title" value="<?= htmlspecialchars($project['title']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="subtitle" class="form-label">Sous-titre</label>
      <input type="text" class="form-control bg-secondary text-white border-0" id="subtitle" name="subtitle" value="<?= htmlspecialchars($project['subtitle']) ?>">
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Image (laisser vide si inchangée)</label>
      <input type="file" class="form-control bg-secondary text-white border-0" id="image" name="image" accept="image/*">
    </div>

    <?php if ($type === 'projects' || $type === 'wordpress'): ?>
      <div id="common-description" class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control bg-secondary text-white border-0" id="description" name="description" rows="4"><?= htmlspecialchars($project['description']) ?></textarea>
      </div>

      <div id="features-group" class="mb-3">
        <label for="features" class="form-label">Fonctionnalités (une par ligne)</label>
        <textarea class="form-control bg-secondary text-white border-0" id="features" name="features" rows="4"><?= htmlspecialchars($project['features']) ?></textarea>
      </div>
    <?php endif; ?>

    <?php if ($type === 'projects'): ?>
      <div id="technologies-group" class="mb-3">
        <label for="technologies" class="form-label">Technologies (séparées par virgules)</label>
        <input type="text" class="form-control bg-secondary text-white border-0" id="technologies" name="technologies" value="<?= htmlspecialchars($project['technologies']) ?>">
      </div>

      <div id="site-link-group" class="mb-3">
        <label for="site_link" class="form-label">Lien vers le site</label>
        <input type="url" class="form-control bg-secondary text-white border-0" id="site_link" name="site_link" value="<?= htmlspecialchars($project['site_link']) ?>">
      </div>

      <div id="github-link-group" class="mb-3">
        <label for="github_link" class="form-label">Lien GitHub</label>
        <input type="url" class="form-control bg-secondary text-white border-0" id="github_link" name="github_link" value="<?= htmlspecialchars($project['github_link']) ?>">
      </div>
    <?php elseif ($type === 'wordpress'): ?>
      <div id="site-link-group" class="mb-3">
        <label for="site_link" class="form-label">Lien vers le site</label>
        <input type="url" class="form-control bg-secondary text-white border-0" id="site_link" name="site_link" value="<?= htmlspecialchars($project['site_link']) ?>">
      </div>

      <div id="role-group" class="mb-3">
        <label for="role" class="form-label">Rôle</label>
        <textarea class="form-control bg-secondary text-white border-0" id="role" name="role" rows="3"><?= htmlspecialchars($project['role']) ?></textarea>
      </div>
    <?php elseif ($type === 'articles'): ?>
      <div id="content-group" class="mb-3">
        <label for="content" class="form-label">Contenu de l'article</label>
        <textarea class="form-control bg-secondary text-white border-0" id="content" name="content" rows="6"><?= htmlspecialchars($project['content']) ?></textarea>
      </div>
    <?php endif; ?>

    <button type="submit" class="btn btn-outline-secondary w-100">Enregistrer</button>
  </form>
</main>

<?php $content = ob_get_clean();
require('base.php'); ?>